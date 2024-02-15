@extends('layouts.layout')

@section('content')
    <div class="row ">
        <div class="col ">
            <div id="base-style" class="card">
                
                <div class="card-body border">
                    <fieldset>
                        <legend class="text-success border-bottom">List of All Courses with test</legend>
                    </fieldset>
                    <table class="table table-hover table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Course Name</th>
                                <th>Tests</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    
                                    <td>{{ $course->name }}</td>
                                    
                                    <td>
                                        @if($course->tests->count() > 0)
                                            <ul>
                                                @foreach($course->tests as $test)
                                                    <li class="mb-3">{{ $test->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            No tests available
                                        @endif
                                    </td>
                                    <td >
                                        @if($course->tests->count() > 0)
                                            <ul >
                                                @foreach($course->tests as $test)
                                                    <div class="mb-1">                        
                                                        <form action="{{ route('courses.tests.destroy', ['course' => $course->id, 'test' => $test->id]) }}" method="POST" style="display: inline;">
                                                            <a  href="{{ route('courses.tests.edit',['course' => $course->id, 'test' => $test->id]) }}" ><i class="fa fa-pencil-alt"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-icon btn-secondary" onclick="return confirm('Are you sure?')"><i class="far fa-trash-alt"></i> <span class="sr-only">Remove</span></button>
                                                        </form>
                                                    </div>
                                                    
                                                @endforeach
                                            </ul>
                                        @else
                                            No tests available
                                        @endif
                                        
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    


@endsection