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
            
            <div id="placeholder-buttons" class="placeholder-buttons mt-20" style="margin-top: 20px">
                <!-- Placeholder buttons will be dynamically generated here -->
            </div>

            <div id="hidden-answers">
                <!-- Hidden inputs for all answers will be dynamically generated here -->
            </div>
        </form>    
    </div>

    <script>
    var currentQuestionIndex = 0;
    var remainingTime = {{ $remainingTime }};
    var questions = {!! json_encode($questions ?? []) !!};
    var answers = {}; // To keep track of selected answers

    function updateQuestionDisplay() {
        if (currentQuestionIndex < questions.length) {
            var questionContainer = document.getElementById("question-container");
            var question = questions[currentQuestionIndex];
            var answer = answers[question.id] || "";

            questionContainer.innerHTML = `
                <p><strong>Question ${currentQuestionIndex + 1}:</strong></p>
                <p>${question.question}</p>
                <input type="hidden" name="questions[${currentQuestionIndex}][id]" value="${question.id}">
                <input type="hidden" name="questions[${currentQuestionIndex}][correct_answer]" value="${question.correct_answer}">
                <input type="hidden" name="questions[${currentQuestionIndex}][option_a]" value="${question.option_a}">
                <input type="hidden" name="questions[${currentQuestionIndex}][option_b]" value="${question.option_b}">
                <input type="hidden" name="questions[${currentQuestionIndex}][option_c]" value="${question.option_c}">
                <input type="hidden" name="questions[${currentQuestionIndex}][option_d]" value="${question.option_d}">
                <p><label><input type="radio" name="questions[${currentQuestionIndex}][answer]" value="A" ${answer === "A" ? "checked" : ""}> (A) ${question.option_a}</label></p>
                <p><label><input type="radio" name="questions[${currentQuestionIndex}][answer]" value="B" ${answer === "B" ? "checked" : ""}> (B) ${question.option_b}</label></p>
                <p><label><input type="radio" name="questions[${currentQuestionIndex}][answer]" value="C" ${answer === "C" ? "checked" : ""}> (C) ${question.option_c}</label></p>
                <p><label><input type="radio" name="questions[${currentQuestionIndex}][answer]" value="D" ${answer === "D" ? "checked" : ""}> (D) ${question.option_d}</label></p>
            `;
            console.log(`Question displayed: ${currentQuestionIndex + 1}`);
        } else {
            console.log('No more questions to display.');
        }
    }

    function saveAnswer() {
    var currentQuestionId = questions[currentQuestionIndex].id;
    var answer = document.querySelector(`input[name="questions[${currentQuestionIndex}][answer]"]:checked`);
    if (answer) {
        answers[currentQuestionId] = answer.value;

        var hiddenAnswersContainer = document.getElementById('hidden-answers');
        var existingInput = document.querySelector(`input[name="questions[${currentQuestionIndex}][answer]"]`);
        if (existingInput) {
            existingInput.value = answer.value;
        } else {
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `questions[${currentQuestionIndex}][answer]`;
            hiddenInput.value = answer.value;
            hiddenAnswersContainer.appendChild(hiddenInput);
        }
    } else {
        answers[currentQuestionId] = null;
    }
}

function saveAllAnswers() {
    var hiddenAnswersContainer = document.getElementById('hidden-answers');
    hiddenAnswersContainer.innerHTML = ''; // Clear existing inputs to avoid duplicates
    for (let i = 0; i < questions.length; i++) {
        var question = questions[i];
        var answer = answers[question.id] || "";
        
        hiddenAnswersContainer.innerHTML += `
            <input type="hidden" name="questions[${i}][id]" value="${question.id}">
            <input type="hidden" name="questions[${i}][correct_answer]" value="${question.correct_answer}">
            <input type="hidden" name="questions[${i}][option_a]" value="${question.option_a}">
            <input type="hidden" name="questions[${i}][option_b]" value="${question.option_b}">
            <input type="hidden" name="questions[${i}][option_c]" value="${question.option_c}">
            <input type="hidden" name="questions[${i}][option_d]" value="${question.option_d}">
            <input type="hidden" name="questions[${i}][answer]" value="${answer}">
        `;
    }
}

document.getElementById("testForm").addEventListener("submit", function() {
    saveAnswer(); // Save the current question's answer before saving all answers
    saveAllAnswers(); // Ensure all answers are saved before submitting
});

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

    function updateTimer() {
        var now = new Date().getTime();
        var distance = remainingTime - (now - pageLoadTime);

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(timerInterval);
            document.getElementById("timer").innerHTML = "EXPIRED";
            document.getElementById("testForm").submit();
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

    document.getElementById("testForm").addEventListener("submit", function() {
        saveAllAnswers(); // Ensure all answers are saved before submitting
    });

    var pageLoadTime = new Date().getTime();
    showQuestion();
    createPlaceholderButtons();

    var timerInterval = setInterval(updateTimer, 1000);
    </script>
@endsection
