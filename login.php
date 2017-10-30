<html>
	<head>
		<title>Brau-omat</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Brau-omat</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a href="#Home" class="nav-link disabled">Home</a></li>
			<li class="nav-item"><a href="#News" class="nav-link disabled">News</a></li>
			<li class="nav-item"><a href="#Contact" class="nav-link disabled">Contact</a></li>
			<li class="nav-item"><a href="#About" class="nav-link disabled">About</a></li>
			<li class="nav-item"><a href="#Settings" class="nav-link disabled">Settings</a></li>
		</ul>
	</nav>
		<div class="container jumbotron">
			
			<form action="processing.php" method="post" class="col-sm-4">
		<?php
			session_start();
			$count=$_POST["count"];
			$user = $_POST["user"];
			$_SESSION["ref"]="login";
			$_SESSION["count"]=$count;
			$_SESSION["user"] = $user;
			
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
			$servername = "localhost";
			$username = "root";
			$password = "raspberry";
			$dbname = "TemperaturDaten";
			
			$conn = new mysqli($servername, $username, $password, $dbname);

			if($conn->connect_error){
				die("Connection failed: ". $conn->connect_error);
			}
			$sql = "CREATE TABLE ".$user." (
			counter INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			time_in_progress INT(11),
			progress INT(3),
			temperature DECIMAL(7,3)
			)";
			
			if($conn->query($sql) === TRUE){
				
			}else{
				echo "Error: ".$sql."<br>".$conn->error;
			}
			$conn->close();


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