<?php
	session_start();
	$data = $_SESSION["data"];
	function getData(){
			$servername = "localhost";
			$username = "root";
			$password = "raspberry";
			$dbname = "TemperaturDaten";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if($conn->connection_error){
				die("Connection failed: " . $conn->connect_error);
			}
			
			$sql = "SELECT `counter`, `temperature`,`progress` FROM `".$_SESSION["user"]."` ORDER BY `counter` ASC";
			
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
<meta charset="utf-8">
<title>Brau-omat 2.0</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<style media="screen">
.header{
	color: #009688;
	font-weight: 300;
}
th{
	font-weight: 300;

}
.transparent{
	opacity: 0;
	height: 0px;
}
</style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
     	function drawChart() {
        	var data = google.visualization.arrayToDataTable([
		['Counter','Temperatur'],
	<?php
		$result = getData();
		while($row = $result->fetch_assoc() AND $i < 10)
			{echo "[ '". convertToTime($row["counter"]) . "', ".floatval($row["temperature"])." ], ";
			} ?> ]);
        var options = {
		title: "Temperatur Verlauf",
		legend: { position: "bottom"}
	};
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);}


			console.log("Start");


    </script>
  </head>
  <body>
		<nav>
			<div class="nav-wrapper teal">
				<div class="row">
					<div class="col s0 m1 l1"></div>
					<div class="col m5">
						<a href="index.php" class="brand-logo" id="brand-logo">Brau-omat</a>
					</div>
					<div class="col m6">
						<ul id="nav-mobile" class="right hide-on-med-and-down">
							<li><a href="dashboard.php">Dashboard</a></li>
							<li class="active"><a href="#">Graph</a></li>
							<li><a href="settings.php">Einstellungen</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	<div class="container">
	<h2 class="header">Graph</h2>

			<div id="curve_chart" style="width: 900px; height: 500px"></div>
	<p class="flow-text"><div class="header">Datenkennung: </div><?php echo $_SESSION["user"];?></p>
</div>
  </body>
</html>
