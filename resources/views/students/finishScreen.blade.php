@extends('layouts.layout')

@section('content')
    <div class="container text-center" style="margin-top: 50px;">
        <h1 style="font-size: 3em; color: #4CAF50; font-weight: bold;">Thank You!</h1>
        <p style="font-size: 1.5em; color: #555;">Your submission was successful.</p>
           
        
        <a href="{{ route('logout') }}" class="btn btn-success" style="margin-top: 20px;">Logout</a>
    </div>
@endsection