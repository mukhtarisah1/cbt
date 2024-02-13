@extends('layouts.layout')

@section('content')
    <h1>Edit Test</h1>

    <form action="{{ route('courses.tests.update', [$course, $test]) }}" method="post">
        @csrf
        @method('put')

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ old('title', $test->title) }}" required>

        <!-- Add other fields as needed -->

        <button type="submit">Update Test</button>
    </form>
@endsection