<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('is_admin', 0)->groupBy('level');
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'reg_no' => 'required|unique:students',
            'level' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function edit(User $user)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'reg_no' => 'required|unique:students,reg_no,' . $user->id,
            'level' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
