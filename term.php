
			<?php
				session_start();
				$time = $_SESSION["time"];
				//Prüfen ob Zeit abgelaufen ist
				if($time>0){
					$minTime = floor($time / 60);
					$sekTime = $time % 60;
					$sekStr = strval($sekTime);
					$minStr = strval($minTime);
					//Bei einzahligen Sekundenwerten eine 0 vor die Ziffer setzen
					if(strlen($sekStr)==1){
						$sekStr = "0" . $sekStr;	
						}
					//Zeit zusammensetzen und Ausgeben
					$timeStr = $minStr . " : " . $sekStr . " min";
					echo "<div class=\"timer\"><p>$timeStr</p></div>";
					//Zeit dekrementieren	
					$_SESSION["time"] = $time -1;
						
					$fp = fopen("/sys/devices/w1_bus_master1/28-051670b0a3ff/w1_slave","r");
					if($fp){
						$zeile = fread($fp, 200); 
						$termStr = substr($zeile,-6);
						$term = floatval($termStr);
						$term = $term / 1000;
						$bufferStr = $_SESSION["buffer"];
						$tempStr = $_SESSION["temperature"];
						echo "<p id=\"warning\"><strong>$term °C</strong></p>";
						//echo "<hr><p>Die Richttemperatur beträgt: $tempStr °C<br>Der Buffer beträgt: $bufferStr °C</p>"
						if($term < $temp - $buffer){
							echo "<p class=\"hot\" id=\"warning\">Es ist zu kalt!</p>";
						}elseif($term > $temp + $buffer){
							echo "<p class=\"hot\" id=\"warning\">Es ist zu heiß!</p>";
						}else{
							echo "<p>Alles gut</p>";}
						fclose($fp);
						echo "<p>Die Richttemperatur beträgt: $tempStr °C<br>Der Buffer beträgt: $bufferStr °C</p>";
					}else{
						echo "Data not found";}
				}else{
					echo "<p>Schritt beendet!</p>";
					}
		?>
		<br>