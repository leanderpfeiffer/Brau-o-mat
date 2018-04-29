<?php
session_start();
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
$temperatur = getTerm();
  if($_SESSION["aktuellerSchritt"] <= $_SESSION["numberOf_MV"]){
		$servername = "localhost";
		$username = "root";
		$password = "raspberry";
		$dbname = "TemperaturDaten";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if($conn->connect_error){
			die("Connection failed: ". $conn->connect_error);
		};
		$sql = "INSERT INTO " . $_SESSION["user"] . " (progress, temperature)
					VALUES (" . $_SESSION["aktuellerSchritt"] . ", " . $temperatur . "); ";
		if($conn->query($sql) === TRUE){

		}else{
			echo "Error: ".$sql."<br>".$conn->error;
		};
		$conn->close();
  };


echo $temperatur."°C";
?>
