<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Assuming you have courses in the courses table
        $courseIds = DB::table('courses')->pluck('id');

        for ($i = 1; $i <= 20; $i++) {
            DB::table('tests')->insert([
                'course_id' => $courseIds->random(),
                'title' => "Test $i",
                'description' => "Description for Test $i",
                'duration' => rand(30, 120), // Random duration in minutes
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
