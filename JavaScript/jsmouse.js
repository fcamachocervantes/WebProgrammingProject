const c = document.getElementById("myCanvas");
const ctx = c.getContext("2d");
const button = document.getElementById("toggleButton");
let isSmiling = true;

function drawFace() {
  ctx.beginPath();
  ctx.arc(500 / 2, 275, 200, 0, 2 * Math.PI);
  ctx.fillStyle = "yellow";
  ctx.strokeStyle = "black";
  ctx.lineWidth = "10";
  ctx.stroke();
  ctx.fill();

  ctx.beginPath();
  ctx.arc(500 / 3, 200, 25, 0, 2 * Math.PI);
  ctx.arc((2 * 500) / 3, 200, 25, 0, 2 * Math.PI);
  ctx.fillStyle = "blue";
  ctx.fill();

  if (isSmiling) {
    ctx.beginPath();
    ctx.arc(250, 300, 100, 2 * Math.PI, Math.PI);
    ctx.strokeStyle = "green";
    ctx.lineWidth = 5;
    ctx.stroke();
  } else {
    ctx.beginPath();
    ctx.arc(250, 400, 100, Math.PI, 2 * Math.PI);
    ctx.strokeStyle = "red";
    ctx.lineWidth = 5;
    ctx.stroke();
  }
}

function changeSmile() {
  isSmiling = !isSmiling;
  drawFace();
  button.innerText = isSmiling ? "Make me Smile" : "Make me Frown";
}

c.addEventListener("click", function(event) {
    const rect = c.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    const distanceToCenter = Math.sqrt(
        Math.pow(mouseX - 500/2, 2) + Math.pow(mouseY - 700/2, 2)
    );

    if (distanceToCenter <= 200) {
        changeSmile();
    }
});

button.addEventListener("click", changeSmile);

drawFace();
