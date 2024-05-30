@extends('layouts.layout')

@section('content')
    <h2>Levels</h2>

    <a href="{{ route('levels.create') }}" class="btn btn-primary mb-3">Add Level</a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($levels as $level)
                <tr>
                    <td>{{ $level->id }}</td>
                    <td>{{ $level->level }}</td>
                    <td>
                        <a href="{{ route('levels.show', $level) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('levels.edit', $level) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('levels.destroy', $level) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No levels found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
