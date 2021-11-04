<?php include("includes/header.php"); 
?>
<div id="hero">
	<div class="texture"></div>
	<video playsinline autoplay muted loop>
		<source src="images/video.mp4" type="video/mp4">
		Your Browser does not support the video format *.mp4.
	</video>
	<div class="caption">		
		<div class="login-container">
			<h2 class="login-reg">LOGIN</h2>
			<form method="post">
				<div>
					<i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><input type="text" name="username" placeholder="Username">
				</div>
				<div>
					<i class="fa fa-key fa-2x" aria-hidden="true"></i><input type="password" name="password" placeholder="Password">
				</div>
				<div class="log-buttons">
					<div><input class="log-btn btn1" type="submit" name="submit-login" value="Login"></div>
					<div><input class="log-btn btn2" type="submit" name="home" value="Home"></div>
				</div>
			</form>
		<div 
			style="<?php if(isset($_POST['submit-login'])){echo 'display: none';};?>" 
			id="welcome" 
			class="err-msg">Welcome to IT-Village!
		</div>
<?php
//SUBMIT LOGIN
if (isset($_POST['home'])) {
  header('Location: index.php');
}

if(isset($_POST['submit-login'])){
	$error = 0;
	if (preg_match('/^[a-zA-Z0-9!@#$_%^&*]+$/', $_POST['username']) && preg_match('/^[a-zA-Z0-9!@#$_%^&*]+$/', $_POST['password'])) {
		if(isset($_POST['password']) && isset($_POST['username'])){
			$password_l = htmlspecialchars($_POST['password']);
			$username = htmlspecialchars($_POST['username']);
			if(strlen($password_l) < 4 || strlen($username) < 4 ){
				$error++;
			}
		} else {
			$error++;
		}
}
	if($error > 0){
		echo "<p class='err-msg'>Password and username - min 4 characters! Use only letters (A-Z, a-z), numbers (0-9) and symbols (!@_#$%^*&)!</p>";
	} else {
		//IF NO ERRORS -> SELECT USERNAME
		$sql_user = "SELECT `id`,`username`, `password` FROM users WHERE `username` = '$username' LIMIT 1";
		$result_user = mysqli_query($connection, $sql_user);
		//IF THE USER EXIST IN DB, VERIFY THE PASSWORD
		if (mysqli_num_rows($result_user) > 0) {
			$result_pass = mysqli_query($connection, $sql_user);
			$row = mysqli_fetch_assoc($result_pass); 
			$db_pass = $row['password'];
			$user_id = $row['id'];

			if(password_verify($password_l, $db_pass)){
				// IF THE PASSWORD IS VERIFIED: SET USERNAME, LOCATION: GAME, INITIATE VARIABLES
				$_SESSION['username'] = $username;
				$_SESSION['id'] = $user_id;
				header('Location: game.php');
				$_SESSION['money'] = 50;
				$moves = rand(5, 15);
				$field = rand(1, 12);
				$_SESSION['moves'] = $moves;
				$_SESSION['field'] = $field;
				$_SESSION['motels'] = 0;
				$_SESSION['vso_field'] = 0;
				$_SESSION['event'] = "<span style='font-size: 16px;'>Welcome to iT-Village, $username! You have 50 coins and $moves moves. Press the button to throw the dice!</span>";
			} else {
				echo "<p class='err-msg'>Please check username/password!</p>";
			}
		} else {
			echo "<p class='err-msg'>This user is not register! Plese Register first!</p>";
			die();
		}
	}
}
?>
		</div>
	</div>
</div>
<?php include("includes/footer.php");?>