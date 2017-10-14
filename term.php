
			<?php
				session_start();
				$fp = fopen("/sys/devices/w1_bus_master1/28-051670b0a3ff/w1_slave","r");
				if($fp){
					$zeile = fread($fp, 200); 
					$termStr = substr($zeile,-6);
					$term = floatval($termStr);
					$term = $term / 1000;
					$bufferStr = $_SESSION["buffer"];
					$tempStr = $_SESSION["temperature"];
					echo "<p><strong>$term °C</strong></p>";
					echo "<aside>Die Richttemperatur beträgt: $tempStr °C<br>Der Buffer beträgt: $bufferStr °C</aside>";
					$temp = floatval($tempStr);
					$buffer = floatval($bufferStr); 
					if($term < $temp - $buffer){
						echo "<p class=\"hot\">Es ist zu kalt!</p>";
					}
					elseif($term > $temp + $buffer){
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