@extends('layouts.layout')

@section('content')

    <div class="row ">
        <div class="col col-md-8">
            <div id="base-style" class="card">
                
                <div class="card-body">
                    <fieldset>
                        <legend>Create Test for <span class="text-success">{{ $course->name }}</span></legend>
                    </fieldset>
                        <!-- Form to create a new course -->
                    <form action="{{ route('courses.tests.store', $course) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subject" >Name:</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter Test name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" placeholder="Enter Short Description" name="description" required>{{ old('description') }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create Test</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of all Tests for {{$course->name}}</h5>
                    @if($course->tests->count()>0)
                    <ul>
                        @foreach($course->tests as $test)
                            <li>{{ $test->name }}</li>
                        @endforeach
                    </ul>
                        @else
                        <p>No tests available for {{ $course->name }}</p>
                    @endif
                    
                  
                </div>
            </div>
        </div>
    </div>
@endsection