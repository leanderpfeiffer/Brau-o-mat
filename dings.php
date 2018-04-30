<?php
  // Gibt für jeden Rast eine Karte aus
  for($i = 1; $i <= $anzahlRasten; $i++){

    //Titel
    echo "<h1>Rast ".$i."</h1>";

    //Eingabefeld Name
    echo "<label for=\"text\">Name:<label>";
    echo "<input type=\"text\" name=\"schrittName".$i."\">";

    //Eingabefeld Zeit
    echo "<label for=\"number\">Zeit (in Minuten):<label>";
    echo "<input type=\"number\" name=\"zeit".$i."\">";

    //Eingabefeld Richttemperatur
    echo "<label for=\"number\">Richttemperatur (in °C):<label>";
    echo "<input type=\"number\" name=\"richtTemp".$i."\">";

  }
  function conTime(){
		//Zeit und Zählerwerte bekommen
		$aktuellerSchritt = $_SESSION["aktuellerSchritt"];
		$time = $_SESSION["data"]["time".$aktuellerSchritt];

		//Wenn die Zeit noch nicht null ist die Zeit weiterführen, ansonsten Zähler + 1

		if($time>0){
			$_SESSION["data"]["time".$aktuellerSchritt] = $time -1;
      //...Rest des Timer

    }else{
      //Wenn die Zeit abgelaufen ist wird der nächste Schritt gestartet
			$_SESSION["aktuellerSchritt"] = $aktuellerSchritt + 1;
			$_SESSION["startTime"] = false;
      //Ausgabe in Timer Feld
      return "Nächster Schritt";
		}
	}
?>
