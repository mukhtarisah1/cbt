<!-- resources/views/students/create.blade.php -->

@extends('layouts.layout')

@section('content')
<strong class="text-success"></strong>


    <div><h4><strong >Register</strong></h4></div>
    <div class="row justify-content-around">
        <div class="card col-md-6">
            
            <div class="card-body">
                
                    <fieldset >
                        <legend class="border-bottom text-success">Add new Student</legend>
                    </fieldset>
                
                
                <form action="{{ route('students.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="option_a">First Name</label>
                        <input class="form-control" type="text" name="firstname" placeholder="Enter Student First Name" value="{{old('firstname')}}" autocomplete="off">
                        @error('first_name')
                        <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="option_a">Last Name</label>
                        <input class="form-control" type="text" name="lastname" placeholder="Enter Student Last Name" value="{{old('lastname')}}" autocomplete="off">
                        @error('last_name')
                        <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="option_a">Middle Name</label>
                        <input class="form-control" type="text" name="middlename" placeholder="Enter Student Middle Name" value="{{old('middlename')}}" autocomplete="off">
                        @error('middle_name')
                        <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="option_a">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Enter Student Email" value="{{old('email')}}" autocomplete="off">
                        @error('email')
                        <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="option_a">Registration Number</label>
                        <input class="form-control" type="text" name="reg_no" value="{{old('reg_no')}}" placeholder="Enter Student Registration Number" >
                        @error('reg_no')
                            <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="custom-select" name="level">
                            <option value="" disabled selected>Select Student Level</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->level }}" {{ old('level') == $level->level ? 'selected' : '' }}>
                                    {{ $level->level }}
                                </option>
                            @endforeach
                        </select>
                        @error('level')
                            <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                    

                    <input type="submit" class="btn btn-success" value="Add Student">
                </form>
            </div>
        </div>
        <div class="card col-md-5 " style="height:75%">
        <form class="" method="POST" action="{{ route('students.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body ">
                <h5 class="card-title text-success">CSV Upload</h5>
                <p class="card-text">To upload a list of students from an excel document, prepare the document in the structure as indicated below.<br>
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Name</th><th>Email</th><th>reg_no</th><th>Level</th></tr>
                    </thead>
                    <tbody>
                        <td>William henry</td><td>harrison@example.com</td><td>123456789</td><td>100</td>
                    </tbody>
                </table>      
                
                </p>
                <div class="form-group">
                    <label for="">File Input</label>
                    <div class="custom-file">
                        
                        <input type="file" class="custom-file-input" name="excel_file" accept=".csv, .xlsx, .txt" id="tf3" multiple=""> 
                        <label class="custom-file-label" for="tf3">Choose file</label>
                        @error('excel_file')
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
                
            </div>
        </form>
        </div>
    </div>
    

    @if (Session::has('success'))
        <p style="color:green" class="alert alert-success">{{Session::get('success')}}</p>
    @endif
    @if (Session::has('error'))
        <p style="color:green" class="alert alert-danger">{{Session::get('error')}}</p>
    @endif


@endsection
    