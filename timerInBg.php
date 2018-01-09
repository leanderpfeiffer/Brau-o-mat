<?php
	session_start();
	function conTime($time){
		//Zeit und Zählerwerte bekommen
		$now = $_SESSION["now"];	
		
		//Wenn die Zeit noch nicht null ist die Zeit weiterführen, ansonsten Zähler + 1
		
		if($time>0){
			$_SESSION["data"]["time".$now] = $time -1;
		}else{
			$_SESSION["now"] = $now + 1;
			$_SESSION["startTime"] = false;
		}			
	}
	$now = $_SESSION["now"];
	$time = $_SESSION["data"]["time".$now];
	conTime($time)
?>