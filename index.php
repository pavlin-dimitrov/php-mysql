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
		<div class="home-btns">	
			<h2>IT-Village</h2>
			<form method="post">
				<div class="log-buttons">
					<div><input class="log-btn btn1" type="submit" name="submit-login" value="Login"></div>
					<div><input class="log-btn btn2" type="submit" name="submit-register" value="Register"></div>
					<div style="margin-bottom: 92.2px"><input class="log-btn btn2" type="submit" name="about" value="About"></div>
				</div>
			</form>
		<div 
			style="<?php if(isset($_POST['submit-register'])){echo 'display: none';};?>" 
			id="welcome" 
			class="err-msg">Welcome to IT-Village!
		</div>
		</div>
<?php
if (isset($_POST['about'])) {
	header('Location: about.php');
}
if (isset($_POST['submit-login'])) {
	header('Location: login.php');
}
if (isset($_POST['submit-register'])) {
	header('Location: register.php');
}
?>
		</div>
	</div>
</div>
<?php include("includes/footer.php");?>