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
                <h5 class="card-title">Questions for {{ $test->name }}</h5>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Option A</th>
                            <th>Option B</th>
                            <th>Option C</th>
                            <th>Option D</th>
                            <th>Correct Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($test->questions as $question)
                            <tr>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->option_a }}</td>
                                <td>{{ $question->option_b }}</td>
                                <td>{{ $question->option_c }}</td>
                                <td>{{ $question->option_d }}</td>
                                <td>{{ $question->correct_answer }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="mt-4">No questions available for {{ $test->name }}</p>
    @endif
@endsection
