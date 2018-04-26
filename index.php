<html>
<?php
	session_start();
	if($_GET["temp"]){
	$_SESSION["maxTemp"] = $_GET["temp"];
	}
	$maxTemp = $_SESSION["maxTemp"];
?>
<head>
	<title>Brau-omat</title>
	<meta http-equiv="refresh" content=" 5;
		URL=http://192.168.178.63/Brau-omat/">
		<link href="main.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<ul class="navbar">
		<li><a href="http://192.168.178.63/Brau-omat/" class="active">Home</a></li>
		<li><a href="#news">News</a></li>
		<li><a href="#contact">Contact</a></li>
		<li><a href="#abaout">About</a></li>
		<li><a href="/Test/settings.php" class="settings">Settings</a></li>
	</ul>


		<div class="content">	<!--seperates navbar from body-->

		<h1>Brau-omat</h1>
		<p>Die aktuelle Temperatur beträgt: </p>
			<?php
				$fp = fopen("/sys/devices/w1_bus_master1/28-051670b0a3ff/w1_slave","r");
				if($fp){
					$zeile = fread($fp, 200); 
					$tempStr = substr($zeile,-6);
					$temp = floatval($tempStr);
					$temp = $temp / 1000;
					echo "<p>$temp °C</p>";
					
					if($temp < 20){
						echo "<p class=\"hot\">Es ist zu kalt!</p>";
					}
					elseif($temp > $maxTemp){
						echo "<p class=\"hot\">Es ist zu heiß!</p>";
						echo $maxTemp;
					}
					else{
						echo "Alles gut";
					}
					fclose($fp);
				}
				else
					echo "Data not found";
		?>
		<br>
	
	</div>
</body>
</html>
