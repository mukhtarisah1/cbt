<!-- resources/views/students/create.blade.php -->

@extends('layouts.layout')

@section('content')
<strong class="text-success"></strong>


    <div><h4><strong >Register</strong></h4></div>
    <div class="card col-md-8">
        
        <div class="card-body">
            
                <fieldset >
                    <legend class="border-bottom text-success">Add new Student</legend>
                </fieldset>
            
            
            <form action="{{ route('students.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="option_a">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter Student Name" autocomplete="off">
                    @error('name')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Enter Student Email" autocomplete="off">
                    @error('email')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Registration Number</label>
                    <input class="form-control" type="text" name="reg_no" placeholder="Enter Student Registration Number" >
                    @error('reg_no')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Level</label>
                    <input class="form-control" type="number" name="level" placeholder="Enter Student Level">
                    @error('level')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                

                <input type="submit" class="btn btn-success" value="Add Student">
            </form>
        </div>
    </div>

    @if (Session::has('success'))
        <p style="color:green">{{Session::get('success')}}</p>
    @endif


@endsection
    