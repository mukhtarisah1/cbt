@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" require>
                @error('name')
                    <p style="color:red;">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                @error('email')
                    <p style="color:red;">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" value="">
                @error('password')
                    <p style="color:red;">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" value="">
                @error('password')
                    <p style="color:red;">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="is_admin">Admin</label>
                <input type="checkbox" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
            </div>
            
            <div class="form-group col-md-6">
                <label for="level">Level</label>
                <input type="number" name="level" class="form-control" value="{{ $user->level }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
