<?php
// FIELDS CONDITION
function pub_field(){
	$_SESSION['event'] = "<span style='font-size: 24px;'>WiFi Pub: You are buying an \"Cloud\" cocktail -5 Coins</span>";
	$_SESSION['money'] = $_SESSION['money'] - 5;
}

function buy_motel(){
	$_SESSION['event'] = "<span style='font-size: 24px;'>Motel: You have money to buy it!(".($_SESSION['motels'] + 1)." of 3) -100 coins</span>";
	$_SESSION['money'] -= 100;
	$_SESSION['motels'] += 1;
}

function pay_per_night(){
	$_SESSION['event'] = '<span style="font-size: 24px;">Motel: You don\'t have enough money to buy it. You must pay for the night -10 coins</span>';
	$_SESSION['money'] = $_SESSION['money'] - 10;
}

function freelance_project(){
	$_SESSION['event'] = "<span style='font-size: 24px;'>Freelance Project: You get a payment +20 coins</span>";
	$_SESSION['money'] += 20;
}

function storm(){
	$_SESSION['event'] = "<span style='font-size: 24px;'>Storm: There is no WiFi in the village and you are depressed, you are -2 dice throws!</span>";
	$_SESSION['moves'] = $_SESSION['moves'] - 2;
}

function superphp(){
	$_SESSION['event'] = "<span style='font-size: 24px;'>Super PHP: 10 times increace of your coins!</span>";
	$_SESSION['money'] *= 10;
}

function vso(){
	$_SESSION['vso_field'] += 1;
}

//CONDITIONS FOR END OF THE GAME
function vso_win(){
	$play = '<form style="margin-top:20px;" method="post"><input class="log-btn btn1" type="submit" name="play" value="Play"></form>';
	$_SESSION['event'] = "<span style='font-size: 24px;'>Congratulations, you won with the support of VSO!</span>".$play;
	$_SESSION['hide_btn_throw'] = "yes";
}

function own_all_motels(){
	$play = '<form style="margin-top:20px;" method="post"><input class="log-btn btn1" type="submit" name="play" value="Play"></form>';
	$_SESSION['event'] = "<span style='font-size: 24px;'>Congratulations, you bought all motels and own the village!</span> (".$_SESSION['money']." Coins)".$play;
	$_SESSION['hide_btn_throw'] = "yes";
}

function lose_no_money(){
	$play = '<form style="margin-top:20px;" method="post"><input class="log-btn btn1" type="submit" name="play" value="Play"></form>';
	$_SESSION['event'] = '<span style="font-size: 24px;">Game over, you have '.($_SESSION['money']).' coins.</span>'.$play;
	$_SESSION['hide_btn_throw'] = "yes";
}

function lose_no_moves(){
	$play = '<form style="margin-top:20px;" method="post"><input class="log-btn btn1" type="submit" name="play" value="Play"></form>';
	$_SESSION['event'] = '<span style="font-size: 24px;">Game over, you didn\'t have more moves! ('.$_SESSION['money'].' COINS)</span>'.$play;
	$_SESSION['hide_btn_throw'] = "yes";
}
?>