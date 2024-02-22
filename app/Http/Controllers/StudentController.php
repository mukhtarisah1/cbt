<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
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
        try {
            $request->validate([
                'excel_file' => 'required|mimes:xlsx,csv',
            ]);
    
            Excel::import(new StudentsImport, $request->file('excel_file'));
    
            return redirect()->back()->with('success', 'Students imported successfully');
        } catch (NoTypeDetectedException $e) {
            return redirect()->back()->with('error', 'Error: No type detected. Please ensure you are uploading a valid Excel file (xlsx) or CSV file.');
        } catch (QueryException $e) {
            // Check if the exception is related to duplicate entry
            if ($e->getCode() == 23000) {
                return redirect()->back()->with('error', 'Error: Duplicate entry found. Please ensure there are no duplicate entries or already inserted entries in your Excel/CSV file.');
            }
    
            // Handle other database-related exceptions
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
            
} 

