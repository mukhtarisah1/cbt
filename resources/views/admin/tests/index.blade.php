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
                                <th>SN</th>
                                <th>Course Name</th>
                                <th>Add Tests Questions</th>
                                <th>View Question</th>
                                <th>Assign Test</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $course->name }}</td>
                                    
                                    <td>
                                        @if($course->tests->count() > 0)
                                            
                                                @foreach($course->tests as $test)
                                                    <a href="{{route('courses.tests.questions.create', ['course' => $course->id, 'test' => $test->id])}}">
                                                        <li style="list-style-type: none;" class="mb-3 ml-0" data-toggle="tooltip" data-placement="left" title="click to add/edit questions">{{ $test->title }}</li></span>
                                                    </a>
                                                @endforeach
                                            
                                        @else
                                            No tests available
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if($course->tests->count() > 0)
                                            
                                                @foreach($course->tests as $test)
                                                    <a class="border-bottom" style="list-style-type: none;" href="{{route('courses.tests.show', ['course' => $course->id, 'test' => $test->id])}}"><li class="mb-3" data-toggle="tooltip" data-placement="left" title="click to view questions">View questions</li></a>
                                                @endforeach
                                            
                                        @else
                                            No tests available
                                        @endif
                                    </td>

                                    <td>
                                        @if($course->tests->count() > 0)
                                                
                                                @foreach($course->tests as $test)
                                                    <a style="list-style-type: none;" href="{{ route('courses.tests.assign.create', ['course' => $course->id, 'test' => $test->id]) }}"><li class="mb-3" data-toggle="tooltip" data-placement="left" title="click to add students to test">Add Students</li></a>
                                                @endforeach
                                            
                                        @else
                                            No tests available
                                        @endif
                                    </td>
                                       
                                    
                                    <td >
                                        @if($course->tests->count() > 0)
                                            
                                                @foreach($course->tests as $test)
                                                    <div class="mb-1">                        
                                                        <form action="{{ route('courses.tests.destroy', ['course' => $course->id, 'test' => $test->id]) }}" method="POST" style="display: inline;">
                                                            <a  href="{{ route('courses.tests.edit',['course' => $course->id, 'test' => $test->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit Test"><i class="fa fa-pencil-alt"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-icon btn-secondary" onclick="return confirm('Are you sure?')" data-toggle="tooltip" data-placement="top" title="Delete Test">
                                                            <i class="far fa-trash-alt"></i> <span class="sr-only">Remove</span></button>
                                                        </form>
                                                    </div>
                                                    
                                                @endforeach
                                            
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