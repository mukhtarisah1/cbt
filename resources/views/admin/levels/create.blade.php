@extends('layouts.layout')

@section('content')
    <h2 class="border-bottom">Create Level</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('levels.store') }}" method="POST">
        @csrf
        <div class="col-md-6">                           
            <div class="form-group">
                <label for="name">Level Name:</label>
                <div class="">
                    <input type="text" name="level" class="form-control" value="{{ old('level') }}" placeholder="Enter level name" >
                </div>
            </div>
            <div class="form-group">
                <label for="name">Level Description:</label>
                <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Enter level description">
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Level</button>
    </form>
@endsection
