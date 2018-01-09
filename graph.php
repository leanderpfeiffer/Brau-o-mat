<?php	
	session_start();
	$data = $_SESSION["data"];
	function getData($step){
			$servername = "localhost";
			$username = "root";
			$password = "raspberry";
			$dbname = "TemperaturDaten";
	
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			if($conn->connection_error){
				die("Connection failed: " . $conn->connect_error);
			}
			if($step == "full"){
				$sql = "SELECT `counter`, `temperature`,`progress` FROM `".$_SESSION["user"]."` ORDER BY `counter` ASC";
			}else{
				$sql = "SELECT `counter`, `temperature`,`progress` FROM `".$_SESSION["user"]."` WHERE `progress` = ".$step."ORDER BY `counter` ASC";
			}
			$result = $conn->query($sql);
	
			$conn->close();
			return $result;
		}
	
	function convertToTime($count){
		$minTime = floor($count / 60);
		$sekTime = $count % 60;
		$sekStr = strval($sekTime);
		$minStr = strval($minTime);
		if(strlen($sekStr)==1){
			$sekStr = "0" . $sekStr;	
		}
		$timeStr = $minStr . ":" . $sekStr;
		return $timeStr;
	}
?> 

<html>
  <head>
<title>Brau-omat</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
     	function drawChart() {
        	var data = google.visualization.arrayToDataTable([
		['Counter','Temperatur'],
	<?php 
		$result = getData("full");
		while($row = $result->fetch_assoc() AND $i < 10)
			{echo "[ '". convertToTime($row["counter"]) . "', ".floatval($row["temperature"])." ], ";
			} ?> ]);
        var options = {
		title: "Temperatur Verlauf",
		legend: { position: "bottom"}
	};
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);}
		
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
	<nav class="navbar navbar-expand-lg navbar-light bg-light  sticky-top">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Brau-omat</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a href="/Brau-omat/home.php" class="nav-link">Home</a></li>
			<li class="nav-item active"><a href="#same" class="nav-link">Graph</a></li>
			<li class="nav-item"><a href="/Brau-omat/settings.php" class="nav-link">Settings</a></li>
		</ul>
	</nav>
	<div class="container">
	<h1 class="display-4">Graph</h1>
			<hr>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
	<div id="dynamic"><script>start();</script></div>
</div>
  </body>
</html>