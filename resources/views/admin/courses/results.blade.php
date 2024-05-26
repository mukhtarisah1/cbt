@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Results for {{ $test->title }} in {{ $course->name }}</h5>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Test Name</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->student->firstname }} {{ $result->student->lastname }}</td>
                            <td>{{ $result->test->title }}</td>
                            <td>{{ $result->score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
