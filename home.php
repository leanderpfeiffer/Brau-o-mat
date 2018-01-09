<?php
session_start();
?>
<html>
<head>
	<title>Brau-omat</title>

		<!-- <link href="main.css" rel="stylesheet" type="text/css" /> -->
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
			xmlhttp.open("GET","core.php",true);
			xmlhttp.send();
			i++;
			console.log(i);
		};
		
		function start(){
		
			console.log("Start");
			//document.getElementById("test").innerHTML = "<p>Die aktuelle Temperatur beträgt: </p>";
			setInterval(refreshTemp, 1000);
			
		};

		function openGrapf(){
			console.log("triggered");
			window.location.href = "/Brau-omat/graph.php";
		
		}
	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light  sticky-top">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Brau-omat</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item active"><a href="#same" class="nav-link">Home</a></li>
			<li class="nav-item"><a href="/Brau-omat/graph.php" class="nav-link">Graph</a></li>
			<li class="nav-item"><a href="/Brau-omat/settings.php" class="nav-link">Settings</a></li>
		</ul>
	</nav>
	<div class="container" id="dynamic">
		<script>start();</script>
	</div>

	<!-- JQuery Plugin -->
	<script src="assets/js/jquery.min.js"></script>

	<!-- Popper Plugin -->
	<script src="assets/js/popper.min.js"></script>
	
	<!-- Bootstrap JS Plugin -->
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
