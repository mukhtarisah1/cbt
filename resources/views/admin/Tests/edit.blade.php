@extends('layouts.layout')

@section('content')
    <h1>Edit Test</h1>

    <form action="{{ route('courses.tests.update', [$course, $test]) }}" method="post">
        @csrf
        @method('put')

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ old('title', $test->title) }}" required>

        <!-- Add other fields as needed -->

        <button type="submit">Update Test</button>
    </form>
@endsection
<div>
        welcome {{ Auth::user()->name }}
    </div>
    <div class="row justify-content-md-center">
        <div class="col col-md-8">
            <div id="base-style" class="card">
                
                <div class="card-body">
                    <fieldset>
                        <legend>Edit Course</legend>
                    </fieldset>
                        <!-- Form to create a new course -->
                    <form action="{{ route('courses.tests.update', [$course, $test]) }}"  method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="subject" >Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ old('title') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" required>value="{{ old('description') }}"</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>