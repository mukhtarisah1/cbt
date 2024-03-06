@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1>{{ $test->title }}</h1>
        <p>Time Remaining: <span id="timer"></span></p>

        <!-- Display current question here -->
        <div class="question-container">
            <p>Question 1:</p>
            <p>{{ $questions[0]->text }}</p>
        </div>

        <!-- Navigation buttons -->
        <div class="navigation-buttons">
            <button class="btn btn-primary" id="prevBtn" disabled>Previous</button>
            <button class="btn btn-primary" id="nextBtn">Next</button>
        </div>
    </div>

    <script>
        // Timer logic
        var endTime = new Date("{{ $endTime }}").getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = endTime - now;

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";
                // You can add logic to automatically submit the test when the timer expires
            }
        }, 1000);

        // Navigation logic
        var currentQuestionIndex = 0;

        document.getElementById("nextBtn").addEventListener("click", function() {
            currentQuestionIndex++;
            showQuestion();
        });

        document.getElementById("prevBtn").addEventListener("click", function() {
            currentQuestionIndex--;
            showQuestion();
        });

        function showQuestion() {
            // Disable/enable navigation buttons based on the current question index
            document.getElementById("nextBtn").disabled = currentQuestionIndex === $questions.length - 1;
            document.getElementById("prevBtn").disabled = currentQuestionIndex === 0;

            // Display the current question
            document.querySelector('.question-container p:last-of-type').innerHTML = $questions[currentQuestionIndex].text;
        }
    </script>
@endsection