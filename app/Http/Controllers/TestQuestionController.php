<?php

namespace App\Http\Controllers;

use App\Models\Course;

use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Http\Request;

class TestQuestionController extends Controller
{
    public function create(Course $course, Test $test)
    {
        //dd($course);
        //dd($test);
        return view('admin.test_questions.create', compact('course', 'test'));
    }

    public function store(Request $request, Course $course, Test $test)
    { 
        // Assuming you have a TestQuestion model
        TestQuestion::create([
            'test_id' => $test->id,
            'question' => $request->input('question'),
            'option_a' => $request->input('option_a'),
            'option_b' => $request->input('option_b'),
            'option_c' => $request->input('option_c'),
            'option_d' => $request->input('option_d'),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        return redirect()->route('courses.tests.show', [$course, $test])->with('success', 'Question added successfully');
    }
    public function edit(Course $course, Test $test, TestQuestion $question)
    {
        //$question = Question::findOrFail($question);
        return view('admin.test_questions.edit', compact('course', 'test', 'question'));
    }

    public function update(Request $request, Course $course, Test $test, TestQuestion $question)
    {
        $question = TestQuestion::findOrFail($question);
        
        // Validation logic for your questions and options

        $question->update([
            'question' => $request->input('question'),
            'option_a' => $request->input('option_a'),
            'option_b' => $request->input('option_b'),
            'option_c' => $request->input('option_c'),
            'option_d' => $request->input('option_d'),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        return redirect()->route('courses.tests.show', [$course, $test])->with('success', 'Question updated successfully');
    }

    public function destroy(Course $course, Test $test, TestQuestion $question)
    {
        $question = TestQuestion::findOrFail($question);
        $question->delete();

        return redirect()->route('courses.tests.show', [$course, $test])->with('success', 'Question deleted successfully');
    }
}
