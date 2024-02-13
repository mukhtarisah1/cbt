@extends('layouts.layout')

@section('content')
    <!-- Display a list of tests -->
    <h5>{{ $course->name }} Tests</h5>

    <ul>
        @foreach ($tests as $test)
            <li>
                <a href="{{ route('courses.tests.edit', [$course, $test]) }}">{{ $test->name }}</a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('courses.tests.create', $course) }}">Create Test</a>

    
@endsection