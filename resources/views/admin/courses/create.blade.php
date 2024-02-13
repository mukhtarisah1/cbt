@extends('layouts.layout')

@section('content')
<style>
    .colr{
        font:#00ad56 ;
    }
</style>
<div class="d-flex justify-content-md-center mb-3">
    <h4>Course Creation Page</h4>
</div>
    
    <div class="row">
        <div class="col col-md-8">
            <div id="base-style" class="card">
                
                <div class="card-body">
                    <fieldset>
                        <legend class=".colr">Create New Course</legend>
                    </fieldset>
                        <!-- Form to create a new course -->
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subject" >Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Course Name" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" >Slug:</label>
                            <input type="text" class="form-control" name="slug" placeholder="Enter Slug category i.e 'Mathematic'or 'English' ETC" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" placeholder="Enter A short Description" required>{{old('description')}}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of all Courses</h5>
                    @if($courses->isNotEmpty())
                    <ul>
                        @foreach($courses as $category => $courseGroup)
                            <li><strong>{{ $category }}</strong></li>
                            <ul>
                                @foreach($courseGroup as $course)
                                    <li>{{ $course->name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                        @else
                            <p>No courses available</p>
                    @endif
                    
                  
                </div>
            </div>
        </div>
    </div>
   
@endsection
