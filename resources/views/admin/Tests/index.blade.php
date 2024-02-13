@extends('layouts.layout')

@section('content')
    <!-- Display a list of tests -->
    <h1>{{ $course->title }} Tests</h1>

    <ul>
        @foreach ($tests as $test)
            <li>
                <a href="{{ route('courses.tests.edit', [$course, $test]) }}">{{ $test->title }}</a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('courses.tests.create', $course) }}">Create Test</a>
@endsection