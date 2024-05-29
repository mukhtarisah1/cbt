@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Results for {{ $test->title }} in {{ $course->name }}</h5>
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('results.export.excel') }}" class="btn btn-success mr-2">
                    <i class="fas fa-file-excel"></i> Export to Excel
                </a>
                <a href="{{ route('results.export.pdf', ['test_id' => $test->id, 'course_id' => $course->id]) }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export to PDF
                </a>
            </div>
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
