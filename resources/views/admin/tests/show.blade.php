<!-- resources/views/admin/tests/show.blade.php -->

@extends('layouts.layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
        <div class="d-flex justify-content-between align-middle mb-4">
            <a href="{{route('courses.tests.questions.create', ['course' => $course->id, 'test' => $test->id])}}" class="btn btn-success mb-3">Add new question</a>
            <a href="{{ route('courses.tests.index', [$course, $test]) }}" class="btn btn-secondary">
                    Back to All Test
            </a>
        </div>
        
            <h5 class="card-title">Test Details</h5>
            
            <p><strong>Test Name:</strong> {{ $test->title }}</p>
            <p><strong>Test Duration:</strong> {{ $test->duration }} minutes</p>
            <p><strong>Test Description:</strong> {{ $test->description }}</p>
        </div>
    </div>
   

    @if($test->questions->count() > 0)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title text-success">Questions for {{ $test->title }} Test</h5>
                
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
                        

                            <a  href="{{ route('courses.tests.questions.edit', [$course, $test, $question]) }}" data-toggle="tooltip" data-placement="top" title="Update question"><i class="fa fa-pencil-alt"></i></a>
                            
                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-sm btn-icon" data-toggle="modal" data-target="#deleteModal">
                        <i class="far fa-trash-alt"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this item?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{  route('courses.tests.questions.destroy', [ $course, $test, $question]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="mt-4">No questions available for {{ $test->name }}</p>
    @endif
@endsection
