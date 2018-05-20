<?php
session_start();

$aktuellerSchritt = $_SESSION["aktuellerSchritt"];
$_SESSION["aktuellerSchritt"] = $aktuellerSchritt + 1;
$_SESSION["buttonPressed"] = 1;
?>
