<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CourseImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $faculty_id, $department_id, $program_id;
    public function __construct($faculty_id, $department_id, $program_id)
    {
        $this->faculty_id = $faculty_id;
        $this->department_id = $department_id;
        $this->program_id = $program_id;
    }
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $col)
    {
        $data = new Course();
        $data->faculty_id = $this->faculty_id;
        $data->department_id = $this->department_id;
        $data->program_id = $this->program_id;
        $data->course_code = $col[0];
        $data->course_title = $col[1];
        $data->course_credit = $col[2];
        $data->save();
        return null;
    }
}
