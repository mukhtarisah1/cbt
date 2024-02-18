@extends('layouts.layout')

@section('content')
<strong class="text-success"></strong>


    <div><h4><strong >Register</strong></h4></div>
    <div class="card col-md-8">
        
        <div class="card-body">
            
                <fieldset >
                    <legend class="border-bottom">Add new Examiner</legend>
                </fieldset>
            
            
            <form action="{{route('adminRegister')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="option_a">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter Name">
                    @error('name')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Enter Email">
                    @error('email')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter Password">
                    @error('password')
                    <p style="color:red;">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="option_a">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" placeholder="Enter Confirm Password">
                </div>
                

                <input type="submit" class="btn btn-success" value="Register">
            </form>
        </div>
    </div>

    @if (Session::has('success'))
        <p style="color:green">{{Session::get('success')}}</p>
    @endif


@endsection
    