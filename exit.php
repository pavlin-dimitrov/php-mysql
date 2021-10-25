<?php 
include("includes/header.php");
	session_destroy();
	header("Location: index.php");
include("includes/footer.php");
?>