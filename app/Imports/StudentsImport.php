<?php
namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'reg_no' => $row['reg_no'],
            'level' => $row['level'],
            'email' => $row['email'],
            // Add more fields as needed
        ]);
    }
}