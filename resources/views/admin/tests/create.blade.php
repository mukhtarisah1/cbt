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
                            <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Enter Test name" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" >Duration (minutes): </label>
                            <input type="number" class="form-control" name="duration" value="{{old('duration')}}" placeholder="Enter duration in minutes" autocomplete="off" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description: </label>
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
                    @if($course->tests->count() > 0)
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th >Name</th>
                                <th >Duration</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->tests as $test)
                                <tr>
                                    <td>{{ $test->title }}</td>
                                    <td >{{ $test->duration }} minutes</td>
                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    
                  
                </div>
            </div>
        </div>
    </div>
@endsection