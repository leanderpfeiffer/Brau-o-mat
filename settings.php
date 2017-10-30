<html>
<head>
	<title>Brau-omat</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		
		<div class="navbar-header">
			<a class="navbar-brand" href="/Brau-omat/index.php">Brau-omat</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a href="/Brau-omat/home.php" class="nav-link">Home</a></li>
			<li class="nav-item"><a href="#news" class="nav-link">News</a></li>
			<li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
			<li class="nav-item"><a href="#about" class="nav-link">About</a></li>
			<li class="nav-item active"><a href="#" class="nav-link">Settings</a></li>
		</ul>
	</nav>
	<div class="container">
			<h1 class="display-4">Settings</h1>
			<hr>
			<form action="processing.php" method="post" class="col-sm-4">
		<?php
			session_start();
			$count=$_SESSION["count"];
			$_SESSION["ref"] = "settings";
			$data = $_SESSION["data"];
			for($i = 1; $i <= $count; $i++){
				echo "<div class=\"form-group\">";
				echo "<h4>Vorgang ".$i."</h4>";
				echo "<label for=\"text\">Name:<label>";
				echo "<input type=\"text\" class=\"form-control\" name=\"name".$i."\" placeholder=\"".$data["name".$i]."\">";
				echo "<label for=\"number\">Zeit (in Minuten):<label>";
				echo "<input type=\"number\" class=\"form-control\" name=\"time".$i."\" placeholder=\"".$data["time".$i]."\">";
				echo "<label for=\"number\">Richttemperatur (in °C):<label>";
				echo "<input type=\"number\" class=\"form-control\" name=\"temp".$i."\" placeholder=\"".$data["temp".$i]."\">";
				echo "</div>";
				}
			?>
			<div class="form-group">
			<label for="number">Buffer (in °C):<label>
			<input type="number" class="form-control" name="buffer" placeholder="<?php echo $_SESSION["buffer"];  ?>">
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
