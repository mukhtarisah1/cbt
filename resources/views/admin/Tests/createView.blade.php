<!-- resources/views/courses/index.blade.php -->
@extends('layouts.layout')

@section('content')
    <div>
        
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<div class="card">
    <div class="card-body">
    <a href="#" ><h6>Create a Test under a course</h6></a>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            
            <th> SN</th>
            <th>Name</th>
            <th>Description</th>
            <th>Slug</th>
            <th>Actions</th>
            
            <!-- Add other fields as needed -->
            
        </tr>
        @forelse ($courses as $course)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $course->name }}</td>               
                <td>{{ $course->description }}</td>
                <td>{{ $course->slug }}</td>
                
                
                <!-- Add other fields as needed -->
                <td>
                    <a href="{{route('courses.tests.create', $course->id)}}">Add Test</a>
                </td>
            </tr>
        @empty
            
               <p>No Courses created yet.</p> 
            
        @endforelse


    </table>
    </div>
</div>
   

@endsection
