<html>
	<head>
		<title>Brau-omat</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="container jumbotron">
			<form action="processing.php" method="post" class="col-sm-4">
		<?php
			session_start();
			$count=$_POST["count"];
			$_SESSION["count"]=$count;
			
			for($i = 1; $i <= $count; $i++){
				echo "<div class=\"form-group\">";
				echo "<h4>Vorgang ".$i."</h4>";
				echo "<label for=\"text\">Name:<label>";
				echo "<input type=\"text\" class=\"form-control\" name=\"name".$i."\">";
				echo "<label for=\"number\">Zeit (in Minuten):<label>";
				echo "<input type=\"number\" class=\"form-control\" name=\"time".$i."\">";
				echo "<label for=\"number\">Richttemperatur (in °C):<label>";
				echo "<input type=\"number\" class=\"form-control\" name=\"temp".$i."\">";
				echo "</div>";
				}
			?>
			<div class="form-group">
			<label for="number">Buffer (in °C):<label>
			<input type="number" class="form-control" name="buff">
			</div>
			<button type="submit" class="btn btn-primary">Prozess Starten</button>
			<form>
		</div>
			<!-- JQuery Plugin -->
	<script src="assets/js/jquery.min.js"></script>

	<!-- Popper Plugin -->
	<script src="assets/js/popper.min.js"></script>
	
	<!-- Bootstrap JS Plugin -->
	<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>