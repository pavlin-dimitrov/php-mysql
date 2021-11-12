<?php 
include("includes/header.php");

	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}

$username = $_SESSION['username'];
// ON CLICK button PLAY new game will start. SET NEW VARIABLES
if (isset($_POST['play'])) {
	$_SESSION['money'] = 50;
	$moves = rand(5, 15);
	$field = rand(1, 12);
	$_SESSION['moves'] = $moves;
	$_SESSION['field'] = $field;
	$_SESSION['motels'] = 0;
	$_SESSION['vso_field'] = 0;
	$_SESSION['event'] = "<span style='font-size: 24px;'>You have $moves moves and your start location is: $field</span>";

	unset($_SESSION['hide_play']);
	unset($_SESSION['hide_btn_throw']);
	unset($_SESSION['dice_num']);
	//header('Location: game.php');
}
// THROW THE DICE & GET NEW NUMBERS & EVENTS
if (isset($_POST['throw_dice'])) {
	$dice_num = rand(1, 6);
	$_SESSION['dice_num'] = $dice_num;
	$_SESSION['moves'] -= 1;
	$field = $_SESSION['field'] + $dice_num;
	// IF YOU MAKE FULL LOOP OVER THE GAME BOARD START COUNTING FROM ONE AGAIN
	if ($field > 12) {
		$field -= 12;
	}
// FIELDS CONDITION
	if ($field == 1 || $field == 12) {
			pub_field();
	} elseif ($field == 2 || $field == 7 || $field == 10) {
		if ($_SESSION['money'] >= 100) {
			buy_motel();
		} else {
			pay_per_night();
		}
	} elseif ($field == 3 || $field == 5 || $field == 8 || $field == 9) {
			freelance_project();
	} elseif ($field == 4) {
			storm();
	} elseif ($field == 6) {
			superphp();
	} elseif ($field == 11) {
			vso();
	}
	// CONDITIONS FOR END OF THE GAME
	$victories = 0;
	$defeats = 0;
	if ($_SESSION['vso_field'] == 1) {
		vso_win();
		$victories = 1;
		$defeats = 0;
	} elseif ($_SESSION['motels'] == 3) {
		own_all_motels();
		$victories = 1;
		$defeats = 0;
	} elseif ($_SESSION['money'] == 0) {
		lose_no_money();
			$defeats = 1;
			$victories = 0;
	} else if ($_SESSION['moves'] == 0) {
		lose_no_moves();
			$defeats = 1;
			$victories = 0;
	}

	$_SESSION['field'] = $field;
	$user_id = $_SESSION['id'];

	if($victories != 0 || $defeats != 0){
		$update_query = "INSERT INTO results (`id`, `victories`, `defeats`) VALUES ('$user_id', '$victories', '$defeats' )";
		$update_result = mysqli_query($connection, $update_query);
	}
}

$fields_name = array(1 => 'WiFi Pub', 
					 2 => 'Motel', 
					 3 => 'Freelance Project', 
					 4 => 'Storm', 
					 5 => 'Freelance Project', 
					 6 => 'Super PHP', 
					 7 => 'Motel', 
					 8 => 'Freelance Project', 
					 9 => 'Freelance Project', 
					 10 => 'Motel', 
					 11 => 'VSO', 
					 12 => 'WiFi Pub');
