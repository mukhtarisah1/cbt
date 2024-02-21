<!-- resources/views/students/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $student->name) }}" required>
        </div>
        <div class="form-group">
            <label for="reg_no">Reg No</label>
            <input type="text" class="form-control" name="reg_no" value="{{ old('reg_no', $student->reg_no) }}" required>
        </div>
        <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" class="form-control" name="venue" value="{{ old('venue', $student->venue) }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update Student</button>
    </form>
@endsection
