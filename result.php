<?php
include('includes/header.php');
?>

<div id="result">
	<div class="texture"></div>
	<div class="result-image"></div>

	<?php
	$read_query = "SELECT username, played_games, victories, defeats FROM users ORDER BY victories DESC";
	$result = mysqli_query($connection, $read_query);
	if (mysqli_num_rows($result) > 0) {
		echo "<div class='table-wrapper-scroll-y my-custom-scrollbar'>"; 	
		echo "<table class='table table-bordered table-striped mb-0 table-result'>";
			echo "<thead>";
				echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Name</th>";
					echo "<th>Played Games</th>";
					echo "<th>Victories</th>";
					echo "<th>Defeats</th>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
		$num = 1;
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
				echo "<td>".$num++."</td>";
				echo "<td>".$row['username']."</td>";
				echo "<td>".$row['played_games']."</td>";
				echo "<td>".$row['victories']."</td>";
				echo "<td>".$row['defeats']."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
	echo "</table>";
	echo "</div>";
	} else {
		echo "NO RECORDS FOUND !";
	}
	?>
		<div>
		<a href="game.php" class="log-btn res-btn-g">GAME</a>
		<a href="exit.php" class="log-btn res-btn-e">EXIT</a>
	</div>	
</div>

<?php
include('includes/footer.php');
?>