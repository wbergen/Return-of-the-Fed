function drawHud() {
	// Draw hud over everything else, things on top of hud will follow:
	ctx.globalCompositeOperation = "source-over"; // seems to get opacity working in order..

	// Hud background:
	//  - black boxes to hide background..
	ctx.fillStyle = "black";
	ctx.fillRect(0,550,600,50);
	ctx.fillRect(0,530,150,40);
	ctx.fillRect(450,530,150,40);


	// Bars:
	// Health Bars:
	//  - + 1 condition to cover end of bars
	var health_color_string = "";
	for (var i = 0; i < Math.floor((parseInt(labelHealth.innerHTML)/100)*92) + 1; i++) {
		health_color_string = 'rgb(' + 1.75*(255 - Math.floor(255*(parseInt(labelHealth.innerHTML)/100))) + ',' + 1.75*Math.floor(255*(parseInt(labelHealth.innerHTML)/100)) + ', 0)';
		ctx.fillStyle = health_color_string;
		ctx.fillRect(imageHeart.width+11+(i*4), 580, 4, 15);
	}

	// Coin Bars:
	for (var i = 0; i < Math.floor((level_coins/coin_level_cap)*92); i++) {
		// var c_string = 'gold';
		var c_string = 'deepskyblue';
		ctx.fillStyle = c_string;
		ctx.fillRect(imageHeart.width+11+(i*4), 556, 4, 15);
	}


	ctx.fillStyle = "rgba(0,0,0,1.0";
	if (DAMAGED) {
		ctx.drawImage(imageHud_damaged, 0, 500);	
	} else {
		ctx.drawImage(imageHud, 0, 500);
	}

	// Clear damaged flag:
	DAMAGED = false;

	// Draw Stats section:
	// ctx.drawImage(imageHeart, 9,537); // good top slot coords
	ctx.drawImage(imageHeart, 9, 580);
	ctx.drawImage(imageCoinHud, 9, 558);
	ctx.font = "11px Digital Dream";
	ctx.textAlign = "left";
	ctx.fillStyle = "limegreen";

	// update these to be to the right..
	ctx.fillStyle = health_color_string;
	ctx.fillText(labelHealth.innerHTML, 411, 591); 		// Health #
	// ctx.fillStyle = "magenta";
	ctx.fillStyle = "deepskyblue";
	ctx.fillText(level_coins, 411, 567);				// Current # Coins
	ctx.fillText("Level: " + level, 10, 546);			// Current level
	ctx.fillText("SPACE $: " + total_coins, 460, 546);	// Total Coin #
}

function drawRotatingWeapon() {
	if(wepSize_t == wepSize){
		shipRotate = -2;
	}
	if(wepSize_t == 0){
		shipRotate = 2;
	}
	wepSize_t += shipRotate;
	ctx.beginPath();
	ctx.drawImage(rocketImageBig, wep_pos[0] - (wepSize_t/2), wep_pos[1], wepSize_t, rocketImageBig.height);
	ctx.closePath();	
}