?>
<div id="game-background">
		<div class="texture"></div>
		<div class="game-background-image"></div>

	<div style="z-index: 50;" class="col1">
		<div class="list-item <?php if ($_SESSION['field'] == 1) { echo 'on-event'; }?>"><img alt="bar" src="images/bar.png"></div>
		<div class="space-between-boxes"></div>
		<div class="list-item <?php if ($_SESSION['field'] == 12) { echo 'on-event'; }?>"><img alt="bar" src="images/bar.png"></div>
		<div class="space-between-boxes"></div>
		<div class="list-item <?php if ($_SESSION['field'] == 11) { echo 'on-event'; }?>"><img alt="vso" src="images/vso.png"></div>
		<div class="space-between-boxes"></div>
		<div class="list-item <?php if ($_SESSION['field'] == 10) { echo 'on-event'; }?>"><img alt="motel" src="images/hotel.png"><a></a></div>
	</div>

	<div style="z-index: 40;" class="col2">
		<div class="list-item <?php if ($_SESSION['field'] == 2) { echo 'on-event'; }?>"><img alt="motel" src="images/hotel.png"></div>
		<div class="space-between-boxes"></div>
		<div class="empty-fields"></div>
		<div class="space-between-boxes"></div>
		<div class="empty-fields"></div>
		<div class="space-between-boxes"></div>
		<div class="list-item <?php if ($_SESSION['field'] == 9) { echo 'on-event'; }?>"><img alt="freelance" src="images/freelance.png"></div>
	</div>

	<div style="z-index: 30;" class="col3">
		<div class="list-item <?php if ($_SESSION['field'] == 3) { echo 'on-event'; }?>"><img alt="freelance" src="images/freelance.png"></div>
		<div class="space-between-boxes"></div>
		<div class="empty-fields"></div>
		<div class="space-between-boxes"></div>
		<div class="empty-fields"></div>
		<div class="space-between-boxes"></div>
		<div class="list-item <?php if ($_SESSION['field'] == 8) { echo 'on-event'; }?>"><img alt="freelance" src="images/freelance.png"></div>
	</div>

	<div class="col4">
		<div class="list-item <?php if ($_SESSION['field'] == 4) { echo 'on-event'; }?>"><img alt="storm" src="images/storm.png"></div>
		<div class="space-between-boxes"></div>
		<div class="list-item <?php if ($_SESSION['field'] == 5) { echo 'on-event'; }?>"><img alt="freelance" src="images/freelance.png"></div>
		<div class="space-between-boxes"></div>
		<div class="list-item <?php if ($_SESSION['field'] == 6) { echo 'on-event'; }?>"><img alt="superphp" src="images/superphp.png"></div>
		<div class="space-between-boxes"></div>
		<div class="list-item <?php if ($_SESSION['field'] == 7) { echo 'on-event'; }?>"><img alt="motel" src="images/hotel.png"></div>
	</div>
	<div class="col5">
		<div class="info-item">
			<div id="1" class="lds-dual-ring" style="visibility: visible;"></div>
			<div id="0" class="game-info" style="visibility: hidden">
				<div style="padding-bottom: 20px; position: relative; top: -70px">
					 <span><img alt="cash" src="images/cash.png"></span>&nbsp&nbsp<?=$_SESSION['money']?> &nbsp|&nbsp 
					 <span><img alt="steps" src="images/steps.png"></span>&nbsp<?=$_SESSION['moves']?> &nbsp|&nbsp 
					 <span><i class="fa fa-map-marker" aria-hidden="true" style="color: white;"></i></span>
					 		&nbsp<?php foreach($fields_name as $x => $val) { if($x == $_SESSION['field']){ echo $val;} }?>&nbsp|&nbsp
					 <span><img alt="motels" src="images/motels.png"></span>&nbsp&nbsp<?=$_SESSION['motels']?>
				</div>
				<div class="type" style="--n:53; padding-bottom: 0px;"><?=$_SESSION['event']?></div>
			</div>
				<div class="controls">
					<a class="controls_btn" href="about.php"><i class="fa fa-info-circle" aria-hidden="true"></i>About</a>
					<a class="controls_btn" href="result.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>Result</a>
					<a class="controls_btn" href="exit.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Exit</a>
			</div>
		</div>
		<div class="space-between-boxes"></div>
		<div class="info-dice">

			<div class="<?php if(isset($_SESSION['dice_num'])){ 
										echo 'dice';} else {echo'empty-dice';};?>">
				<?php if (isset($_SESSION['dice_num'])) {
					$path = "images/dice_".$_SESSION['dice_num'].".gif";
					echo "<img alt='dice' class='dice_img' src='$path' alt='images/dice*.gif'>";
				}?>
			</div>
			<div class="throw_btn_div">
				<form method="post">
					<input id="3" type="<?php if(isset($_SESSION['hide_btn_throw'])){ 
										echo 'hidden';} else {echo'submit';};?>" style="visibility: hidden;" class="throw_dice log-btn btn1" name="throw_dice" value="THROW">
				</form>
			</div>
		</div>
	</div>
</div>

<script>
			setTimeout(function(){
				document.getElementById('1').style.visibility = "hidden";
			}, 3000);
			setTimeout(function(){
				document.getElementById('0').style.visibility = "visible";
			}, 2900);
			setTimeout(function(){
				document.getElementById('3').style.visibility = "visible";
			}, 8000);
</script>
<?php include("includes/footer.php");?>