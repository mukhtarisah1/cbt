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
        <div class="form-group col-md-6">
            <label for="name">Level Name:</label>
            <input type="text" name="level" class="form-control" value="{{ old('level', $level->level) }}" required>
        </div>
        <div class="form-group col-md-6">
            <label for="name">Level Description:</label>
            <input type="text" name="description" class="form-control" value="{{ old('level', $level->description) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Level</button>
    </form>
@endsection
