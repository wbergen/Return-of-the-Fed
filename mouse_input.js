// Mouse Input Handling
var mouseX, mouseY; // move to vars?
canvas.addEventListener("mousemove", checkMousePos);
canvas.addEventListener("mouseup", checkMouseClick);
canvas.addEventListener("touchstart", checkMouseClick)

// This may not work in all Browsers.. there is a fix for it...
function checkMousePos(e){
	mouseX = e.pageX - this.offsetLeft;
	mouseY = e.pageY - this.offsetTop;
	// console.log("X: " + mouseX + ", Y: " + mouseY);
}

// React to Mouse Click (we're in the Menu Loop)
// The event this is attached to is disabled by successful btn click
function checkMouseClick(e) {
	console.log("checking click...");
	for (var i = buttonX.length - 1; i >= 0; i--) {
		if (mouseX > buttonX[i] && mouseX < buttonX[i] + buttonWidth[i]) {
			if (mouseY > buttonY[i] && mouseY < buttonY[i] + buttonHeight[i]){
				// Got a button Click!
				var a = buttonAction[i];
				if (a === "play") {
					if (!GAME_OVER && !IN_MENU_SCREEN) {
						// Because im abusing the label boxes, disable this action at game over screen
						console.log("Main Menu: play clicked");
						fadeLoopId = setInterval(fadeOut, 100/3);
						clearInterval(menuLoopId);
						canvas.removeEventListener("mousemove", checkMousePos);
						canvas.removeEventListener("mouseup", checkMouseClick);
						PLAYING = true;
					}
				} else if (a === "highscores") {
					console.log("Main Menu: highscores clicked");
					if (!GAME_OVER && !IN_MENU_SCREEN){
						IN_MENU_SCREEN = true;
						get_highScores(); // async update collection
						highScoreLoopId = setInterval(drawHighScores, 100/3);
						clearInterval(menuLoopId);
					}
				} else if (a === "instructions") {
					console.log("Main Menu: instructions clicked");
					if (GAME_OVER) {
						// Game finished, main menu button clicked:
						clearInterval(gameLoopId);
						menuLoopId = setInterval(drawMenu, 100/3);
						// reset game vars:
						resetGame();
						// In case player didn't submit high score:
						$("#highScoreForm").remove();
					} else if (!GAME_OVER && !IN_MENU_SCREEN) {
						// Load Instructions loop:
						IN_MENU_SCREEN = true;
						insLoopId = setInterval(drawIns, 100/3);
						clearInterval(menuLoopId);
					}
				} else if (a === "insViewMainMenu" && IN_MENU_SCREEN) {
					console.log("HighScores/Instructions Screen: main menu clicked");
					clearInterval(insLoopId);
					clearInterval(highScoreLoopId);
					IN_MENU_SCREEN = false;
					menuLoopId = setInterval(drawMenu, 100/3);
				}

			}
		}
	}
}