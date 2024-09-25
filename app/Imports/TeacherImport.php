<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TeacherImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $faculty_id, $department_id;
    public function __construct($faculty_id, $department_id)
    {
        $this->faculty_id = $faculty_id;
        $this->department_id = $department_id;
    }
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $col)
    {
        $data = new Teacher();
        $data->faculty_id = $this->faculty_id;
        $data->department_id = $this->department_id;
        $data->teacher_name = $col[0];
        $data->teacher_phone = $col[1];
        $data->teacher_email = $col[2];
        $data->save();
        return null;
    }
}
