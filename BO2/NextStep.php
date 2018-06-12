<?php
session_start();

$aktuellerSchritt = $_SESSION["aktuellerSchritt"];
$_SESSION["aktuellerSchritt"] = $aktuellerSchritt + 1;
//Der aktuelle schritt wird um eins erhöht

$_SESSION["buttonPressed"] = 1;
//Vermerk das der Button gedrückt wurde

?>
