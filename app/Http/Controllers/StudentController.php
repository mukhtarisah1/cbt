<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

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
    public function export()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }
    public function import(Request $request)
    {
        //dd('here');
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,csv',
        ]);
        Excel::import(new StudentsImport, $request->file('excel_file'));

        return redirect()->back()->with('success', 'Students imported successfully');
    }
        //     public function processCsv(Request $request)
        // {
    //     $request->validate([
        //         'csv_file' => 'required|mimes:csv,txt|max:10240', // Allow only CSV files, max size 10MB
        //     ]);

        //     // Process CSV file
        //     $file = $request->file('csv_file');
        //     $csvData = array_map('str_getcsv', file($file->path()));

        //     // Validate CSV data
        //     $csvValidator = Validator::make($csvData, [
        //         '0' => 'required', // Assuming the name is in the first column
        //         '1' => ['required', Rule::unique('users', 'reg_no')],
        //         '2' => 'required|numeric', // Assuming the level is in the third column
        //         '3' => 'required|email|unique:users', // Assuming the email is in the fourth column
        //     ]);

        //     if ($csvValidator->fails()) {
        //         return redirect()->route('students.index')->withErrors($csvValidator);
        //     }

        //     // Process and store CSV data
        //     foreach ($csvData as $row) {
        //         $user = User::create([
        //             'name' => $row[0],
        //             'reg_no' => $row[1],
        //             'level' => $row[2],
        //             'email' => $row[3],
        //         ]);

        //         // Additional processing if needed
        //     }

        //     return redirect()->route('students.index')->with('success', 'Students added successfully from CSV');
        // }
}
