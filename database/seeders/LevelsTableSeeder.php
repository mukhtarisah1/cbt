<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levelsData = [
            ['level' => '100', 'description' => 'First Year'],
            ['level' => '200', 'description' => 'Second Year'],
            ['level' => '300', 'description' => 'Third Year'],
            // Add more levels as needed
        ];

        foreach ($levelsData as $levelData) {
            DB::table('levels')->insert([
                'level' => $levelData['level'],
                'description' => $levelData['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
