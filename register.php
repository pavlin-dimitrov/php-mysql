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
			<h2 class="login-reg">REGISTRATION</h2>
			<form method="post">
				<div>
					<i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><input type="text" name="username" placeholder="Username">
				</div>
				<div>
					<i class="fa fa-key fa-2x" aria-hidden="true"></i><input type="password" name="password" placeholder="Password">
				</div>
				<div class="log-buttons">
					<div><input class="log-btn btn1" type="submit" name="submit-register" value="Register"></div>
					<div style="margin-bottom: 40px"><input class="log-btn btn2" type="submit" name="home" value="Home"></div>
				</div>
			</form>
		<div 
			style="<?php if(isset($_POST['submit-register'])){echo 'display: none';};?>" 
			id="welcome" 
			class="err-msg">Welcome to IT-Village!
		</div>

<?php
// SUBMIT REGISTRATION
if (isset($_POST['home'])) {
  header('Location: index.php');
}

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
		$check_query = "SELECT `username` FROM users WHERE `username` = '$username' LIMIT 1";
		$result = mysqli_query($connection, $check_query);
		if(mysqli_num_rows($result) > 0){
			$error = "name_in_use";
		}
		if ($error == "name_in_use") {
			echo '<div class="err-msg">There is already such a user!</div>';
		} elseif (strlen($username) < 4) {
			echo '<div class="err-msg">Username can\'t be less than 4 characters!</div>';
		} elseif (strlen($username) > 20) {
			echo '<div class="err-msg">Username can\'t be more than 20 characters!</div>';
		} elseif (strlen($password_r) < 4) {
			echo '<div class="err-msg">The Password can\'t be less than 4 characters!</div>';
		} elseif (strlen($password_r) > 20) {
			echo '<div class="err-msg">The Password can\'t be more than 20 characters!</div>';
		} else {
			$pass_hashed = password_hash($password_r, PASSWORD_DEFAULT);
			$insert_query = "INSERT INTO users(username, password) VALUES ('$username', '$pass_hashed')";
			$insert_result = mysqli_query($connection, $insert_query);
			header('Location: login.php');
		}
	} 
}
?>
		</div>
	</div>
</div>
<?php include("includes/footer.php");?>