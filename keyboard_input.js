// Keyboard input handling
document.addEventListener("keydown", keyDownHandler, false);
document.addEventListener("keyup", keyUpHandler, false);
// document.addEventListener("keypress", keyPressHandler, false);

// Move these to vars?
var labelScore = document.getElementById("labelScore");
var labelHealth = document.getElementById("labelHealth");

// Prevent default keyhandling here
window.addEventListener("keydown", function(e) {
    // space and arrow keys
    if([32, 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
        e.preventDefault();
    }
}, false);

// Key handler switches
function keyDownHandler(e) {
    if(e.keyCode == 39) {
        rightPressed = true;
    } else if(e.keyCode == 37) {
        leftPressed = true;
    } else if(e.keyCode == 32) {
    	spacePressed = true;
    } else if(e.keyCode == 38) {
    	upPressed = true;
    } else if(e.keyCode == 40) {
    	downPressed = true;
    }
}

function keyUpHandler(e) {
    if(e.keyCode == 39) {
        rightPressed = false;
    } else if(e.keyCode == 37) {
        leftPressed = false;
    } else if(e.keyCode == 32) {
    	spacePressed = false;
    } else if(e.keyCode == 38) {
    	upPressed = false;
    } else if(e.keyCode == 40) {
    	downPressed = false;
    }
}