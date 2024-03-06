@extends('layouts.layout')
@section('content')
@section('content')
    <div class="container">
        <h1>Test Instructions</h1>

        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="instructionsModal" tabindex="-1" role="dialog" aria-labelledby="instructionsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="instructionsModalLabel">Test Instructions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Test Title:</strong> {{ $test->title }}</p>
                        <p><strong>Test Duration:</strong> {{ $test->duration }} minutes</p>
                        <p><strong>Instructions:</strong></p>
                        <ul>
                            <li>This test consists of multiple-choice questions.</li>
                            <li>Read each question carefully before selecting an answer.</li>
                            <li>You have a total of {{ $test->duration }} minutes to complete the test.</li>
                            <li>Once you start the test, the timer will begin counting down.</li>
                            <li>Make sure you have a stable internet connection throughout the test.</li>
                            <!-- Add any additional instructions as needed -->
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="startTestBtn">Start Test</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Use jQuery to prevent the modal from closing when clicking outside
        $(document).ready(function() {
            $('#instructionsModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Add a click event listener to the "Start Test" button
            $('#startTestBtn').click(function() {
                window.location.href = "{{ route('students.test.start', $test) }}";
            });
        });
    </script>
@endsection