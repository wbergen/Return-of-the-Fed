// Background Scroll Speed
var backgroundY = 0;
var backgroundSpeed = 1;

// Loops:
var menuLoopId = 0;
var gameLoopId = 0;
var fadeLoopId = 0;
// var fadeBLoopId = 0; // can i just use the other one?
var insLoopId = 0;
var highScoreLoopId = 0;
var breakLoopId = 0;

var fighterHeight = 36;
var fighterWidth = 36;
var fighterX = (canvas.width-fighterWidth)/2;
var fighterY = canvas.height/2;

// var ballRadius = 10;
var dx = 2;
var dy = -2;

var level = 1;
var total_invaders = 40;
var invader_speed_multi = 1;
var total_coins = 0;
var level_coins = 0;
var coin_level_cap = 25;
var invaders_this_level = 0;

var highscores = [];

// Some spice..
var colors = ["green","orange","fuchsia","aqua","lime"];
var p_ups = ["DUAL_ROCKETS", "PLUS_5_HEALTH", "PLUS_15_HEALTH"];

// Misc:
var fadeOutTime = 0.0;
var fighters = [fighter2, fighter1];
const coins = [];
var f_mvs = [f1_m,f1_m2,f1_m3];
var c_mvs = [coin2_g1,coin2_g2,coin2_g3];

// Setup Missiles:
var MISSILES = 50;
var missiles = [];
var DUAL_ROCKETS = false;


// Num Invaders:
var INVADERS = 10;
var INVADER_HEALTH = 3;
var PLAYING = false;
var BREAK = false;
var GAME_OVER = false;
var INSTRUCTIONS = false;
var IN_MENU_SCREEN = false;
var ALIEN_1 = "ALIEN_1";
var SPECIAL_1 = "SPECIAL_1";

// HUD States:
var DAMAGED = false;	// Orange Highlight
var BUFFED = false;		// Green Highlight

// Setup Invaders (CHANGE THIS NAME LOL):
var invaders = [];

// Text Drawing toggle/placeholder:
var show_text = true;
var big_text = "";


var user_speed = 12;
var fully_auto = true;

// Collections:
var popups = [];
var powerups = [];

// Current weapon position and rotation:
var wep_pos = [470,563];
var shipRotate = 2;
var wepSize = 18;
var wepSize_t = 0;

var states = ["main_menu", "playing", "instructions"];
var STATE = states[0];

// Request animation frame
// const requestAnimationFrame = window.requestAnimationFrame ||
// window.mozRequestAnimationFrame ||
// 	window.webkitRequestAnimationFrame ||
// 	window.msRequestAnimationFrame;

// Animation Options:
const background            = '#333';    // Background color
const particlesPerExplosion = 50;
const particlesMinSpeed     = 3;
const particlesMaxSpeed     = 6;
const particlesMinSize      = 2;
const particlesMaxSize      = 6;
const explosions            = [];


var rightPressed = false;
var leftPressed = false;
var spacePressed = false;
var upPressed = false;
var downPressed = false;


// Title Screen Position Arrays:
// x pos = 300 - img.width/2
var buttonX = [240, 165, 150, 178];
var buttonY = [250, 324, 398, 526];
var buttonWidth = [120, 180, 300, 244];
var buttonHeight = [74, 74, 74, 74];
var buttonAction = ["play", "highscores", "instructions", "insViewMainMenu"];