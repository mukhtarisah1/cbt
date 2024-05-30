<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Level;
use App\Models\Student;
use App\Models\Test;
use App\Models\TestAssignment;
use App\Models\User;
use Illuminate\Http\Request;

class TestAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Request $requsest, Course $course, Test $test ){
        $students  = Student::all();
        $levels = Level::all();
        //dd($levels);
        return view('admin.assign.create', compact('course', 'test', 'students', 'levels'));
    }

    public function getStudents($level)
    {
        //dd($level);
        try {
            $students = Student::where('level', $level)->get();

            return response()->json($students);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request, Course $course, Test $test){
        
        $data = $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:students,reg_no',
        ]);
    
        foreach ($data['students'] as $reg_no) {
            $student = Student::where('reg_no', $reg_no)->first();
    
            if ($student) {
                TestAssignment::create([
                    'test_id' => $test->id,
                    'student_id' => $student->id,
                ]);
            }
        }
    
        return redirect()->route('courses.tests.show', compact('course', 'test'))->with('success', 'Test assigned to students successfully');
    }

    public function destroy(Course $course, Test $test){
        $course->tests()->detach($test->id);
        return redirect()->route('admin.courses.show', $course);
    }
}
