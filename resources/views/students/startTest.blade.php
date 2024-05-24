@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1>{{ $test->title }}</h1>
        
        <p>Time Remaining: <span id="timer"></span></p>

        <form id="testForm" action="{{ route('students.test.finish', ['test' => $test->id]) }}" method="post">
            @csrf
            <div id="question-container" class="question-container" data-index="0">
                <!-- Question content will be dynamically generated here -->
            </div>

            <div class="navigation-buttons">
                <button class="btn btn-primary" type="button" id="prevBtn" disabled>Previous</button>
                <button class="btn btn-primary" type="button" id="nextBtn">Next</button>
                <button class="btn btn-primary" id="submitBtn" type="submit" style="display: none;">Submit</button>
            </div>
            
            
            <div id="placeholder-buttons" class="placeholder-buttons mt-20" style="margin-top: 20px" >
                <!-- Placeholder buttons will be dynamically generated here -->
            </div>

            <div id="hidden-answers">
                <!-- Hidden inputs for all answers will be dynamically generated here -->
            </div>
        </form>    
    </div>

    <script>
    var currentQuestionIndex = 0;
    var endTime = new Date("{{ $endTime }}").getTime();
    var questions = {!! json_encode($questions ?? []) !!};
    var answers = {};

    function updateQuestionDisplay() {
        if (currentQuestionIndex < questions.length) {
            var questionContainer = document.getElementById("question-container");
            var question = questions[currentQuestionIndex];
            var answer = answers[question.id] || "";

            questionContainer.innerHTML = `
                <p><strong>Question ${currentQuestionIndex + 1}:</strong></p>
                <p>${question.question}</p>
                <input type="hidden" name="question_${currentQuestionIndex}" value="${question.id}">
                <p><label><input type="radio" name="answer_${question.id}" value="A" ${answer === "A" ? "checked" : ""}> (A) ${question.option_a}</label></p>
                <p><label><input type="radio" name="answer_${question.id}" value="B" ${answer === "B" ? "checked" : ""}> (B) ${question.option_b}</label></p>
                <p><label><input type="radio" name="answer_${question.id}" value="C" ${answer === "C" ? "checked" : ""}> (C) ${question.option_c}</label></p>
                <p><label><input type="radio" name="answer_${question.id}" value="D" ${answer === "D" ? "checked" : ""}> (D) ${question.option_d}</label></p>
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
            // Automatically submit the form if the timer expires
            document.getElementById("testForm").submit();
        }
    }

    function showQuestion() {
        updateQuestionDisplay();
        updateTimer();

        document.getElementById("prevBtn").disabled = currentQuestionIndex === 0;
        if (currentQuestionIndex >= questions.length - 1) {
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "inline-block";
        } else {
            document.getElementById("nextBtn").style.display = "inline-block";
            document.getElementById("submitBtn").style.display = "none";
        }
    }

    function saveAnswer() {
        var currentQuestionId = questions[currentQuestionIndex].id;
        var answer = document.querySelector(`input[name="answer_${currentQuestionId}"]:checked`);
        if (answer) {
            answers[currentQuestionId] = answer.value;

            // Update or create hidden input for the answer
            var hiddenAnswersContainer = document.getElementById('hidden-answers');
            var existingInput = document.querySelector(`input[name="answer_hidden_${currentQuestionId}"]`);
            if (existingInput) {
                existingInput.value = answer.value;
            } else {
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `answer_${currentQuestionId}`;
                hiddenInput.value = answer.value;
                hiddenAnswersContainer.appendChild(hiddenInput);
            }
        }
    }

    function navigateToQuestion(index) {
        saveAnswer();
        currentQuestionIndex = index;
        showQuestion();
        console.log(`Navigated to question index: ${currentQuestionIndex}`);
    }

    function createPlaceholderButtons() {
        var placeholderContainer = document.getElementById("placeholder-buttons");
        placeholderContainer.innerHTML = "";
        for (let i = 0; i < questions.length; i++) {
            var button = document.createElement("button");
            button.className = "btn btn-secondary";
            button.type = "button";
            button.textContent = i + 1;
            button.addEventListener("click", function() {
                navigateToQuestion(i);
            });
            placeholderContainer.appendChild(button);
        }
    }

    document.getElementById("nextBtn").addEventListener("click", function(e) {
        e.preventDefault();
        saveAnswer();
        currentQuestionIndex++;
        showQuestion();
        console.log(`Next button clicked. Current index: ${currentQuestionIndex}`);
    });

    document.getElementById("prevBtn").addEventListener("click", function() {
        saveAnswer();
        currentQuestionIndex--;
        showQuestion();
        console.log(`Previous button clicked. Current index: ${currentQuestionIndex}`);
    });

    showQuestion();
    createPlaceholderButtons();

    var timerInterval = setInterval(updateTimer, 1000);
    </script>
@endsection
