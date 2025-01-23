<?php

namespace App\Imports;

use App\Models\Routine;
use App\Models\RoutineDetail;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Program;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Room;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class RoutineImport implements ToCollection
{
    public $errors = [];

    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        try {
            $this->errors = [];

            // Extract header row details (Faculty, Department, etc.)
            $firstRow = $rows->first();

            $faculty = Faculty::where('title', $firstRow[0])->first();
            $department = Department::where('title', $firstRow[1])->first();
            $program = Program::where('title', $firstRow[2])->first();
            $sectionRow = explode('-', $firstRow[3]);
            $section = Section::where([
                'batch_number' => $sectionRow[0] ?? null,
                'section' => $sectionRow[1] ?? null
            ])->first();
            $semester = Semester::where('title', $firstRow[4])->first();

            if (!$faculty || !$department || !$program || !$section || !$semester) {
                $this->errors[] = "Invalid Routine data in header row.";
                DB::rollBack();
                return;
            }

            $routine = Routine::create([
                'faculty_id' => $faculty->id,
                'department_id' => $department->id,
                'program_id' => $program->id,
                'section_id' => $section->id,
                'semester_id' => $semester->id,
            ]);

            foreach ($rows->skip(2) as $row) {
                $course = Course::where('course_code', $row[0])->first();
                $teacher = Teacher::where('teacher_email', $row[3])->first();
                $room = Room::where('room_no', $row[7])->first();

                if (!$course || !$teacher || !$room) {
                    $this->errors[] = "Invalid details for Course Code: {$row[0]}";
                    continue;
                }

                // Check for conflicts
                $conflicts = RoutineDetail::where(function ($query) use ($row, $room) {
                    $query->where('day_one', $row[4])
                        ->where('time', $row[6])
                        ->where('room_id', $room->id);
                })->orWhere(function ($query) use ($row, $room) {
                    $query->where('day_two', $row[5])
                        ->where('time', $row[6])
                        ->where('room_id', $room->id);
                })->with(['routine.section', 'routine.semester'])->get();

                if ($conflicts->isNotEmpty()) {
                    foreach ($conflicts as $conflict) {
                        $batchInfo = "Batch: " . $conflict->routine->section->batch_number . "-" . $conflict->routine->section->section;
                        $semesterInfo = "Semester: " . $conflict->routine->semester->title;
                        $this->errors[] = "Already Assigned for Room: {$room->room_no}, Time: {$row[6]}, Days: {$row[4]} or {$row[5]} with {$batchInfo}, {$semesterInfo}.";
                    }
                    continue;
                }

                // Save routine details
                RoutineDetail::create([
                    'routine_id' => $routine->id,
                    'course_id' => $course->id,
                    'teacher_id' => $teacher->id,
                    'day_one' => $row[4],
                    'day_two' => $row[5],
                    'time' => $row[6],
                    'room_id' => $room->id,
                ]);
            }

            if (!empty($this->errors)) {
                DB::rollBack();
                throw new \Exception("Errors occurred during import.");
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errors[] = "An error occurred: " . $e->getMessage();
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
