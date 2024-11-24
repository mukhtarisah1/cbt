<?php

namespace App\Imports;

use App\Models\TestQuestion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    protected $testId;

    public function __construct($testId)
    {
        $this->testId = $testId;
    }

    public function model(array $row)
    {
        return new TestQuestion([
            'test_id' => $this->testId,
            'question' => $row['question'],
            'option_a' => $row['option_a'],
            'option_b' => $row['option_b'],
            'option_c' => $row['option_c'],
            'option_d' => $row['option_d'],
            'correct_answer' => $row['correct_answer'],
        ]);
    }
}
