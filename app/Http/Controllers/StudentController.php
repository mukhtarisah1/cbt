<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Models\Level;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $students = Student::all();
        //dd($students);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('students.create', compact('levels'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $data = $request->validate([
            'firstname' =>'required',
            'lastname' =>'required',
            'middlename' => 'required',
            'level' =>'required|numeric',
            'reg_no' =>'required',
            'email' =>'required',
        ]);
        //dd($data);
        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function edit(Student $student)
    {
        $levels = Level::all();
        return view('students.edit', compact('student','levels'));
    }

    public function update(Request $request, Student $student)
    {
       $data= $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'reg_no' => 'required|unique:users,reg_no,' . $student->id,
            'level' => 'required',
            'email' => 'required',
        ]);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
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

