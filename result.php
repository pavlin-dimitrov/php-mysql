<?php
include('includes/header.php');
?>

<div id="result">
	<div class="texture"></div>
	<div class="result-image"></div>

	<?php
	// NEW 
	$read_query = "SELECT u.username, count(r.id) AS 'Played Games', sum(r.victories) AS VICTORIES, sum(r.defeats) AS DEFEATS FROM `results` r JOIN users u ON (u.id = r.id) GROUP BY r.id ORDER BY r.victories DESC";
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
				echo "<td>".$row['Played Games']."</td>";
				echo "<td>".$row['VICTORIES']."</td>";
				echo "<td>".$row['DEFEATS']."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
	echo "</table>";
	echo "</div>";
	} else {
		echo "NO RECORDS FOUND !";
	}
	?>
	
</div>
	<div>
		<a href="game.php" class="log-btn res-btn-g">GAME</a>
		<a href="exit.php" class="log-btn res-btn-e">EXIT</a>
	</div>
<?php
include('includes/footer.php');
?>