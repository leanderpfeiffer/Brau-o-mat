<html>
<head>
	<title>Brau-omat</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		var i = 0;
		function refreshTemp(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200){
					document.getElementById("dynamic").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","timerInBg.php",true);
			xmlhttp.send();
			i++;
			console.log(i);
		};
		
		function start(){
		
			console.log("Start");
			//document.getElementById("test").innerHTML = "<p>Die aktuelle Temperatur beträgt: </p>";
			setInterval(refreshTemp, 1000);
			
		};
	</script>
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
		
		<div class="navbar-header">
			<a class="navbar-brand" href="/Brau-omat/index.php">Brau-omat</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a href="/Brau-omat/home.php" class="nav-link">Home</a></li>
			<li class="nav-item"><a href="/Brau-omat/graph.php" class="nav-link">Graph</a></li>
			<li class="nav-item active"><a href="#same" class="nav-link">Settings</a></li>
		</ul>
	</nav>
	<div class="container">
			<h1 class="display-4">Settings</h1>
			<hr>
			<div class="row">
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
			<button type="submit" class="btn btn-primary">Speichern</button>
			</form>
			<div class="col-sm"><p>Änderungen an der aktuellen Zeit können zu Problemen führen!</p>
			</div>
			</div>
		</div>
		<div id="dynamic"><script>start();</script></div>
		<!-- JQuery Plugin -->
	<script src="assets/js/jquery.min.js"></script>

	<!-- Popper Plugin -->
	<script src="assets/js/popper.min.js"></script>
	
	<!-- Bootstrap JS Plugin -->
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
