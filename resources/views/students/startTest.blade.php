@extends('layouts.layout')
@section('content')
@section('content')
    <div class="container">
        <h1>Test Instructions</h1>

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
                        <!-- Add your instructions content here -->
                        <p>These are the instructions for the test...</p>
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
                window.location.href = "{{ route('start.test', $test) }}";
            });
        });
    </script>
@endsection