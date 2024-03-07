<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    //dd($questions);
    // Calculate the end time based on the test duration
    $duration =$test->duration;
    $endTime = Carbon::now()->addMinutes($duration);
    //dd($endTime);
    return view('students.startTest', compact('test', 'questions', 'endTime'));
} 

public function submitTest(Test $test){
    return view('students.submitTest', compact('test'));
} 

public function submitTestPost(Test $test, Request $request){
    $test->update( $request->all());
    return redirect()->route('courses.tests.index', $test);
} 

public function testResult(Test $test){
    return view('students.testResult', compact('test'));
} 

public function testResultPost(Test $test, Request $request){
    $test->update( $request->all());
    return redirect()->route('courses.tests.index', $test);
} 

}
