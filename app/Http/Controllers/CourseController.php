<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Retrieve and return all courses
        $courses = Course::all()->sortBy('name');
        return view('admin.courses.index', ['courses' => $courses]);
    }

    public function create()
    {
        // Show the form to create a new course
        $courses = Course::all()->groupBy('slug');
        return view('admin.courses.create', compact('courses'));
    }

    public function store(Request $request)
    {
        // Validate and store the new course
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'slug' => 'required|string',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function edit($id)
    {
        // Retrieve the course for editing
        $course = Course::findOrFail($id);
       // dd($course);
        return view('admin.courses.edit', ['course' => $course]);
    }

    public function update(Request $request, $id)
    {
        // Validate and update the course
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'slug' => 'required|string',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        // Delete the course
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

}
