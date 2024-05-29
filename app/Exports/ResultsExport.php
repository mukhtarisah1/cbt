<?php

namespace App\Exports;


use App\Models\Test;
use App\Models\TestResult;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TestResult::with('student', 'test')
            ->get()
            ->map(function ($result) {
                return [
                    'student_name' => $result->student->firstname . ' ' . $result->student->lastname,
                    'test_name' => $result->test->title,
                    'score' => $result->score,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Test Name',
            'Score',
        ];
    }
}
