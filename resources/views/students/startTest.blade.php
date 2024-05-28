@extends('layouts.layout')
@section('content')
<style>
.calculator {
    position: fixed;
    top: 100px;
    right: 10px;
    width: 200px;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.calculator input {
    width: 100%;
    margin-bottom: 10px;
    text-align: right;
    padding: 5px;
    font-size: 1.2em;
}
.calc-buttons {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 5px;
}
.calc-btn {
    padding: 10px;
    background-color: #339933;
    color: #fff;
    border: none;
    font-size: 1em;
    cursor: pointer;
}
.calc-btn:hover {
    background-color: #0056b3;
}
</style>

    <div class="container">
        <h1>{{ $test->title }}</h1>
        
        <p>Time Remaining: <span id="timer"></span></p>

        <button id="toggleCalculatorBtn" class="btn btn-secondary mb-3">Toggle Calculator</button>
        <div id="calculator" class="calculator" style="display: none;">
            <input type="text" id="calcDisplay" disabled>
            <div class="calc-buttons">
                <button class="calc-btn" data-value="7">7</button>
                <button class="calc-btn" data-value="8">8</button>
                <button class="calc-btn" data-value="9">9</button>
                <button class="calc-btn" data-value="/">/</button>
                <button class="calc-btn" data-value="4">4</button>
                <button class="calc-btn" data-value="5">5</button>
                <button class="calc-btn" data-value="6">6</button>
                <button class="calc-btn" data-value="*">*</button>
                <button class="calc-btn" data-value="1">1</button>
                <button class="calc-btn" data-value="2">2</button>
                <button class="calc-btn" data-value="3">3</button>
                <button class="calc-btn" data-value="-">-</button>
                <button class="calc-btn" data-value="0">0</button>
                <button class="calc-btn" data-value=".">.</button>
                <button class="calc-btn" id="calcEqual" data-value="=">=</button>
                <button class="calc-btn" data-value="+">+</button>
                <button class="calc-btn" id="calcClear" data-value="C">C</button>
            </div>
        </div>

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

    // Calculator Toggle
    document.getElementById("toggleCalculatorBtn").addEventListener("click", function() {
        var calculator = document.getElementById("calculator");
        if (calculator.style.display === "none") {
            calculator.style.display = "block";
        } else {
            calculator.style.display = "none";
        }
    });

    // Calculator Functionality
    var calcDisplay = document.getElementById("calcDisplay");
    var calcButtons = document.querySelectorAll(".calc-btn");
    var calcValue = "";

    calcButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            var value = this.getAttribute("data-value");
            if (value === "=") {
                try {
                    calcValue = eval(calcValue) || "";
                } catch {
                    calcValue = "Error";
                }
            } else if (value === "C") {
                calcValue = "";
            } else {
                calcValue += value;
            }
            calcDisplay.value = calcValue;
        });
    });
    </script>
@endsection
