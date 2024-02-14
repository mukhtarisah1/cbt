@extends('layouts.layout')

@section('content')
    

    @forelse ($courses as $course )
        <h5>{{$course->name}}</h5>
        @if($course->tests->count() > 0)
        <ul>
            @foreach($course->tests as $test)
                <li>{{ $test->name }}</li>
            @endforeach
        </ul>
    @else
        <p>No tests available for this course.</p>
    @endif
    @empty
        
    @endforelse
    <table class="table">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Tests</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                 <tr>
                    <td>{{ $course->name }}</td>
                    <td>
                        @if($course->tests->count() > 0)
                            <ul>
                                @foreach($course->tests as $test)
                                    <li>{{ $test->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            No tests available
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
             @endforeach
        </tbody>
    </table>


@endsection