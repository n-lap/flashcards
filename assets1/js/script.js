var contentArray = [];
flashcardMaker = (text, delThisIndex) => {
  const flashcard = document.createElement("div");
  const question = document.createElement("div");
  const answer = document.createElement("div");
  const del = document.createElement("button");

  flashcard.className = "card text-center bg-light mx-3 mt-3";
  flashcard.setAttribute("style", "min-height: 200px; min-width: 380px;");

  question.setAttribute("class", "card-title mt-3");
  question.setAttribute("style", "border-bottom: 1px solid green;");
  question.textContent = text[0];

  answer.setAttribute("class", "card-text");
  answer.setAttribute("style", "color: green; display: none;");
  answer.textContent = text[1];

  del.className = "btn btn-success btn-sm position-absolute";
  del.setAttribute("style", "right: 10px; bottom: 10px;");
  del.textContent = "Delete";
  del.addEventListener("click", () => {
    contentArray.splice(delThisIndex, 1);
    deleteFlashcard(question.textContent, answer.textContent);
    window.location.reload();
  });

  flashcard.appendChild(question);
  flashcard.appendChild(answer);
  flashcard.appendChild(del);

  flashcard.addEventListener("click", () => {
    if (answer.style.display == "none") answer.style.display = "block";
    else answer.style.display = "none";
  });

  document.querySelector("#flashcards").appendChild(flashcard);
};

$.ajax({
  url: "vendor/readcard.php",
  type: "POST",
  dataType: "json",
  success(data) {
    if (data.status) {
      contentArray = data.items;     
      contentArray.forEach(flashcardMaker);
      console.log(contentArray);
    } else {
      alert(`${data.message}`);
    }
  },
});



document.getElementById("save_card").addEventListener("click", () => {
  const question = document.querySelector("#question");
  const answer = document.querySelector("#answer");
  if (isValidCard(question.value, answer.value)) {
    saveFlashcard(question.value, answer.value);
    window.location.reload();
  }
});

function isValidCard(question, answer) {
  if (question === "") {
    $(`textarea[id="question"]`).addClass("is-invalid");
  } else if (answer === "") {
    $(`textarea[id="answer"]`).addClass("is-invalid");
  } else {
    $(`textarea[id="answer"]`).removeClass("is-invalid");
    $(`textarea[id="question"]`).removeClass("is-invalid");
    return true;
  }
  return false;
}

document.getElementById("show_card_box").addEventListener("click", () => {
  document.getElementById("create_card").style.display = "block";
});

document.getElementById("close_card_box").addEventListener("click", () => {
  document.getElementById("create_card").style.display = "none";
});



addFlashcard = () => {
  const question = document.querySelector("#question");
  const answer = document.querySelector("#answer");
  let flashcard_info = {
    my_question: question.value,
    my_answer: answer.value,
  };

  contentArray.push(flashcard_info);
  flashcardMaker(
    contentArray[contentArray.length - 1],
    contentArray.length - 1
  );

  question.value = "";
  answer.value = "";
};

deleteFlashcard = (question, answer) => {
  $.ajax({
    url: "vendor/deletecard.php",
    type: "POST",
    dataType: "json",
    data: {
      question: question,
      answer: answer,
    },
    success(data) {
      if (data.status) {
      } else {
        alert(`Данные не удалены из БД: ${data.message}`);
      }
    },
  });
};

saveFlashcard = (question, answer) => {
  $.ajax({
    url: "vendor/savecard.php",
    type: "POST",
    dataType: "json",
    data: {
      question: question,
      answer: answer,
    },
    success(data) {
      if (data.status) {
        addFlashcard();
      } else {
        alert(`${data.message}`);
      }
    },
  });
};
