@extends('layouts.layout')

@section('content')
    <h2>Edit Level</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('levels.update', $level) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Level Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $level->name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Level</button>
    </form>
@endsection
