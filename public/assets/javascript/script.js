$(document).ready(function () {
  var currentStep = 0;
  var steps = $(".form-step");
  var progressBar = $(".progress-bar");

  function updateProgress() {
    var progress = ((currentStep + 1) / steps.length) * 100;
    progressBar.css("width", progress + "%");
  }

  function showStep(step) {
    steps.hide();
    steps.eq(step).show();
  }

  function nextStep() {
    if (currentStep < steps.length - 1) {
      currentStep++;
      showStep(currentStep);
      updateProgress();
    }
  }

  function prevStep() {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
      updateProgress();
    }
  }

  $(".next-step").click(function (e) {
    e.preventDefault(); // Prevent the default form submission behavior
    nextStep();
  });

  $(".prev-step").click(function (e) {
    e.preventDefault(); // Prevent the default form submission behavior
    prevStep();
  });

  showStep(currentStep);
  updateProgress();
});
