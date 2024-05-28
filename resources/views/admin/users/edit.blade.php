@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="form-group">
                <label for="is_admin">Admin</label>
                <input type="checkbox" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="reg_no">Reg No</label>
                <input type="text" name="reg_no" class="form-control" value="{{ $user->reg_no }}">
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <input type="number" name="level" class="form-control" value="{{ $user->level }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
