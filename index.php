<?php
session_start();
$buffer = $_POST["buff"];
$temperature = $_POST["temp"];
if (!isset($buffer) OR empty($buffer)){
	$buffer = 5;
}
if (!isset($temperature) OR empty($temperature)){
	$temperature = 25;
}

$_SESSION["buffer"] = $buffer;
$_SESSION["temperature"] = $temperature;


?>

<html>
<head>
	<title>Brau-omat</title>

		<link href="main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		var i = 0;
		function refreshTemp(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200){
					document.getElementById("dynamic").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","term.php",true);
			xmlhttp.send();
			i++;
			console.log(i);
		};
		
		function start(){
		
			
			document.getElementById("test").innerHTML = "<p>Die aktuelle Temperatur beträgt: </p>";
			setInterval(refreshTemp, 1000);
			
		};
	</script>
</head>
<body>
	<ul class="navbar">
		<li><a href="#same" class="active">Home</a></li>
		<li><a href="#news">News</a></li>
		<li><a href="#contact">Contact</a></li>
		<li><a href="#abaout">About</a></li>
		<li><a href="/Brau-omat/settings.php" class="settings">Settings</a></li>
	</ul>


		<div class="content">	<!--seperates navbar from body-->

		<h1>Brau-omat</h1>
		
		<div id="test"><button type="button" onclick="start()">Start</button></div>
		<div id="dynamic"></div>
		
	
	</div>
</body>
</html>
