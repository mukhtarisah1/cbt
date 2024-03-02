@extends('layouts.layout')

@section('content')
    <h2>Level Details</h2>

    <p><strong>ID:</strong> {{ $level->id }}</p>
    <p><strong>Name:</strong> {{ $level->name }}</p>

    <a href="{{ route('levels.edit', $level) }}" class="btn btn-warning">Edit Level</a>
    <form action="{{ route('levels.destroy', $level) }}" method="POST" style="display: inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Level</button>
    </form>
@endsection
