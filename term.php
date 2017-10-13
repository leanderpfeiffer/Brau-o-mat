
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
					elseif($temp > 25){
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