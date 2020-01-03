<!DOCTYPE html>
<html lang="en">
<head>
	<script src="//code.jquery.com/jquery-latest.min.js"></script>
	<meta charset="utf-8"/>
	<title>Return of the Fed</title>
</head>


<?php

session_start();

// require_once '../actions/pFuncs.php';
// require_once '../actions/sFuncs.php';
// require_once '../actions/qFuncs.php';


// setup fake player, till we have user -> player connection
$player = "freddyh";

// get players coins:
// 	function my_query_get_value($tbl, $field, $where, $arg1) {

// $coins = my_query_get_value("tblPlayer", "fldCoins", "fldHandle", "$player");
$coins = 100;


// Logics
	// if (isset($_POST['addCoin'])){
	// 	// echo "Adding a coin!";
	// 	// 	function my_query_update($tbl, $flds, $vals, $where, $cond) {

	// 	my_query_update("tblPlayer", ["fldCoins"], [$coins+1], "fldHandle", "'$player'");
	// 	$coins++;
	// }

	// if (isset($_POST['removeCoin'])){
	// 	if ($coins > 0){
	// 		my_query_update("tblPlayer", ["fldCoins"], [$coins-1], "fldHandle", "'$player'");
	// 		$coins--;
	// 	}
	// }

?>

<style type="text/css">

	@font-face {
		font-family: 'Johnny Fever';
		src: url('resources/johnny fever.woff') format('woff'),
			 url('resources/johnnyfever.ttf') format('ttf');
	}

	@font-face {
		font-family: "Digital Dream";
		src: url('resources/DIGITALDREAM.woff') format('woff'),
			 url('resources/DIGITALDREA.ttf') format('ttf');
	}

	#highScoreForm input {
		/*  glow from https://css-tricks.com/snippets/css/glowing-blue-input-highlights/*/
		box-shadow: 0 0 5px rgba(81, 203, 238, 1);
		padding: 3px 0px 3px 3px;
		margin: 5px 1px 3px 0px;
		border: 3px solid rgba(81, 203, 238, 1);
		font: 25px "Digital Dream";
		font-weight: bold;
		color: darkorange;
		background-color: rgba(0,0,0,0.9);
		text-align: center;
	}

	/* high score name input:; */
	#highScoreForm input:first-child {
		width: 400px;
	}

	/*high score submit button*/
	#highScoreForm input:not(:first-child) {
		float: right;
		margin-top: 33px;
	}

	/*high score submit button HOVER*/
	#highScoreForm input:not(:first-child):hover {
		box-shadow: 0 0 15px rgba(81, 203, 238, 1);
	}
	
	#window {
		height: 100%;
		display: grid;
	}

	#topbar {
		width: 100%;
		padding-bottom: 5px;
		display: inline-block;
	}

	#bottombar {
		padding-top: 5px;
		width: 100%;
		display: inline-block;
		/*position: fixed;*/
	}

	#labelCoins {
		float: right;
	}

	#labelScore {
		float: right;
		padding-right: 50px;
	}

	#labelHealth {
		float: right;
		padding-right: 50px;
	}

	li {
		/*display: inline;*/
	}

	canvas { 
		background: #eee; 
		display: block; 
		margin: 0 auto;

		/*width: 700px;*/
		/*height: 700px;*/
	}

	.actions {
		/*width: 100%;*/
		height: 100%;
		background-color: var(--primary-color);
		color: var(--main-color);
		/*padding: 14px 20px;*/
		/*margin: 8px 0;*/
		/*border: none;*/
		border-radius: 4px;
		cursor: pointer;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		float: left;
	}
	.actions:hover {
		/*background-color: var(--primary-mouse-over-color);*/
		box-shadow: inset 0 0 2px var(--main-color);

	}

	.actions:focus {
		box-shadow: inset 0 0 2px var(--main-color);

	}

	.actions:focused {
		box-shadow: inset 0 0 10px var(--main-color);

	}

	img {
		height: 20px;
		width: 20px;
		float: right;
		padding-right: 5px;
	}


</style>

<!-- reload.. or something -->
<div id='window'>
	<div id='topbar'>
		<div id="labelCoins"><?php echo $coins; ?></div>
		<img src="imgs/coin2.png">
		<b><div id="labelScore">0</div></b>
		<!-- <div style="float: right; padding-right: 5px;">Score:</div> -->
		<b><div id="labelHealth">100</div></b>
		<img src="imgs/heart.png">
		<div id='labelHandle'><?php echo "Welcome <b>$player</b>"; ?></div>
	</div>


	<canvas id="myCanvas"></canvas>


<!-- 	<div id='bottombar' style="display: none;">
		<form method="post">
			<input class="actions" type="submit" name="addCoin" value="Add 1 Coin">
			<input class="actions" type="submit" name="removeCoin" value="Remove 1 Coin">
		</form>
	</div> -->

</div>


