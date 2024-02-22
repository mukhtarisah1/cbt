<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('is_admin', 0)->get();
        //dd($students);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data= $request->validate([
            'name' => 'required',
            'reg_no' => 'required|unique:users',
            'level' => 'required|numeric',
            'email' => 'required',
            
        ]);

        User::create($data);

        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function edit(User $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
       $data= $request->validate([
            'name' => 'required',
            'reg_no' => 'required|unique:users,reg_no,' . $student->id,
            'level' => 'required|numeric',
            'email' => 'required',
        ]);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(User $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
