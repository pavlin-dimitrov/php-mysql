<?php
$server = 'localhost';
$usarname = 'root';
$password = '';
$database = 'game_db';
$connection = mysqli_connect($server, $usarname, $password, $database);
if (!$connection) {
	die('No connection '.mysqli_connect_error($connection).' Error number: '.mysqli_connect_errno($connection));
} 
?>