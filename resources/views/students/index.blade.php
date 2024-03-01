<!-- resources/views/students/index.blade.php -->
@extends('layouts.layout')

@section('content')
    <h1>Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-striped table-hover table-bordered ">
                    
                        <tr>
                            <th>SN</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Level</th>
                            <th>Matric Number</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    
                    
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->firstname }}</td>
                                <td>{{ $student->middlename }}</td>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->level }}</td>
                                <td>{{ $student->reg_no }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST">
                                        
                                        <a href="{{ route('students.edit', $student) }}"><i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span></a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-icon btn-secondary" onclick="return confirm('Are you sure you want to delete this record?')" type="submit"><i class="far fa-trash-alt"></i> <span class="sr-only">Remove</span></button>                               
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                   
                </table>
            </div>
        </div>
    </div>
@endsection
