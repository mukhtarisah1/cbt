<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class TestAssignmentController extends Controller
{
    public function create(Request $requsest, Course $course, Test $test ){
        $students  = User::where('is_admin', 0)->get();
        return view('admin.assign.create', compact('course', 'test', 'students'));
    }

public function store(Request $request, Course $course, Test $test){
    // $course->tests()->attach($test->id, ['score' => $request->score]);
    // return redirect()->route('admin.courses.show', $course);
}

public function destroy(Course $course, Test $test){
    $course->tests()->detach($test->id);
    return redirect()->route('admin.courses.show', $course);
}
}
