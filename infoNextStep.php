<?php
session_start();

$data = $_SESSION["data"];
$aktuellerSchritt = $_SESSION["aktuellerSchritt"];

echo "<h5 class=\"header\">Nächster Schritt:</h5>";

echo "<table><tbody>";

echo "<tr>";
echo "<th>Name:</th>";
echo "<th id=\"SchrittName\">".$data["schrittName" . $aktuellerSchritt]."</th>";
echo "</tr>";

echo "<tr>";
echo "<th>Richttemperatur:</th>";
echo "<th id=\"RichtTemp\">".$data["richtTemp" . $aktuellerSchritt] . " °C</th>";
echo "</tr>";

echo "<tr>";
echo "<th>Dauer:</th>";
echo "<th id=\"Zeit\">".$data["zeit" . $aktuellerSchritt] / 60 . " min</th>";
echo "</tr>";

echo "</tbody></table>";

 ?>
