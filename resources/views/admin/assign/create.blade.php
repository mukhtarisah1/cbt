@extends('layouts.layout')
@section('content')
    <div class="container">
        <h2>Assign Test</h2>
        
        <form action="{{ route('courses.tests.assign.store', ['course' => $course->id, 'test' => $test->id] ) }}" method="post">
            @csrf

            <div class="form-group">
                <label for="students">Select Students</label>
                <select name="students[]" id="students" class="form-control" multiple required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Assign Test</button>
        </form>
    </div>
@endsection