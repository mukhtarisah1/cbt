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
    <a href="{{ route('courses.create') }}"><h6>Create New Course</h6></a>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            
            <th> SN</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
            
            <!-- Add other fields as needed -->
            
        </tr>
        @forelse ($courses as $course)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->description }}</td>
                
                
                
                <!-- Add other fields as needed -->
                <td>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                        
                        <a href="{{ route('courses.edit', $course->id) }}"><i class="fa fa-pencil-alt"></i> <span class="sr-only">Edit</span></a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-icon btn-secondary" onclick="return confirm('Are you sure you want to delete this record?')" type="submit"><i class="far fa-trash-alt"></i> <span class="sr-only">Remove</span></button>
                    </form>
                </td>
            </tr>
        @empty
            
               <p>No Courses created yet.</p> 
            
        @endforelse


    </table>
    </div>
</div>
   

@endsection
