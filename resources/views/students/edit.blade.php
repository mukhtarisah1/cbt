<!-- resources/views/students/edit.blade.php -->


@extends('layouts.layout')

@section('content')
<strong class="text-success"></strong>


    <div><h4><strong >Register</strong></h4></div>
    <div class="card col-md-8">
        
        <div class="card-body">
            
                <fieldset >
                    <legend class="border-bottom text-success">Edit Student</legend>
                </fieldset>
            
            
            <form action="{{ route('students.update', $student) }}"  method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="option_a">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter Student Name" value="{{$student->name}}" autocomplete="off">
                    @error('name')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Enter Student Email" value="{{$student->email}}" autocomplete="off">
                    @error('email')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Registration Number</label>
                    <input class="form-control" type="text" name="reg_no" placeholder="Enter Student Registration Number"  value="{{$student->reg_no}}">
                    @error('reg_no')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Level</label>
                    <input class="form-control" type="number" name="level" placeholder="Enter Student Level" value="{{$student->level}}">
                    @error('level')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                

                <input type="submit" class="btn btn-success" value="Update Student">
            </form>
        </div>
    </div>

    @if (Session::has('success'))
        <p style="color:green">{{Session::get('success')}}</p>
    @endif


@endsection
    