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
?>
