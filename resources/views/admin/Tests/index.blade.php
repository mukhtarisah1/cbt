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

@endsection