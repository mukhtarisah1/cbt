@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1>{{ $test->title }}</h1>
        
        <p>Time Remaining: <span id="timer"></span></p>

        <!-- Display current question here -->
        <div id="question-container" class="question-container" data-index="0">
            <!-- Question content will be dynamically generated here -->
        </div>

        <!-- Navigation buttons -->
        <div class="navigation-buttons">
            <button class="btn btn-primary" id="prevBtn" disabled>Previous</button>
            <button class="btn btn-primary" id="nextBtn">Next</button>
        </div>
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
                <form>
                    <p><label><input type="radio" name="answer_${currentQuestionIndex}" value="A"> (A) ${question.option_a}</label></p>
                    <p><label><input type="radio" name="answer_${currentQuestionIndex}" value="B"> (B) ${question.option_b}</label></p>
                    <p><label><input type="radio" name="answer_${currentQuestionIndex}" value="C"> (C) ${question.option_c}</label></p>
                    <p><label><input type="radio" name="answer_${currentQuestionIndex}" value="D"> (D) ${question.option_d}</label></p>
                </form>
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
    }

    document.getElementById("nextBtn").addEventListener("click", function() {
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
