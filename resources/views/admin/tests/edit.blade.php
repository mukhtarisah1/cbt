@extends('layouts.layout')

@section('content')

    <div class="row ">
        <div class="col col-md-8">
            <div id="base-style" class="card">
                
                <div class="card-body">
                    <fieldset>
                        <legend>Edit Test <span class="text-success"><i>{{ $test->name }}</i></span> for <span class="text-success"><i>{{ $course->name }}</i></span></legend>
                    </fieldset>
                        <!-- Form to create a new course -->
                    <form action="{{ route('courses.tests.update', [$course, $test]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="subject" >Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $test->name}}" placeholder="Enter Test name" autocomplete="off" >
                            @error('name')
                                <p style="color: red;">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subject" >Duration (minutes):</label>
                            <input type="number" class="form-control" name="duration" value="{{ $test->duration}}" placeholder="Enter duration in minutes" autocomplete="off" >
                            @error('duration')
                                <p style="color: red;">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" placeholder="Enter Short Description" name="description" required>{{ $test->description }}</textarea>
                            @error('description')
                                <p style="color: red;">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Edit Test</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of all Tests for {{$course->name}}</h5>
                    @if($course->tests->count()>0)
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th >Name</th>
                                <th >Duration</th>
                                <th>Questions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->tests as $test)
                                <tr>
                                    <td>{{ $test->name }}</td>
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