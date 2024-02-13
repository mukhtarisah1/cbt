<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Course $course)
    {
        $tests = $course->tests;

        return view('admin.tests.index', compact('course', 'tests'));
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
            'name' => 'required|string|max:255',
            'description' =>'required|string'
        ]));

        return redirect()->route('courses.tests.index', $course);
    }

    public function edit(Course $course, Test $test)
    {
        return view('admin.tests.edit', compact('course', 'test'));
    }

    public function update(Request $request, Course $course, Test $test)
    {
        // Validate and update test data
        $test->update($request->validate([
            'title' => 'required|string|max:255',
            'description' =>'required|string'
        ]));

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
}
