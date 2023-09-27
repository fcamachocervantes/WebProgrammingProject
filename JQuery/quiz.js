var canSelectQuestion = true;
var submittedAnswer;
var currentQuestion = "";
var numQuestionsAnswered = 0;

//constant strings for output
const correctString = "That is correct";
const wrongString = "That is wrong";

//handling when a user clicks a question button
function changeQuestion(event) {
  if (canSelectQuestion) {
    switch (event.value) {
      case "Italy":
        currentQuestion = "Italy";
        $("#questionText").text(
          "The Krakatoa eruption was the volcano that wiped out Pompeii"
        );
        break;
      case "Mexico":
        currentQuestion = "Mexico";
        $("#questionText").text(
          "The name for Mexico City in Nahuatl is Tenochtitlan"
        );
        break;
      case "Japan":
        currentQuestion = "Japan";
        $("#questionText").text(
          "There is a shrine at the top of Mount Fuji that the public can visit"
        );
        break;
      case "UnitedStates":
        currentQuestion = "UnitedStates";
        $("#questionText").text(
          "The United State has the most national parks in the world"
        );
        break;
      default:
        break;
    }
  } else {
    alert("Finish answer first.");
  }
}

//handling after a user answers a question
function setResultText(bool, questionName) {
  $("#resultText").removeClass();

  //displaying if the user answered correctly and updating question history
  if (bool) {
    $("#resultText").text(correctString);
    $("#resultText").addClass("correct");
    $("#questionHistoryList").append(
      "<li class='correct'>" + questionName + "</li>"
    );
  } else {
    $("#resultText").text(wrongString);
    $("#resultText").addClass("incorrect");
    $("#questionHistoryList").append(
      "<li class='incorrect'>" + questionName + "</li>"
    );
  }

  //correctly updating states of buttons so that the user isn't able to do strange edge cases
  $("#" + questionName).prop("disabled", true);
  $("#checkAnswer").prop("disabled", true);
  $("input[name=answer]:checked", "#answerForm").prop("checked", false);
  canSelectQuestion = true;

  //checking how many questions have been answered
  if (numQuestionsAnswered === 4) {
    finalMessage();
  }
}

//checking if the answer a user gave was correct or not and incrementing number of answered questions
function checkIfCorrect(bool) {
  numQuestionsAnswered += 1;
  switch (currentQuestion) {
    case "Italy":
      setResultText(!bool, "Italy");
      break;
    case "Mexico":
      setResultText(bool, "Mexico");
      break;
    case "Japan":
      setResultText(bool, "Japan");
      break;
    case "UnitedStates":
      setResultText(!bool, "UnitedStates");
      break;
    default:
      break;
  }
}

//getting the value of the answer the user gave and converting it from a string to a boolean
function submitAnswer() {
  submittedAnswer = $("input[name=answer]:checked", "#answerForm").val();
  let myBool = submittedAnswer.toLowerCase() === "true";
  checkIfCorrect(myBool);
}

//handling if check answer button is disabled or not
function allowAnswer() {
  if (!canSelectQuestion) {
    $("#checkAnswer").prop("disabled", false);
  }
}

//stop user from changing questions until they answer
function allowChanging(bool) {
  canSelectQuestion = bool;
}

function finalMessage() {
  // Move the box across the screen
  $(".box").animate({ left: "75%" }, 2000, function () {
    // Callback: Show the message and fade it in
    $(".message")
      .fadeIn(1000)
      .delay(1000) // Wait for 2 seconds
      .fadeOut(1000) // Fade out the message
      .delay(1000)
      .fadeIn(1000);
  });
}
