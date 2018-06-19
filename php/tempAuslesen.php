<?php
session_start();
function getTerm(){
  //Ließt Termometer Daten aus

  $fp = fopen("/sys/devices/w1_bus_master1/28-051670b0a3ff/w1_slave","r");
  //Datei wird als Objekt gespeicher

  if($fp){
  //Wenn die Datei existiert…
    $zeile = fread($fp, 200);
    //Der Inhalt der Datei wird gelesen

    $zeile = substr($zeile, -15);
	  $beginTemp = strpos($zeile,"=");
    $tempStr = substr($zeile,$beginTemp - strlen($zeile)+1);
    //Die Temperatur wird aus dem Inhalt entnommen

    $temp = floatval($tempStr);
    $temp = $temp / 1000;
    //Die Temperatur wird in Grad Celsius umgewandelt

    fclose($fp);
    //Die Datei wird wieder geschlossen

    return $temp;
    //Die Temperatur wird ausgegeben

  }else{
    return "Termometer nicht angeschlossen";
    //Bei fehlender Datei wird Fehlermeldung erstellt
  }
}
$temperatur = getTerm();
  if($_SESSION["aktuellerSchritt"] <= $_SESSION["anzahlRasten"]){
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
    //Daten werden der Datenbank hinzugefügt
		if($conn->query($sql) === TRUE){

		}else{
			echo "Error: ".$sql."<br>".$conn->error;
		};
		$conn->close();
  };


echo $temperatur."°C";
?>