<script type="text/javascript">
	var canvas = document.getElementById("myCanvas");
	var ctx = canvas.getContext("2d");

	canvas.height = 600;
	canvas.width = 600;


	<?php 
		// Load JS components with require for lols...
		require_once 'load_resources.js';
		require_once 'vars.js';
	?>


	/* Setup Initially displayed components 'onload' */
	//  - Load Menu Items + BG:
	titleTitle.onload = function() {
		ctx.drawImage(titleTitle, 0,0);
	}

	background.onload = function() {
		ctx.drawImage(background, 0, 0);
	}

	titlePlay.onload = function() {
		ctx.drawImage(titlePlay, buttonX[0], buttonY[0]);
	}

	titleHistory.onload = function() {
		ctx.drawImage(titleHistory, buttonX[1], buttonY[1]);
	}

	titleInstructions.onload = function() {
		ctx.drawImage(titleInstructions, buttonX[2], buttonY[2]);
	}

	// More Menu Load Go Here...


	//** Keyboard/Mouse Handling: **/
	<?php require_once 'mouse_input.js';?>
	<?php require_once 'keyboard_input.js';?>

	//** General **/
	<?php require_once 'drawing.js';?>

	// Score, health coin related functions.  Need to make some decesions about the game...
	function addToScore(n){
		var s = parseInt(labelScore.innerHTML) || 0;
		labelScore.innerHTML = s + n;
	}

	function getScore() {
		return parseInt(labelScore.innerHTML) || 0;
	}

	function setScore(n) {
		labelScore.innerHTML = n;
		// maybe external com via this.. but all about the localy stored coins right now..
	}

	// Returns true if still alive, else false (>0)
	function subtractHealth(n){
		var s = parseInt(labelHealth.innerHTML) || 0;
		labelHealth.innerHTML = s - n;
		if (parseInt(labelHealth.innerHTML) - n < 0) {
			return false;
		} else {
			return true;
		}
	}

	function addHealth(n) {
		var s = parseInt(labelHealth.innerHTML) || 0;
		
		if (s+n <= 100) {
			labelHealth.innerHTML = s + n;	
		} else {
			labelHealth.innerHTML = 100;
		}
	}

	function setHealth(n) {
		labelHealth.innerHTML = n;
	}

	function drawBigText(text) {
		ctx.font="50px Johnny Fever";
		ctx.fillStyle = "red";
		ctx.textAlign = "center";
		ctx.fillText(text, canvas.width/2, canvas.height/2);
	}

	function drawScore() {
		// ctx.font="50px Comic Sans MS";
		ctx.font = '50px Johnny Fever';
		ctx.fillStyle = "red";
		ctx.textAlign = "left";
		// score_string = "Score " + getScore();
		ctx.fillText(getScore(), canvas.width/2 + 50, buttonY[2] - 18);
	}

	// Also Enables Listeners.. this is now nest a little :(
	function MainMenuButton() {

		alignAndDrawLabel(labelMainMenu, buttonY[2]);

		// Enable Mouse:
		canvas.addEventListener("mousemove", checkMousePos);
		canvas.addEventListener("mouseup", checkMouseClick);

	}

	var move_n = 0;
	function drawFighter(i=0) {
		// console.log(fighters);
		if (DAMAGED) {
			ctx.drawImage(fighter2_damaged, fighterX, fighterY);
		} else {
			// console.log(move_n); // rand 012*
			f_mvs = [f2_m,f2_m2,f2_m3];
			ctx.drawImage(f_mvs[move_n], fighterX, fighterY);
			move_n = ((move_n+1) % f_mvs.length);
		    // ctx.drawImage(fighters[i], fighterX, fighterY);
		}
	}

	function drawInvader(i) {
		if (i.damaged && i.type == ALIEN_1) {
			try{
				// if (i.image == (ufo2 || ufo2_damaged)) {
					// drawImageRot(i,i.x,i.y,i.width,i.height,30);
				// } else {
					ctx.drawImage(i.image_damaged,i.x,i.y);
				// }

			}
			catch(err) {
				console.log(err);
				ctx.drawImage(i.image,i.x,i.y);
			}
		} else {
			ctx.drawImage(i.image,i.x,i.y);
		}
	}

	function drawImageRot(img,x,y,width,height,deg){
		ctx.save();
		//Convert degrees to radian 
	    var rad = deg * Math.PI / 180;

	    //Set the origin to the center of the image
	    ctx.translate(x + width / 2, y + height / 2);

	    //Rotate the canvas around the origin
	    ctx.rotate(rad);

	    //draw the image    
	    ctx.drawImage(img,width / 2 * (-1),height / 2 * (-1),width,height);

	    //reset the canvas  
	    ctx.rotate(rad * ( -1 ) );
	    ctx.translate((x + width / 2) * (-1), (y + height / 2) * (-1));

	    ctx.restore();
}

	function drawMissile(m){
		ctx.drawImage(m.image, m.x, m.y);
	}


	function createMissile() {
		var m = {
			x:fighterX+fighters[0].width/2 - 6,
			y:fighterY-5,
			r:2,
			color:"#FFFFFF",
			show:true,
			image:rocketImage
		}
		return m;
	}

	// Draw explosion(s)
	function drawExplosion() {

	  if (explosions.length === 0) {
	    return;
	  }

	  for (let i = 0; i < explosions.length; i++) {

	    const explosion = explosions[i];
	    const particles = explosion.particles;

	    if (particles.length === 0) {
	      explosions.splice(i, 1);
	      return;
	    }

	    const particlesAfterRemoval = particles.slice();
	    for (let ii = 0; ii < particles.length; ii++) {

	      const particle = particles[ii];

	      // Check particle size
	      // If 0, remove
	      if (particle.size <= 0) {
	        particlesAfterRemoval.splice(ii, 1);
	        continue;
	      }

	      ctx.beginPath();
	      ctx.arc(particle.x, particle.y, particle.size, Math.PI * 2, 0, false);
	      ctx.closePath();
	      ctx.fillStyle = 'rgb(' + particle.r + ',' + particle.g + ',' + particle.b + ')';
	      ctx.fill();

	      // Update
	      particle.x += particle.xv;
	      particle.y += particle.yv;
	      particle.size -= .1;
	    }

	    explosion.particles = particlesAfterRemoval;

	  }

	}

	// Explosion
	function explosion(x, y, small) {

	  this.particles = [];

	  if (small) {
		  for (let i = 0; i < particlesPerExplosion/2; i++) {
		    this.particles.push(
		      new particle(x, y, small)
		    );
		  }	  	
		} else {
		  for (let i = 0; i < particlesPerExplosion; i++) {
		    this.particles.push(
		      new particle(x, y, small)
		    );
		  }
		}

	}
	// Particle
	function particle(x, y, small) {
		if (small) {
			  this.x    = x;
			  this.y    = y;
			  this.xv   = randInt(particlesMinSpeed/2, particlesMaxSpeed/2, false);
			  this.yv   = randInt(particlesMinSpeed/2, particlesMaxSpeed/2, false);
			  this.size = randInt(particlesMinSize/2, particlesMaxSize/2, true);
			  this.r    = randInt(113, 222/2);
			  this.g    = randInt(100/2, 255);
			  this.b    = randInt(105, 255);
		 } else {
			  this.x    = x;
			  this.y    = y;
			  this.xv   = randInt(particlesMinSpeed, particlesMaxSpeed, false);
			  this.yv   = randInt(particlesMinSpeed, particlesMaxSpeed, false);
			  this.size = randInt(particlesMinSize, particlesMaxSize, true);
			  this.r    = randInt(113, 222);
			  this.g    = randInt(100, 255);
			  this.b    = randInt(105, 255);
		 }
	}

	// Returns an random integer, positive or negative
	// between the given value
	// 	- negative returns MAYBE neg num, maybe 0, maybe pos
	function randInt(min, max, positive) {

	  let num;
	  if (positive === false) {
	    num = Math.floor(Math.random() * max) - min;
	    num *= Math.floor(Math.random() * 2) === 1 ? 1 : -1;
	  } else {
	    num = Math.floor(Math.random() * max) + min;
	  }
	  return num;
	}

	var seed = 1;
	function randInt2(max, pos) {
		var n = Math.sin(seed++) * max;
		if (pos) {
			return Math.abs(n);
		}
		return n;
	}


	/* FLAME SECTION */
	var particlesFlame = [];
	
	//Lets create some particles now
	var particle_count = 30;
	for(var i = 0; i < particle_count; i++)
	{
		particlesFlame.push(new particleFlame());
	}

	function particleFlame() {
		try {
			//speed, life, location, life, colors
			//speed.x range = -2.5 to 2.5 
			//speed.y range = -15 to -5 to make it move upwards
			//lets change the Y speed to make it look like a flame
			this.speed = {x: -2.5+Math.random()*5, y: 5+Math.random()*5};
			//location = mouse coordinates
			//Now the flame follows the mouse coordinates
			// if(mouse.x && mouse.y)
			this.location = {x: fighterX + fighters[0].width/2, y: fighterY + fighters[0].height};
			//radius range = 10-30
			this.radius = 2+Math.random()*8;
			//life range = 20-30
			this.life = 10+Math.random()*10;
			this.remaining_life = this.life;
			//colors
			this.r = Math.round(Math.random()*255);
			this.g = Math.round(Math.random()*155);
			// this.b = Math.round(Math.random()*255);
			this.b = '00';
		} catch(err) {
			console.log(err);
		}
	}

	function coin(x,y,w,h,dur=3,speed=2,img=coin2_g1){
		
			this.x = x,
			this.y = y,
			this.width = img.width,
			this.height = img.height,
			this.dur = dur,
			this.img = img,
			this.dy = -2+Math.random()*4,
			this.dx = -2+Math.random()*4,
			this.speed = 1.5,
			this.rotate = -2,
			this.w_temp = Math.floor(Math.random() * this.img.width) -1,
			this.move_n = 0;
	}

	function drawCoins() {

		// if empty return (this first!, many calls to this func):
		if (coins.length < 1){
			return;
		// else draw logic:
		} else {
			for (var i = coins.length - 1; i >= 0; i--) {
				const c = coins[i];

				if (c.dur <= 0){
					coins.splice(i,1);
					continue;
				}

				// rotate it...
				// ctx.drawImage(c.img, c.x,c.y);
				rotateAndDrawCoin(c);
				// update pos:
				c.x += c.dx+c.speed;
				c.y += c.dy+c.speed;
				c.speed -= 0.1;
				c.dur -= 0.1;
				
				// remove old coins here, fewer reads?
				
				coins[i] = c;

				// get the coins position, send it on a random,slowing arc, draw it
			}
		}

	}

	function drawShipFlame(){
		ctx.globalCompositeOperation = "source-over";
		ctx.fillStyle = "black";
		// ctx.fillRect(0, 0, canvas.width, canvas.height);
		ctx.globalCompositeOperation = "lighter";
		
		for(var i = 0; i < particlesFlame.length; i++)
		{
			var p = particlesFlame[i];
			ctx.beginPath();
			//changing opacity according to the life.
			//opacity goes to 0 at the end of life of a particle
			p.opacity = Math.round(p.remaining_life/p.life*100)/100
			//a gradient instead of white fill
			var gradient = ctx.createRadialGradient(p.location.x, p.location.y, 0, p.location.x, p.location.y, p.radius);
			gradient.addColorStop(0, "rgba("+p.r+", "+p.g+", "+p.b+", "+p.opacity+")");
			gradient.addColorStop(0.5, "rgba("+p.r+", "+p.g+", "+p.b+", "+p.opacity+")");
			gradient.addColorStop(1, "rgba("+p.r+", "+p.g+", "+p.b+", 0)");
			ctx.fillStyle = gradient;
			ctx.arc(p.location.x, p.location.y, p.radius, Math.PI*2, false);
			ctx.fill();
			
			//lets move the particlesFlame
			p.remaining_life--;
			p.radius--;
			p.location.x += p.speed.x;
			p.location.y += p.speed.y;
			
			//regenerate particlesFlame
			if(p.remaining_life < 0 || p.radius < 0)
			{
				//a brand new particle replacing the dead one
				particlesFlame[i] = new particleFlame();
			}
		}
	}

	/* END FLAME SECTION */

	// Idea here is for a 1 in n roll
	// roll(2) = 50% chance of true, n(3) = 33%, etc
	function roll(n) {
		var r = Math.floor(Math.random()*n);
		// console.log("Game: rolling.. got a " + r);
		if (r == 1){
			return true;
		} else {
			return false;
		}
	}


	// i is index of invader
	function resetInvader(i) {
    	// this could be much more elegant with some structures... simple lists
    	// Roll for special:
    	if (roll(12)) {
    		invaders[i].type = SPECIAL_1;
    		invaders[i].image = imageCan;
    		invaders[i].width = imageCan.width;
    		invaders[i].height = imageCan.height;
    	} else {
    		// Choose normal baddie:
    		invaders[i].type = ALIEN_1;
    		if (roll(2)) {
				invaders[i].image = shipImage1;
	    		invaders[i].width = shipImage1.width;
	    		invaders[i].height = shipImage1.height;
	    		invaders[i].image_damaged = shipImage1_damaged;

	    	} else {
				invaders[i].image = ufo2;
	    		invaders[i].width = ufo2.width;
	    		invaders[i].height = ufo2.height;
	    		invaders[i].image_damaged = ufo2_damaged;
	    	}
    	}

		invaders[i].y = -1*(Math.floor((Math.random() * canvas.height) + 10)); // make a new one... or randomize w/e
    	invaders[i].x = Math.floor((Math.random() * (canvas.width - invaders[i].width*2)) + invaders[i].width);
    	invaders[i].color = "#FF95DD";
    	invaders[i].killed = false;
    	invaders[i].health = INVADER_HEALTH;
    	invaders_this_level += 1;

    	// console.log(invaders[i]);

	}

	function resetShip(){
		fighterX = (canvas.width-fighters[0].width)/2;
		fighterY = canvas.height/2;
	}


	// This will "fade to black" by layering partially transparent black
	// 	rectangles over the top of the canvas...
	function fadeOut(){
		var color_string = 'rgba(0,0,0,0.4)';
		ctx.fillStyle = color_string;
		// folowing line .. how does even .. wut
		ctx.fillRect(0, 0, canvas.width, canvas.height);
		fadeOutTime += 0.1;
		// ctx.globalAlpha = fadeOutTime;
		if (fadeOutTime >= 2){
			clearInterval(fadeLoopId);
			// clearInterval(menuLoopId);
			// gameLoopId = setInterval(draw, 100/3);
			STATE = "yes";
			go();
			fadeOutTime = 0.0;

		}

	}

	function fadeOutFromBreak(){
		var color_string = 'rgba(255,255,255,0.01)';
		ctx.fillStyle = color_string;
		// folowing line .. how does even .. wut
		ctx.fillRect(0, 0, canvas.width, canvas.height);
		fadeOutTime += 0.1;
		// ctx.globalAlpha = fadeOutTime;
		if (fadeOutTime >= 2){
			clearInterval(fadeLoopId);
			// clearInterval(menuLoopId);
			gameLoopId = setInterval(draw, 100/3);
			fadeOutTime = 0.0;

		}

	}

	function fadeOutToBreak(){
		var color_string = 'rgba(0,0,0,0.04)';
		ctx.fillStyle = color_string;
		// folowing line .. how does even .. wut
		ctx.fillRect(0, 0, canvas.width, canvas.height);
		fadeOutTime += 0.1;
		// ctx.globalAlpha = fadeOutTime;
		if (fadeOutTime >= 2){
			clearInterval(fadeLoopId);
			// clearInterval(menuLoopId);
			breakLoopId = setInterval(drawBreak, 100/3);
			fadeOutTime = 0.0;

		}

	}

	function popUpText(x, y, alpha, text, color) {
		this.x = x;
		this.y = y;
		this.a = alpha;
		this.text = text;
		this.color = color;
	}

	function powerUpText(x,y,alpha, text, color, size, height) {
		this.x = x;
		this.y = y;
		this.a = alpha;
		this.text = text;
		this.color = color;
		this.fnt_size = size;
		this.height = height;
	}


	function drawPopUps() {

		if (popups.length == 0){
			return;
		}

		// console.log("Game popups length: " + popups.length);
		for (var i = popups.length - 1; i >= 0; i--) {
			const p = popups[i];
			ctx.fillStyle = p.color;
			ctx.font = "50px Johnny Fever";
			ctx.fillText(p.text, p.x, p.y);

			// update:
			p.y -= 2;
			p.a -= .05;

			if (p.a <= 0) {
				popups.splice(i, 1);
			}
		}

	}

	function scrollBackground(up) {
		if (up) {
			backgroundY += backgroundSpeed;	
		   	if (backgroundY == 0) {
		   		backgroundY = -1 * canvas.height;
		   	}
		} else {
			backgroundY -= backgroundSpeed;
		   	if (backgroundY == -1 * canvas.height) {
		   		backgroundY = 0;
		   	}
		}
	}

	// Setup the invaders array
	// 	- takes invaders array, ensures it's full
	// a1 assumed the current invaders list
	function fill_invaders(a1) {
		if (a1.length < INVADERS) {
			for (var i = 0; i < (INVADERS - a1.length); i++) {
				var img, img_d;
				if (roll(2)) {
					img = shipImage1;
					img_d = shipImage1_damaged;
				} else {
					img = ufo2;
					img_d = ufo2_damaged;
				}
				var inv={
				  x:Math.floor((Math.random() * (canvas.width - img.width*2))+img.width),
				  y:Math.floor(-1*((Math.random() * canvas.height*2) + 10)),
	  			  image:img,
				  width:img.width,
				  height:img.height,
				  color:"#FF95DD",
				  health:INVADER_HEALTH,
				  type:ALIEN_1,
				  killed:false,
				  damaged:false,
				  image_damaged:img_d
				}
				// console.log(inv);
				a1.push(inv)
			}
		}
	}

	function clear_text() {
		show_text = false;
	}

	// Pos h_off will move img up the screen
	function alignAndDrawLabel(img, h_off, score) {
		var x;
		if (score) {
			console.log("drawing score.. tyring to move left..")
			x = (canvas.width /2) - (img.width /2) - 30;
		} else {
			x = (canvas.width /2) - (img.width /2);
		}
		ctx.drawImage(img, x, h_off);
	}

	function got_power_up(p_up, i) {
		// show_powerup_text = true;
		// var p_up = "DUAL_ROCKETS"
		switch (p_up){
			case "PLUS_5_HEALTH":
				// big_text = "+5 Health!";
				// add 5 health...
				addHealth(5);
				for (var k = 5; k >= 0; k--) {
					powerups.push(new powerUpText(invaders[i].x, invaders[i].y, 1.0, "+5 Health!", "green", 30, invaders[i].height));
				}
				break;
			case "PLUS_15_HEALTH":
				// big_text = "+5 Health!";
				// add 5 health...
				addHealth(15);
				for (var k = 5; k >= 0; k--) {
					powerups.push(new powerUpText(invaders[i].x, invaders[i].y, 1.0, "+15 Health!", "green", 30, invaders[i].height));
				}
				break;
			case "DUAL_ROCKETS":
				DUAL_ROCKETS = true;
				var v = 0;
				for (var k = 10; k >= 0; k--) {
					v = randInt2(400,false);
					powerups.push(new powerUpText(invaders[i].x - v, invaders[i].y + v, 2.0, "!!DUAL ROCKETS!!", colors[k%5], 30, invaders[i].height));
					v = randInt2(400,false);
					powerups.push(new powerUpText(invaders[i].x + v, invaders[i].y - v, 2.0, "!!DUAL ROCKETS!!", colors[(k%5)+1], 30, invaders[i].height));
				}
				break;
			default:
				break;
		}
	}

	function drawPowerUps() {

		if (powerups.length == 0) {
			return;
		}

		// console.log("Game powerups length: " + powerups.length);
		for (var i = powerups.length - 1; i >= 0; i--) {
			const p = powerups[i];
			ctx.fillStyle = p.color;
			ctx.font = p.fnt_size + "px Johnny Fever";
			ctx.fillText(p.text, p.x, p.y+p.height/2);

			// update:
			// p.y -= 1;
			p.a -= .05;
			p.fnt_size += 1;
			p.x -= 1;


			if (p.a <= 0) {
				powerups.splice(i, 1);
			}
		}

	}

	function drawPowerUpText(text) {
		ctx.font="50px Johnny Fever";
		ctx.fillStyle = "green";
		ctx.textAlign = "center";
		ctx.fillText(text, canvas.width/2, canvas.height/2);
	}

	function ship_hit_invader(i,j) {
		// console.log("Game: ship made contact with invader type: " + invaders[i].type);
		ctx.fillStyle = "red";
		if (invaders[i].type == SPECIAL_1) {
			
			// Special Hit:
			var roll = Math.floor(Math.random()*3)
			console.log("Rolled a " + roll);
			got_power_up(p_ups[roll], i);
			// popups.push(new popUpText(invaders[i].x, invaders[i].y, 1.0, "Niiice", "green"));
			
			resetInvader(i);	
		} else {
			// Invader Hit:
			DAMAGED = true;
			invaders[i].damaged = true;
			invaders[i].health -= 1;
			if (!subtractHealth(1)){
	    		// Game Over!
	    		PLAYING = false;
	    		cancelAnimationFrame(go);
	    	}
			// popups.push(new popUpText(invaders[i].x, invaders[i].y, 1.0, "Ouch!", "orange"));
			powerups.push(new powerUpText(invaders[i].x, invaders[i].y, 1.0, "Ouch!", "orange", 30, invaders[i].height));
			// ctx.fillText("OUCH!", invaders[i].x, invaders[i].y);
			
			if (invaders[i].health < 1) {
				resetInvader(i);
			}
		}	
	}

	function missile_hit_invader(i,j) {
		// console.log(invaders[i], missiles[j]);
		// console.log("HIT: inv.x = " + invaders[j].x + "mis.x = " + missiles[i].x);
		const inv = invaders[i];
		const mis = missiles[j];
		if (inv.type == SPECIAL_1) {
			if (inv.health < 2){
				// console.log("invader " + j + " hit. Health: " + invaders[i].health);
				resetInvader(i);
				addToScore(1);
				level_coins += 1;
				mis.show = false;
				//explosions.push(
			    //	new explosion(mis.x + mis.image.width/2, mis.y, false));
			    missiles.splice(i, 1);
			    return;
			} else {
				inv.health = inv.health -1;
				mis.show = false;
				//explosions.push(
			    //	new explosion(mis.x + mis.image.width/2, mis.y, true));
				missiles.splice(j, 1);
				// popups.push( new popUpText(invaders[i].x, invaders[i].y, 1.0, "Idiot!", "red"));
				powerups.push(new powerUpText(inv.x, inv.y, 1.0, "Idiot!", "red", 30, inv.height));
				invaders[i] = inv;
				return;
			}

		} else if (inv.type == ALIEN_1) {
			// console.log("invader " + j + " hit. Health: " + invaders[i].health);
			// Killed it:
			if (inv.health <= 1){
				resetInvader(i);
				addToScore(1);
				level_coins += 1;
				mis.show = false;
				// explosions.push(
			 //    	new explosion(missiles[j].x + missiles[j].image.width/2, missiles[j].y, false));
			 	for (var i = 5; i >= 0; i--) {
				 	coins.push(
				 		new coin(mis.x + mis.image.width/2, mis.y));	
			 	}
			    missiles.splice(j, 1);
			    return;
			// Still alive:
			} else {
				inv.health = inv.health -1;
				inv.damaged = true;
				mis.show = false;
				//explosions.push(
			    //	new explosion(mis.x + mis.image.width/2, mis.y, true));
				missiles.splice(j, 1);
				invaders[i] = inv;
				return;
			}			    					
		}
	}


	//hit calulator v2:
	// - assume's a1 and a2 are arrays and each member has x, y, width and height
	// - considers collisions in 4 directions
	// - on_hit is func to run on hit
	// 		- must have proto ...(i,j)
	// 		- j, i are the a1 index and a2 index of collided objects
	// 	- convention says call this with (whatever, invaders)
	// 		- making i the invader index by default
	// 		- while j is index of whatever
	function check_hits(a1, a2, on_hit) {

		var PTS, ptA, ptB, ptC, ptD = [];

		// For each in a1:
		for (var j = a1.length - 1; j >= 0; j--) {			

			// Calc Corners for PTS array:
			var ptA = [a1[j].x,a1[j].y];
			var ptB = [a1[j].x,a1[j].y+a1[j].height];
			var ptC = [a1[j].x+a1[j].width,a1[j].y];
			var ptD = [a1[j].x+a1[j].width,a1[j].y+a1[j].height];
			PTS = [ptA,ptB,ptC,ptD];

			// For each corner case:
			for (var PT = PTS.length - 1; PT >= 0; PT--) {
				// For each a2:
			    for (var i = a2.length - 1; i >= 0; i--) {
			    	// Check for a1's point inside a2's [invader's] bounds:
		    		if (PTS[PT][0] > a2[i].x && PTS[PT][0] < a2[i].x+a2[i].width) {
		    			if (PTS[PT][1] < a2[i].y+a2[i].height && PTS[PT][1] > a2[i].y) {
		    				// Hit:
		    				on_hit(i,j);
		    			}
		    		}
			    }
			}
		}

	}

	// "Optimized" collision checking for missiles
	// 	- only considers missile up, a2[i] down collisions
	// 	- on hit breaks looping over a2
	// 	- doesn't check missiles not 'shown' ie off top of screen
	function check_missile_hits(m_index, a2, on_hit) {
		var m = missiles[m_index];
		if (m.show){
		    for (var i = a2.length - 1; i >= 0; i--) {
		    	// Check for a1's point inside a2's [invader's] bounds:
	    		if (m.x > a2[i].x && m.x < a2[i].x+a2[i].width) {
	    			if (m.y < a2[i].y+a2[i].height && m.y > a2[i].y) {
	    				// Hit detected:
	    				// try to prevent concurrent access issues on invaders
	    				// Fix by improving logics
	    				try {
		    				on_hit(i,m_index);
		    				break;
		    			} catch(err) {
		    				console.log(err);
		    			}
	    			}
	    		}
		    }
		}
		
	}

