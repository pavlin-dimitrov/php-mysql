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
			<h2>IT-Village</h2>
			<form method="post">
				<div>
					<i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><input type="text" name="username" placeholder="Username">
				</div>
				<div>
					<i class="fa fa-key fa-2x" aria-hidden="true"></i><input type="password" name="password" placeholder="Password">
				</div>
				<div class="log-buttons">
					<div><input class="log-btn btn1" type="submit" name="submit-login" value="Login"></div>
					<div><input class="log-btn btn2" type="submit" name="submit-register" value="Register"></div>
					<div><input class="log-btn btn2" type="submit" name="about" value="About"></div>
				</div>
			</form>
		<div 
			style="<?php if(isset($_POST['submit-login']) || isset($_POST['submit-register'])){echo 'display: none';};?>" 
			id="welcome" 
			class="err-msg">Welcome to IT-Village!
		</div>
<?php
if (isset($_POST['about'])) {
	header('Location: about.php');
}

//SUBMIT LOGIN
if(isset($_POST['submit-login'])){
	$error = 0;
	if (preg_match('/^[a-zA-Z0-9!@#$_%^&*]+$/', $_POST['username']) && preg_match('/^[a-zA-Z0-9!@#$_%^&*]+$/', $_POST['password'])) {
		if(isset($_POST['password'])){
			$password_l = htmlspecialchars($_POST['password']);
			if(strlen($password_l) < 4){
				$error++;
			}
		} else {
			$error++;
		}

		if(isset($_POST['username'])){
			$username = htmlspecialchars($_POST['username']);
			if(strlen($username) < 4){
				$error++;
			}
		} else {
			$error++;
		}
	} else {
		$error++;
	}

	if($error > 0){
		echo "<p class='err-msg'>Password and username - min 4 characters! Use only letters (A-Z, a-z), numbers (0-9) and symbols (!@_#$%^*&)!</p>";
	} else {
		//IF NO ERRORS -> SELECT USERNAME
		$sql_user = "SELECT `username` FROM users WHERE `username` = '$username' LIMIT 1";
		$result_user = mysqli_query($connection, $sql_user);
		$row_u = mysqli_num_rows($result_user);
		//IF THE USER EXIST IN DB, VERIFY THE PASSWORD
		if (mysqli_num_rows($result_user) > 0) {
			$sql_pass = "SELECT `password` FROM users WHERE `username` ='$password_l' LIMIT 1";
			$result_pass = mysqli_query($connection, $sql_pass);
			$row = mysqli_fetch_assoc($result_pass); 
			$db_pass = $row['password'];

			if(password_verify($password_l, $db_pass)){
				// IF THE PASSWORD IS VERIFIED: SET USERNAME, LOCATION: GAME, INITIATE VARIABLES
				$_SESSION['username'] = $username;
				header('Location: game.php');
				$_SESSION['money'] = 50;
				$moves = rand(5, 15);
				$field = rand(1, 12);
				$_SESSION['moves'] = $moves;
				$_SESSION['field'] = $field;
				$_SESSION['motels'] = 0;
				$_SESSION['vso_field'] = 0;
				$_SESSION['event'] = "<span style='font-size: 16px;'>Welcome to iT-Village, $username! You have 50 coins and $moves moves. Press the button to throw the dice.</span>";
			} else {
				echo "<p class='err-msg'>Please check username/password!</p>";
			}
		} else {
			echo "<p class='err-msg'>This user is not register! Plese Register first!</p>";
			die();
		}
	}
}

// SUBMIT REGISTRATION
if (isset($_POST['submit-register'])){
	$error = 0;
	if (preg_match('/^[a-zA-Z0-9!@#$_%^&*]+$/', $_POST['username']) && preg_match('/^[a-zA-Z0-9!@#$_%^&*]+$/', $_POST['password'])) {
			$password_r = htmlspecialchars($_POST['password']);
			$username = htmlspecialchars($_POST['username']);
	} else {
		$error++;
	}
	if($error > 0){
		echo "<p class='err-msg'>Password and username - min 4 characters! Use only letters (A-Z, a-z), numbers (0-9) and symbols (!@_#$%^*&)!</p>";
	} else {
		//IF NO ERRORS ON LEN & CHARACTERS, check for dublications, used names and passwords
		$check_query = "SELECT username, password FROM users WHERE 1";
		$users_and_pass = mysqli_query($connection, $check_query);
		$dublication = 0;
		$name_in_use = 0;
		$pass_in_use = 0;
			while ($row = mysqli_fetch_assoc($users_and_pass)) {
				if ($row['username'] == $username && $row['password'] == $password_r) {
					$dublication++;
				} else {
					if ($row['username'] == $username) {
						$name_in_use++;
					} elseif ($row['password'] == $password_r) {
						$pass_in_use++;
					}
				}
			}
		if ($dublication != 0) {
			echo '<div class="err-msg">'.'There is already such a user!'.'</div>';
		} elseif ($name_in_use != 0 && $pass_in_use == 0) {
			echo '<div class="err-msg">'.'This USERNAME already exists!'.'</div>';
		} elseif ($name_in_use == 0 && $pass_in_use != 0) {
			echo '<div class="err-msg">'.'This PASSWORD already exists!'.'</div>';
		} elseif (strlen($username) < 4) {
			echo '<div class="err-msg">'.'The USERNAME can not be less<br>than 4 symbols!'.'</div>';
		} elseif (strlen($username) > 20) {
			echo '<div class="err-msg">'.'The USERNAME can not be more<br>than 20 symbols!'.'</div>';
		} elseif (strlen($password_r) < 4) {
			echo '<div class="err-msg">'.'The PASSWORD can not be less<br>than 4 symbols!'.'</div>';
		} elseif (strlen($password_r) > 20) {
			echo '<div class="err-msg">'.'The PASSWORD can not be more<br>than 20 symbols!'.'</div>';
		} else {
			$pass_hashed = password_hash($password_r, PASSWORD_DEFAULT);
			$insert_query = "INSERT INTO users(username, password) VALUES ('$username', '$pass_hashed')";
			$insert_result = mysqli_query($connection, $insert_query);		
		}
	} 
}
?>
		</div>
	</div>
</div>
<?php include("includes/footer.php");?>
