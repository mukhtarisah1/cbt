@extends('layouts.layout')

@section('content')
<div class="card text-center p-4">
    <div class="card-title"><h3 class="text-success">Welcome to your dasboard</h3></div>
    <div class="card-body">
    <h5>You have the following pending test(s), click on any to begin</h5>
    <div>
            <h6 class="mt-3">Your Assigned Tests:</h6>
            <ul>
                @forelse($testsId as $test)
                    <li class="mb-2" style="list-style-type: none;">
                        Test: {{ $test->test->title }}
                        <form action="{{ route('students.tests.startInstructions', ['test' => $test->test_id]) }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-primary">Take Test</button>
                        </form>
                    </li>
                @empty
                    <p>No tests assigned to you.</p>
                @endforelse
            </ul>
        </div>
    </div>

</div>
    

    
    
@endsection