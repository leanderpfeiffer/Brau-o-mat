<html>
<head>
	<title>Brau-omat</title>
	<meta http-equiv="refresh" content=" 5;
		URL=http://192.168.1.36/thermometer/">
		<link href="main.css" rel="stylesheet" type="text/css" />

</head>
<body>
	
	

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
	
	
</body>
</html>
