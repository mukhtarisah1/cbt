<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Test;
use App\Models\TestResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function index()
    {
        $courses = Course::with('tests')->get();
        ///dd($courses);
        return view('admin.tests.index', compact('courses'));
    }

    public function create(Course $course)
    {
        //dd($course->name);
        return view('admin.tests.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        // Validate and store test data
        $test = $course->tests()->create($request->validate([
            'title' => 'required|string|max:255',
            'description' =>'required|string',
            'duration' =>'required|numeric'
        ]));

        return redirect()->route('courses.tests.index', $course)->with('Success', 'Course created successfully');
    }
    

    public function show(Course $course, Test $test)
    {
        $test = Test::with('questions')->find($test->id);
        //dd($test);
        return view('admin.tests.show', compact('course', 'test'));
    }

    public function edit(Course $course, Test $test)
    {
        return view('admin.tests.edit', compact('course', 'test'));
    }

    public function update(Request $request, Course $course, Test $test)
    {
        
        $data= $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required',
            'description' =>'required|string'
        ]);
    
        $test->update( $request->all());
        return redirect()->route('courses.tests.index', $course);
    }

    public function destroy(Course $course, Test $test)
    {
        // Delete the test
        $test->delete();

        return redirect()->route('courses.tests.index', $course);
    }

    public function createView(){
        $courses = Course::all()->sortBy('name');
        return view('admin.tests.createView',compact('courses'));
    }


    public function startTestInstructions(Test $test){
        return view('students.startTestInstructions', compact('test'));
    } 

public function startTest(Test $test){
    $questions = $test->questions;
    if(!Session::has('test_start_time')){
        Session::put( 'test_start_time', Carbon::now() );
    }

    $duration =$test->duration;
    $startTime = Session::get('test_start_time');
    //dd($startTime);
    $endTime = $startTime->copy()->addMinutes($duration); // Use copy() to avoid modifying the session value
    $remainingTime = $endTime->diffInMilliseconds(Carbon::now());

    return view('students.startTest', compact('test', 'questions', 'remainingTime'));
    } 

    public function submitTest(Test $test){
        //dd('here');
        return view('students.submitTest', compact('test'));
    } 

    public function submitTestPost(Test $test, Request $request)
    {
        $studentId = auth()->id(); // Assuming the student is authenticated
        $questions = $request->input('questions', []);
        $totalQuestions = count($questions);
        $correctAnswers = 0;

        foreach ($questions as $question) {
            $questionId = $question['id'];
            $submittedAnswer = $question['answer'];

            // Check if the answer is null
            if (is_null($submittedAnswer)) {
                return back()->with('error', 'All questions must be answered.');
            }

            $correctAnswer = $question['correct_answer'];

            // Map the submitted answer to its corresponding text
            $submittedAnswerText = '';
            switch ($submittedAnswer) {
                case 'A':
                    $submittedAnswerText = $question['option_a'];
                    break;
                case 'B':
                    $submittedAnswerText = $question['option_b'];
                    break;
                case 'C':
                    $submittedAnswerText = $question['option_c'];
                    break;
                case 'D':
                    $submittedAnswerText = $question['option_d'];
                    break;
            }

            // Store the answer
            Answer::create([
                'student_id' => $studentId,
                'question_id' => $questionId,
                'test_id' => $test->id,
                'answer' => $submittedAnswerText,
            ]);

            // Check if the answer is correct
            if ($submittedAnswerText == $correctAnswer) {
                $correctAnswers++;
            }
        }

        // Calculate score
        $score = ($correctAnswers / $totalQuestions) * 100;

        // Store the test result
        TestResult::create([
            'student_id' => $studentId,
            'test_id' => $test->id,
            'score' => $score,
        ]);

        return redirect()->route('finishScreen')->with('status', 'Test submitted successfully!');
    }


    public function finishTest()
    {
        return view('students.finishScreen');
    }

    public function showResults($courseId, $testId)
    {
        $course = Course::findOrFail($courseId);
        $test = Test::findOrFail($testId);
        $results = TestResult::with(['student', 'test']) 
            ->where('test_id', $testId)
            ->get();

        return view('admin.courses.results', compact('course', 'test', 'results'));
    }

    public function testResultPost(Test $test, Request $request){
        $test->update( $request->all());
        return redirect()->route('courses.tests.index', $test);
    } 

}
