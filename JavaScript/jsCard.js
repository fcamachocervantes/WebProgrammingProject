//constants for grabbing different document items/constants 
const textInput = document.getElementById("to_field");
const textOutput = document.getElementById("toField");

const imageDropDown = document.getElementById("picture");
const currentImage = document.getElementById("thePicture");

const myCollection = document.getElementsByClassName("you");

const canvas = document.getElementById("myCanvas");
const ctx = canvas.getContext("2d");

const image = new Image();
image.src = "images/crazycat.gif";

const canvasWidth = canvas.width;
const canvasHeight = canvas.height;
const imageWidth = image.width;
const imageHeight = image.height;
const stepX = 5;
const stepY = 5;

var currentX = 0;
var currentY = 0;

//text field handler
textInput.addEventListener("input", function(inputText) {
    textOutput.innerText = inputText.target.value;
});

//drop down menu handler
imageDropDown.addEventListener("click", function(event) {
    currentImage.src = "images/" + event.target.value + ".jpg";
    imageDropDown.blur();
})

//redrawing cat onto the canvas after clearing it
function drawCatAndText() {
    ctx.font = "15px serif";
    const message = "Here Kitty";
    const messageWidth = ctx.measureText(message).width;
    const messageHeight = ctx.measureText(message).fontBoundingBoxDescent;

    var diffx = canvasWidth - imageWidth;
    var diffy = canvasHeight - imageHeight;

    if(diffx - currentX <= stepX & diffy - currentY <= stepY) {
        for(let i = 0; i < myCollection.length; i++) {
            myCollection[i].style.color = "blue";
            myCollection[i].style.fontSize = "larger";
        }

        alert("The cat reached the text!");
    }

    ctx.clearRect(0, 0, canvasWidth, canvasHeight);
    ctx.drawImage(image, currentX, currentY);   
    ctx.fillText(message, canvasWidth - messageWidth, canvasHeight - messageHeight);
}

//code for moving image
document.onkeydown = function (e) {
    switch (e.key) {
        case "ArrowRight":
            if(currentX < canvasWidth - imageWidth) {
                currentX += stepX;
            }
            break;
        case "ArrowLeft":
            if(currentX > 0) {
               currentX -= stepX; 
            }
            break;
        case "ArrowDown":
            if(currentY < canvasHeight - imageHeight) {
                currentY += stepY;
            }
            break;
        case "ArrowUp":
            if(currentY > 0) {
                currentY -= stepY;
            }
            break;
        default:
            break;
    }
    drawCatAndText();
    console.log(e);
}

//calling so that the images are drawn when first loading page
drawCatAndText();






