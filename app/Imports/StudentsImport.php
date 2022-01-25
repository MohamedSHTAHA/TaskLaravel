<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'first_name'=>$row[0]??'',
            'second_name'=>$row[1]??'',
            'third_name'=>$row[2]??'',
            'last_name'=>$row[3]??'',
            'email'=>$row[4]??''
        ]);
    }
}
