<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            //
            'name' => $row[1],
            'gender' => $row[2],
            'phone' => $row[3],
            'foto' => $row[4],
        ]);
    }
}
