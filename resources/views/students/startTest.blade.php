@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1>{{ $test->title }}</h1>
        
        <p>Time Remaining: <span id="timer"></span></p>

        <!-- Display current question here -->
        <form id="testForm" action="{{ route('students.test.finish', ['test' => $test->id]) }}" method="post">
            @csrf
            <div id="question-container" class="question-container" data-index="0">
                <!-- Question content will be dynamically generated here -->
            </div>

            <!-- Navigation buttons -->
            <div class="navigation-buttons">
                <button class="btn btn-primary" type="button" id="prevBtn" disabled>Previous</button>
                <button class="btn btn-primary" type="button" id="nextBtn">Next</button>
                <button class="btn btn-primary" id="submitBtn" type="submit" style="display: none;">Submit</button>
            </div>
        </form>    
    </div>

    <script>
    var currentQuestionIndex = 0;
    var endTime = new Date("{{ $endTime }}").getTime();
    var questions = {!! json_encode($questions ?? []) !!};

    function updateQuestionDisplay() {
        if (currentQuestionIndex < questions.length) {
            var questionContainer = document.getElementById("question-container");
            var question = questions[currentQuestionIndex];

            questionContainer.innerHTML = `
                <p><strong>Question ${currentQuestionIndex + 1}:</strong></p>
                <p>${question.question}</p>
                <input type="hidden" name="question_${currentQuestionIndex}" value="${question.id}">
                <p><label><input type="radio" name="answer_${question.id}" value="A"> (A) ${question.option_a}</label></p>
                <p><label><input type="radio" name="answer_${question.id}" value="B"> (B) ${question.option_b}</label></p>
                <p><label><input type="radio" name="answer_${question.id}" value="C"> (C) ${question.option_c}</label></p>
                <p><label><input type="radio" name="answer_${question.id}" value="D"> (D) ${question.option_d}</label></p>
            `;
            console.log(`Question displayed: ${currentQuestionIndex + 1}`);
        } else {
            console.log('No more questions to display.');
        }
    }

    function updateTimer() {
        var now = new Date().getTime();
        var distance = endTime - now;

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(timerInterval);
            document.getElementById("timer").innerHTML = "EXPIRED";
            // You can add logic to automatically submit the test when the timer expires
            console.log("Timer expired");
        }
    }

    function showQuestion() {
        updateQuestionDisplay();
        updateTimer();

        // Disable/enable navigation buttons based on the current question index
        document.getElementById("prevBtn").disabled = currentQuestionIndex === 0;
        // Check if there are no more questions
        if (currentQuestionIndex >= questions.length -1) {
            // Show the Submit button when there are no more questions
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "inline-block";
        } else {
            // Show the Next button when there are more questions
            document.getElementById("nextBtn").style.display = "inline-block";
            document.getElementById("submitBtn").style.display = "none";
        }
    }

    document.getElementById("nextBtn").addEventListener("click", function(e) {
        e.preventDefault();
        currentQuestionIndex++;
        showQuestion();
        console.log(`Next button clicked. Current index: ${currentQuestionIndex}`);
    });

    document.getElementById("prevBtn").addEventListener("click", function() {
        currentQuestionIndex--;
        showQuestion();
        console.log(`Previous button clicked. Current index: ${currentQuestionIndex}`);
    });

    // Initial display
    showQuestion();

    // Timer interval
    var timerInterval = setInterval(updateTimer, 1000);
    </script>

@endsection
