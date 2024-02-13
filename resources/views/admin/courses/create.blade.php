@extends('layouts.layout')

@section('content')
    <div>
        welcome {{ Auth::user()->name }}
    </div>
    <div class="row justify-content-md-center">
        <div class="col col-md-8">
            <div id="base-style" class="card">
                
                <div class="card-body">
                    <fieldset>
                        <legend>Create New Course</legend>
                    </fieldset>
                        <!-- Form to create a new course -->
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subject" >Name:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection
