
			<?php
				session_start();
				//Temperatur wird ausgelesen
				$fp = fopen("/sys/devices/w1_bus_master1/28-051670b0a3ff/w1_slave","r");
				if($fp){
					$zeile = fread($fp, 200); 
					$termStr = substr($zeile,-6);
					$term = floatval($termStr);
					$term = $term / 1000;
					
					//Temperatur wird ausgegeben
					echo "<p><strong>$term °C</strong></p>";
					
					//Werte werden über Session abgerufen
					$maxTemp = $_SESSION["maxTemp"];
					$minTemp = $_SESSION["minTemp"];
					
					//Warnungen werden je nach Temperatur angezeigt
					if($term < $maxTemp){
						echo "<p class=\"hot\">Es ist zu kalt!</p>";
					}
					elseif($term > $minTemp){
						echo "<p class=\"hot\">Es ist zu heiß!</p>";
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