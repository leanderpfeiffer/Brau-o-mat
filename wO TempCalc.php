<html>
<head>
	<title>Brau-omat</title>
	<meta http-equiv="refresh" content=" 5;
		URL=http://192.168.1.36/thermometer/">
		<link href="main.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<ul class="navbar">
		<li><a href="http://192.168.1.36/thermometer/" class="active">Home</a></li>
		<li><a href="#news">News</a></li>
		<li><a href="#contact">Contact</a></li>
		<li><a href="#abaout">About</a></li>
		<li><a href="http://192.168.1.36/thermometer/settings.php" class="settings">Settings</a></li>
	</ul>


	<div class="content">

	<h1>Brau-omat</h1>
	<p>Die aktuelle Temperatur beträgt: </p>
		<?php
		$fp = fopen("temperatur.txt","r");
		if($fp){
			while(!feof($fp)){
				$zeile = fgets($fp, 100);
				echo "<p>$zeile °C</p>";
				$temp = floatval($zeile);
				
				if($temp < 20){
					echo "<p class=\"hot\">Es ist zu kalt!</p>";
				}
				elseif($temp > 25){
					echo "<p class=\"hot\">Es ist zu heiß!</p>";
				}
				else{
					echo "Alles gut";

				}
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
