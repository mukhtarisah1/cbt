<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('courses')->insert([
                'name' => "Course $i",
                'description' => "Course $i",
                'slug' => "Course $i", //category
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
