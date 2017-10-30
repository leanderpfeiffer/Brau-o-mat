<?php
	session_start();

	function conTime($time){
		//Zeit und Zählerwerte bekommen
		$now = $_SESSION["now"];	
		
		//Wenn die Zeit noch nicht null ist die Zeit weiterführen, ansonsten Zähler + 1
		
		if($time>0){
			$_SESSION["data"]["time".$now] = $time -1;
			$minTime = floor($time / 60);
			$sekTime = $time % 60;
			$sekStr = strval($sekTime);
			$minStr = strval($minTime);
			if(strlen($sekStr)==1){
				$sekStr = "0" . $sekStr;	
			}
			$timeStr = $minStr . " : " . $sekStr . " min";
			return $timeStr;
		}else{
			$_SESSION["now"] = $now + 1;
			$_SESSION["startTime"] = false;
			return "next";
		}			
	}
				
	function getTerm(){
		//Ließt Termometer Daten aus
		$fp = fopen("/sys/devices/w1_bus_master1/28-051670b0a3ff/w1_slave","r");
		if($fp){
			$zeile = fread($fp, 200); 
			$termStr = substr($zeile,-6);
			$term = floatval($termStr);
			$term = $term / 1000;
			fclose($fp);
			return $term;
		}else{
			return "Termometer nicht angeschlossen";
		}
	}


	$now = $_SESSION["now"];
	$count = $_SESSION["count"];
	$buff = $_SESSION["buffer"];
	$temp = $_SESSION["data"]["temp".$now];
	$term = getTerm();
	$user = $_SESSION["user"];
	if($now <= $count){
		$time = $_SESSION["data"]["time".$now];
		$servername = "localhost";
		$username = "root";
		$password = "raspberry";
		$dbname = "TemperaturDaten";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if($conn->connect_error){
			die("Connection failed: ". $conn->connect_error);
		}
		$sql = "INSERT INTO " . $user . " (time_in_progress, progress, temperature)
					VALUES (" . $time . ", " . $now . ", " . $term . "); ";
		if($conn->query($sql) === TRUE){
			echo "Success";
		}else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();

		echo " <h1 class=\"display-4\">".$_SESSION["data"]["name".$now]."</h1>";
		echo "<span>Schritt ".$now." von ".$count."</span>";
		echo "<hr>";
		echo "<div class=\"row\">";
			echo "<div class=\"col-md-4\">";
				echo "<p>Die Temperatur beträgt:</p>";
				echo "<p><strong>".$term."°C</strong></p>";
				if($term > $temp + $buff){
					echo "<div class=\"alert alert-danger\" role=\"alert\">Es ist zu heiß!</div>";
					$_SESSION["startTime"]=true;
				}elseif($term < $temp - $buff){
					echo "<div class=\"alert alert-danger\" role=\"alert\">Es ist zu kalt!</div>";
				}else{ $_SESSION["startTime"]=true;
				}
			echo "</div>";
		
			echo "<div class=\"col-md-4\">";
			
				if($_SESSION["startTime"]){
					$timeStr = conTime($time);
					echo "<p>Die Restzeit beträgt:</p>";
					echo "<p><strong>".$timeStr."</strong></p>";
				}else{
					echo "<p>Bitte erhitzen Sie ihr Gemisch um den Timer zu starten</p>";
				}
			
			echo "</div>";
		
		echo "</div>";
	}else{
		echo "<h3>Brau-Vorgang beendet!</h3>";
		//echo "<script>window.location.href("http://stackoverflow.com");</script>";
	}
?>