function rotateAndDrawCoin(coin) {
	if (coin.w_temp == coin.width)	{
		coin.rotate = -2;
	}
	if (coin.w_temp == 0){
		coin.rotate =2;
	}
	coin.w_temp += coin.rotate
	// console.log(coin.move_n);
	ctx.drawImage(c_mvs[coin.move_n], coin.x - (coin.w_temp/2), coin.y, coin.w_temp, coin.img.height);
	coin.move_n = ((move_n+1) % c_mvs.length);
}

	function drawMenu() {
		// clear
	    ctx.clearRect(0, 0, canvas.width, canvas.height);
	    
	   	// Move/Draw Background:
		scrollBackground(false);
	    ctx.drawImage(backgroundImage, 0, backgroundY);

	    // Draw Buttons/Title:
	    ctx.drawImage(titleTitle, 0, 0);
		ctx.drawImage(titlePlay, buttonX[0], buttonY[0]);
		ctx.drawImage(titleHighScores, buttonX[1], buttonY[1]);
		ctx.drawImage(titleInstructions, buttonX[2], buttonY[2]);
	}

	function drawIns() {
		ctx.clearRect(0, 0, canvas.width, canvas.height);

		scrollBackground(false);
		ctx.fillStyle = "black";
		ctx.drawImage(backgroundImage, 0, backgroundY);
		ctx.drawImage(labelTextBackground, 0, 0);
		ctx.drawImage(labelMainMenu, buttonX[3], buttonY[3]);

		// The Text:
		ctx.font = "25px Johnny Fever";
		ctx.fillStyle = "rgba(21,70,200,1)";
		var t = "The Fed have returned, and they're particularly jolly.  Use the arrow keys to navigate your prub, and blast all agents of the deep moneyz by using the space bar to fire missiles.";

		var t2 = "Unfortunately, your prub isn't too well armed!  Be on the lookout for useful items. Remember, The Fed is fat, and obviously that has trickled down to their lackies...  Collect their ill-gotten gains and buy upgrades!"

		wrapText(t, 100, 100, 400, 24);
		wrapText(t2, 100, 300, 400, 24);


	}

	function drawHighScores() {
		ctx.clearRect(0, 0, canvas.width, canvas.height);

		scrollBackground(false);
		ctx.fillStyle = "black";
		ctx.drawImage(backgroundImage, 0, backgroundY);
		ctx.drawImage(labelTextBackground, 0, 0);
		ctx.drawImage(labelMainMenu, buttonX[3], buttonY[3]);

		// The Title:
		// ctx.font = "20px Johnny Fever";
	
		ctx.fillStyle = "limegreen";
		ctx.font = "45px Johnny Fever";
		for (var i = 0; i < highscores.length; i++) {
			ctx.fillText(highscores[i]["fldName"], 65, 65 + (i*45))
		}

		ctx.fillStyle = "darkorange";
		ctx.font = "45px Johnny Fever";
		for (var i = 0; i < highscores.length; i++) {
			ctx.fillText(highscores[i]["fldScore"], 500, 65 + (i*45))
		}
		// console.log(highscores)
	}

	function drawBreak() {
		// ctx.clearRect(0, 0, canvas.width, canvas.height);

		scrollBackground(false);
		ctx.fillStyle = "rgba(0,0,0,0.5)";
		// ctx.drawImage(backgroundImage, 0, backgroundY);
		// ctx.drawImage(labelTextBackground, 0, 0);
		ctx.fillRect(50,50,500,400);
		// ctx.drawImage(labelMainMenu, buttonX[3], buttonY[3]);

		// The Text:
		ctx.font = "50px Johnny Fever";
		ctx.fillStyle = "limegreen";
		ctx.fillText("Alright Level 5!", 100, 120);
		ctx.font = "20px Johnny Fever";
		ctx.fillStyle = "rgba(21,70,200,1)";
		var t = "Well done punishing those pesky minions of oversight!  Maybe you'll yet grow a mustache...";

		var t2 = "Press Fire to Continue...!"

		wrapText(t, 100, 200, 400, 24);
		wrapText(t2, 100, 300, 400, 24);

	    // SpaceBar End:
	    if (spacePressed) {

	    	spacePressed = false;
	    	clearInterval(breakLoopId);
			fadeLoopId = setInterval(fadeOutFromBreak, 100/3);
			
	    }


	}

	// I'm guessin' this is copypasta, based just on the indents..
	function wrapText(text, x, y, maxWidth, lineHeight) {
        var words = text.split(' ');
        var line = '';

        for(var n = 0; n < words.length; n++) {
          var testLine = line + words[n] + ' ';
          var metrics = ctx.measureText(testLine);
          var testWidth = metrics.width;
          if (testWidth > maxWidth && n > 0) {
            ctx.fillText(line, x, y);
            line = words[n] + ' ';
            y += lineHeight;
          }
          else {
            line = testLine;
          }
        }
        ctx.fillText(line, x, y);
    }

function drawHighScoreForm() {

	$form = $('<form id="highScoreForm"></form>');
	$form.append('<input type="text" name="name" value="Freddy_H" id="highScore_name_input" placeholder="Enter Your Name" maxlength="15" autocomplete="off">');
	$form.append('<br>');
	$form.append('<input type="button" value="GO!" onclick="send_highScore()">');
	$('#window').append($form);
	$('#highScoreForm').css({"z-index":"500", "position": "absolute"});
	var canvas_coords = $('#myCanvas').offset();
	$('#highScoreForm').css({top: canvas_coords.top + (canvas.height/2) -30, left: canvas_coords.left + (canvas.width/2) - 200});

	// form action -> send ajax to score.php
}

function send_highScore(){
	$n = $("#highScore_name_input").val();
	$json = JSON.stringify({name:$n, score:getScore(), key:"9c9d2551d97f1649420686aea3f91aa4"});
	console.log("Sending " + $json);
	$.post("https://m7c1.com/score.php", $json);
	// Remove the form:
	// UNCOMMENT ME!
	$("#highScoreForm").remove();
	// reset the game... (show high score would happen here?)
	// maybe show scores to the side all the time?

	// For now, same logic as if 'Main Menu' was clicked:
	clearInterval(gameLoopId);
	menuLoopId = setInterval(drawMenu, 100/3);
	// reset game vars:
	resetGame();
}

function get_highScores() {
	// Get HighScore infos:
	$.ajax({
	  method: "GET",
	  url: "https://m7c1.com/get_top10.php"
	}) 
	// .done(function(data){
	// 	console.log("top10 DONE");
	//     console.log(data);
	// })
	.success(function(data){
		console.log("[get_highScores] success fired");
		highscores = JSON.parse(data);
		console.log(highscores);
	})
}

function update_highScores(data) {
	console.log(data);
}

// Disable Enter Key default behavior:
// From https://stackoverflow.com/questions/5629805/disabling-enter-key-for-form
$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});