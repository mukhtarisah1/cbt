<!-- resources/views/test_questions/edit.blade.php -->

<!-- resources/views/test_questions/create.blade.php -->

@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title border-bottom pb-2">Edit Question for <i class="text-success">{{ $test->name }}</i> Test</h5>
            
            <form action="{{ route('courses.tests.questions.update', [$course, $test, $question]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="question">Question:</label>
                    <textarea class="form-control" name="question" required>{{ $question->question }}</textarea>
                </div>
                <div class="form-group">
                    <label for="option_a">Option A:</label>
                    <input type="text" class="form-control" name="option_a" value=" {{ $question->option_a }}"  required>
                </div>
                <div class="form-group">
                    <label for="option_b">Option B:</label>
                    <input type="text" class="form-control" name="option_b" value="  {{ $question->option_a }}" required>
                </div>
                <div class="form-group">
                    <label for="option_c">Option C:</label>
                    <input type="text" class="form-control" name="option_c" value=" {{ $question->option_c }}" required >
                </div>
                <div class="form-group">
                    <label for="option_d">Option D:</label>
                    <input type="text" class="form-control" name="option_d" value=" {{ $question->option_d }}" required>
                </div>
                <div class="form-group">
                    <label for="correct_answer">Correct Answer:</label>
                    <input type="text" class="form-control" name="correct_answer" value="{{ $question->correct_answer }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Question</button>
            </form>
        </div>
    </div>
@endsection

