let boxes = document.querySelectorAll(".box");
let resetBtn = document.querySelector("#reset-btn");
let newGameBtn = document.querySelector("#new-btn");
let msgContainer = document.querySelector(".msg-container");
let msg = document.querySelector("#msg");
let winSound = document.getElementById('winSound');
let moveSound = document.getElementById('moveSound');
let drawSound = document.getElementById('drawSound');
let roundCountElem = document.getElementById('round-count');
let playerOWinsElem = document.getElementById('playerO-wins');
let playerXWinsElem = document.getElementById('playerX-wins');

let turnO = true; // playerX, playerO
let count = 0; // To track draw
let roundCount = 1; // To track rounds
let playerOWins = 0; // To track player O wins
let playerXWins = 0; // To track player X wins

const winPatterns = [
  [0, 1, 2],
  [0, 3, 6],
  [0, 4, 8],
  [1, 4, 7],
  [2, 5, 8],
  [2, 4, 6],
  [3, 4, 5],
  [6, 7, 8],
];

const resetGame = () => {
  turnO = true;
  count = 0;
  enableBoxes();
  msgContainer.classList.add("hide");
  roundCount++;
  roundCountElem.innerText = roundCount;
};

boxes.forEach((box) => {
  box.addEventListener("click", () => {
    if (turnO) {
      // playerO
      box.innerText = "O";
      turnO = false;
    } else {
      // playerX
      box.innerText = "X";
      turnO = true;
    }
    box.disabled = true;
    count++;

    let isWinner = checkWinner();

    if (count === 9 && !isWinner) {
      gameDraw();
    }

    moveSound.play(); // Play move sound
  });
});

const gameDraw = () => {
  msg.innerText = `Game was a Draw.`;
  msgContainer.classList.remove("hide");
  disableBoxes();
  drawSound.play(); // Play draw sound
};

const disableBoxes = () => {
  for (let box of boxes) {
    box.disabled = true;
  }
};

const enableBoxes = () => {
  for (let box of boxes) {
    box.disabled = false;
    box.innerText = "";
  }
};

const showWinner = (winner) => {
  msg.innerText = `Congratulations, Winner is ${winner}`;
  msgContainer.classList.remove("hide");
  disableBoxes();
  winSound.play(); // Play win sound
  if (winner === 'O') {
    playerOWins++;
    playerOWinsElem.innerText = playerOWins;
    if (playerOWins === 3) {
      alert("Player O is the overall winner!");
    }
  } else {
    playerXWins++;
    playerXWinsElem.innerText = playerXWins;
    if (playerXWins === 3) {
      alert("Player X is the overall winner!");
    }
  }
};

const checkWinner = () => {
  for (let pattern of winPatterns) {
    let pos1Val = boxes[pattern[0]].innerText;
    let pos2Val = boxes[pattern[1]].innerText;
    let pos3Val = boxes[pattern[2]].innerText;

    if (pos1Val != "" && pos2Val != "" && pos3Val != "") {
      if (pos1Val === pos2Val && pos2Val === pos3Val) {
        showWinner(pos1Val);
        return true;
      }
    }
  }
};

newGameBtn.addEventListener("click", resetGame);
resetBtn.addEventListener("click", () => {
  roundCount = 1;
  playerOWins = 0;
  playerXWins = 0;
  roundCountElem.innerText = roundCount;
  playerOWinsElem.innerText = playerOWins;
  playerXWinsElem.innerText = playerXWins;
  resetGame();
});
