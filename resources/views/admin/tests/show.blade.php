<!-- resources/views/admin/tests/show.blade.php -->

@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Test Details</h5>
            
            <p><strong>Test Name:</strong> {{ $test->name }}</p>
            <p><strong>Test Duration:</strong> {{ $test->duration }} minutes</p>
            <p><strong>Test Description:</strong> {{ $test->description }}</p>
        </div>
    </div>

    @if($test->questions->count() > 0)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title text-success">Questions for {{ $test->name }} Test</h5>
                
                @foreach($test->questions as $question)
                    <div class="question-container mb-4 border-bottom ">
                        <p class="question font-weight-bold"><span class="text-success">Question {{$loop->iteration}}</span>: {{ $question->question }}</p>
                        <div class="options">
                            <p>A. {{ $question->option_a }}</p>
                            <p>B. {{ $question->option_b }}</p>
                            <p>C. {{ $question->option_c }}</p>
                            <p>D. {{ $question->option_d }}</p>
                        </div>
                        <p class="correct-answer"><strong>Correct Answer:</strong> {{ $question->correct_answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="mt-4">No questions available for {{ $test->name }}</p>
    @endif
@endsection
