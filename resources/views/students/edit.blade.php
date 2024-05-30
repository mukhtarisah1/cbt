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
                        <label for="option_a">First Name</label>
                        <input class="form-control" type="text" name="firstname" placeholder="Enter Student First Name" value="{{$student->firstname}}" autocomplete="off">
                        @error('first_name')
                        <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="option_a">Last Name</label>
                        <input class="form-control" type="text" name="lastname" placeholder="Enter Student Last Name" value="{{$student->lastname}}" autocomplete="off">
                        @error('last_name')
                        <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="option_a">Middle Name</label>
                        <input class="form-control" type="text" name="middlename" placeholder="Enter Student Middle Name" value="{{$student->middlename}}" autocomplete="off">
                        @error('middle_name')
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
                        <input class="form-control" type="text" name="reg_no" value="{{$student->reg_no}}" placeholder="Enter Student Registration Number" >
                        @error('reg_no')
                        <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="custom-select" name="level">
                            <option value="" disabled>Select Student Level</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->level }}" {{ (old('level') ?? $student->level) == $level->level ? 'selected' : '' }}>
                                    {{ $level->level }}
                                </option>
                            @endforeach
                        </select>
                        @error('level')
                            <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-success" value="Edit Student">
            </form>
        </div>
    </div>

    @if (Session::has('success'))
        <p style="color:green">{{Session::get('success')}}</p>
    @endif


@endsection
    