@extends('layouts.layout')

@section('content')
    <h1>Create Test for {{ $course->title }}</h1>

    <form action="{{ route('courses.tests.store', $course) }}" method="post">
        @csrf

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ old('title') }}" required>

        <!-- Add other fields as needed -->

        <button type="submit">Create Test</button>
    </form>
@endsection