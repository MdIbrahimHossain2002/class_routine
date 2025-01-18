<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Routine;
use App\Models\Department;
use App\Models\Room;
use App\Models\RoutineDetail;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class RoutineImport implements WithMultipleSheets, ToCollection
{
    protected $errors = [];

    protected $file;

    // Constructor to accept file path or handle request directly
    public function __construct($file = null)
    {
        $this->file = $file;
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        try {
            $this->errors = [];
            $firstRow = $rows->first();

            // Process the first row (same as before for routine data)
            $faculty = Faculty::where('title', $firstRow[0])->first();
            if (!$faculty) {
            Log::error('faculty Import Error: ');

                $this->errors[] = "Faculty not found for Title: {$firstRow[0]}";
            }
            $facultyId = $faculty ? $faculty->id : null;

            $department = Department::where('title', $firstRow[1])->first();
            if (!$department) {
            Log::error('department Import Error: ');

                $this->errors[] = "Department not found for Title: {$firstRow[1]}";
            }
            $departmentId = $department ? $department->id : null;

            $program = Program::where('title', $firstRow[2])->first();
            if (!$program) {
            Log::error('program Import Error: ');

                $this->errors[] = "Program not found for Title: {$firstRow[2]}";
            }
            $programId = $program ? $program->id : null;

            $sectionRow = explode('-', $firstRow[3]);
            $section = Section::where([
                'batch_number' => $sectionRow[0] ?? null,
                'section' => $sectionRow[1] ?? null
            ])->first();
            if (!$section) {
            Log::error('section Import Error: ');

                $this->errors[] = "Section not found for Batch and Section: {$firstRow[3]}";
            }
            $sectionId = $section ? $section->id : null;

            $semester = Semester::where('title', $firstRow[4])->first();
            if (!$semester) {
            Log::error('semester Import Error: ');

                $this->errors[] = "Semester not found for Title: {$firstRow[4]}";
            }
            $semesterId = $semester ? $semester->id : null;

            if (!empty($this->errors)) {
                DB::rollBack();
                return;
            }

            // Create the Routine
            $routine = Routine::create([
                'faculty_id' => $facultyId,
                'department_id' => $departmentId,
                'program_id' => $programId,
                'section_id' => $sectionId,
                'semester_id' => $semesterId,
            ]);

            // Import routine details from each row
            foreach ($rows->skip(2) as $row) {
                $course = Course::where('course_code', $row[0])->first();
                if (!$course) {
            Log::error('course Import Error: ');

                    $this->errors[] = "Course not found for Course Code: {$row[0]}";
                    continue;
                }

                $teacher = Teacher::where('teacher_email', $row[3])->first();
                if (!$teacher) {
            Log::error('teacher Import Error: ');

                    $this->errors[] = "Teacher not found for Course Code: {$row[0]}";
                    continue;
                }

                $room = Room::where('room_no', $row[7])->first();
                if (!$room) {
            Log::error('room Import Error: ');

                    $this->errors[] = "Room not found for Course Code: {$row[0]}";
                    continue;
                }

                // Create routine detail
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

            // Check for errors
            if (!empty($this->errors)) {
            Log::error('semester Import Error: ',$this->errors);

                throw new \Exception("Errors occurred during the RoutineDetail insertion.");
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

    public function sheets(): array
    {
        if (!$this->file) {
            throw new \Exception('No file provided for import.');
        }

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->file->getPathname());
        $sheetCount = $spreadsheet->getSheetCount();

        $sheets = [];
        for ($i = 0; $i < $sheetCount; $i++) {
            $sheets[] = new RoutineImport(); // Or another class if sheets have different processing logic
        }

        return $sheets;
    }


}