function resetGame() {
	setHealth(100);
	setScore(0);
	GAME_OVER = false;
	invaders = [];
	invader_speed_multi = 1;
	missiles = [];
	level = 0;
	popups = [];
	powerups = [];
	resetShip();
	setHealth(100);
	level_coins = 0;
	level = 1;
	total_coins = 0;
	DUAL_ROCKETS = false;
}



	function draw() {
		if (PLAYING) {
			// clear
		    ctx.clearRect(0, 0, canvas.width, canvas.height);
		    
		   	// Draw Background:
    		scrollBackground(true);
    		ctx.globalCompositeOperation = "source-over"; // seems to get opacity working in top-down order
    		ctx.globalAlpha = 1.0;
		    ctx.drawImage(backgroundImage, 0, backgroundY);
		    
		    // If we don't have < INVADERS number of invaders, add off screen:
		    // Solves problem of image's properties not being available before anything has been rendered (as i understand the issue...)
		    fill_invaders(invaders);
		    
		    // ...
		    // console.log(fighters);

		    // Check for Fighter Hits:
		    var fighter_obj = [{x:fighterX, y:fighterY, width:fighters[0].width, height:fighters[0].height}];



		    // Draw fighter:
		    drawFighter();


		    
		    // Turn off damaged on all:
		    for (var i = invaders.length - 1; i >= 0; i--) {
		    	invaders[i].damaged = false;
		    }

		    // Update Invaders Positions:
		    for (var i = invaders.length - 1; i >= 0; i--) {
			    if (invaders[i].y > canvas.height){
			    	// Invader off bottom:
			    	resetInvader(i);
			    	if (!subtractHealth(5)){
			    		// Game Over!
			    		PLAYING = false;
			    	}
			    } else {
			    	// Update:
			    	invaders[i].y = invaders[i].y-(Math.floor(dy *invader_speed_multi));
			    }
		    }

		    check_hits(fighter_obj, invaders, ship_hit_invader, false);

		    // Update Missile Positions:
		    for (var j = missiles.length - 1; j >= 0; j--) {
		    	// update pos first:
		    	missiles[j].y = missiles[j].y + dy*5;
		    	// Check off top:
		    	if (missiles[j].y < 0-missiles[j].image.height) {
		    		// Missile off top:
		    		missiles[j].show = false;
		    		missiles.splice(j, 1);
		    		break;
		    	} else {
		    		// Compare that missile against invaders:
		    		check_missile_hits(j, invaders, missile_hit_invader);
		    	}

		    	// Update Position if not killed:
		    	// try {
		    		// missiles[j].y = missiles[j].y + dy*5;
		    	// }
		    	// catch(err) {
		    		// console.log(err);
		    	// }
		    }

		    // Need to sort the order of these things.  ..here?
		    drawCoins();

		    // Clean up missiles:
			missiles = missiles.filter( function(m) {
			    return !(m.show == false);
			});

		    // Draw Invaders:
		    for (var i = invaders.length - 1; i >= 0; i--) {
		    	drawInvader(invaders[i]);
		    }

		    // Draw Missiles:
		    for (var i = missiles.length - 1; i >= 0; i--) {
		    	drawMissile(missiles[i]);
		    }

		    // Draw Explosions:
		    drawExplosion();

		    // Draw Ship Engine Flame
		    // drawShipFlame();

		    // Draw popups, powerups:
		    drawPopUps();
		    drawPowerUps();

		    // Big Text:
		    if (show_text) {
		    	drawBigText(big_text);
		    }


			// Draw the HUD:
			drawHud();

			// Rotate and draw the weapon image:
			// maybe this should take the weapon to draw.. 
			drawRotatingWeapon();

		    // Fire key Logic
		    // Should weapon logic go there though?  I imagine most 'upgrades' will all need to modify the 'missile' being pushed
		    if (spacePressed) {
		    	// Dual Rockets:
		    	if (DUAL_ROCKETS){
			    	missiles.push({
							x:fighterX+fighters[0].width/2 - 14,
							y:fighterY-5,
							r:2,
							color:"#FFFFFF",
							show:true,
							image:rocketImage
						});
			    	missiles.push({
							x:fighterX+fighters[0].width/2 + 2,
							y:fighterY-5,
							r:2,
							color:"#FFFFFF",
							show:true,
							image:rocketImage
						});		    		
		    	} else {
			    	var m = createMissile();
			    	missiles.push(m);
			    }

			    // Fully auto toggle:
		    	if (!fully_auto) {
			    	spacePressed = false;
		    	}
		    }

		    // Fighter Movement Logic
		    if(rightPressed && fighterX < canvas.width-fighters[0].width/2) {
			    fighterX += user_speed;
			}
			else if(leftPressed && fighterX+fighters[0].width/2 > 0) {
			    fighterX -= user_speed;
			}

			if(upPressed && fighterY > 0) {
			    fighterY -= user_speed;
			}
			else if(downPressed && fighterY+fighters[0].height < canvas.height) {
			    fighterY += user_speed;
			}

			// Check game conditions:
			// check_level(); // facttor me
			if (level_coins >= coin_level_cap){
				// Next Level
				level += 1;
				if (level == 5) {
					PLAYING = false;
					BREAK = true;
				}
				invaders_this_level = 0;
				total_coins += level_coins;
				level_coins = 0;
				show_text = true;
				big_text = "Level " + level + "!";
				setTimeout(clear_text, 3000);
				invader_speed_multi *= 1.2;
			}

			// Var Sanity Checks:
			// var debug = "Lengths:\ncoins:%d, powerups:%d, popups:%d, invaders:%d, missiles:%d, explosions:%d";
			// console.log(debug,coins.length, powerups.length, popups.length, invaders.length, missiles.length, explosions.length);


		} else {
			if (!BREAK) {
				// drawBigText("Game Over!");
				drawScore();
				alignAndDrawLabel(labelGameOver, 100);
				alignAndDrawLabel(labelScoreBig, buttonY[1], true);
				alignAndDrawLabel(labelMainMenu, buttonY[2]);
				MainMenuButton();
				GAME_OVER = true;
				clearInterval(gameLoopId);
				STATE = "no";
				/* High Score Logic:
					- start with a form, submit -> hits api
					- need to check if score actually makes the top10..
					- security concerns...
				*/
				drawHighScoreForm();


			} else {
				PLAYING = true;
				BREAK = false;
				clearInterval(gameLoopId);
				fadeLoopId = setInterval(fadeOutToBreak, 100/3);
			}
		}
	}


	// Animate Frames:
	// Apparently setInterval is the black sheep of animation methods...
	// people say use requestAnimationFrame...


	// Start the flow with the Main Menu:
	// This now starts the game, and just draw uses request anim frame..
	// .. it's not exactly better though..
	// get_highScores(); // Get the high_scores once to start.
	menuLoopId = setInterval(drawMenu, 100/3);


	window.requestAnimFrame = (function(){
	return window.requestAnimationFrame ||
			window.mozRequestAnimationFrame ||
			window.webkitRequestAnimationFrame ||
			window.msRequestAnimationFrame ||
			function(callback){
				window.setTimeout(callback, 1000 / 666);
			};
	})();


	// var states = ["main_menu", "playing", "instructions"];
	function go(){
		if (STATE == "no") return; // this is clunky?
		// switch(STATE){
			// case states[0]:
				// drawMenu();
				// break;
			// case states[1]:
				draw();
		// }
		// drawMenu();
		requestAnimFrame(go);
	};

	// go();



</script>
