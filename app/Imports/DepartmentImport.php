<?php

namespace App\Imports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DepartmentImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $faculty_id;

    public function __construct($faculty_id)
    {
        $this-> faculty_id = $faculty_id;
    }

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $col)
    {
        // foreach ($faculty as $key => $item) {
        // $data =
        // }


        $data = new Department();
        $data ->faculty_id = $this->faculty_id;
        $data->title = $col[0];
        $data->save();
        return null;
    }
}
