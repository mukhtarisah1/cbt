<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('students')->insert([
                'firstname' => "First_$i",
                'lastname' => "Last_$i",
                'middlename' => "Middle_$i",
                'level' => "100", // You can adjust the level accordingly
                'email' => "student$i@example.com",
                'reg_no' => "REG00$i",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
