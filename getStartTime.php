<?php

// Der Session werden Werte entnommen
session_start();

$data = $_SESSION["data"];
$aktuellerSchritt = $_SESSION["aktuellerSchritt"];
$time = $data["zeit".$aktuellerSchritt];

// Startzeit wird ausgegeben
$startTime = $_SESSION["startTime".$aktuellerSchritt];

// Wenn die Startzeit existiert wird sie ausgegeben
if($startTime){
  echo $startTime;

// Wenn nicht wird sie berechnet, gespeichert und ausgegeben
}else{
  $startTime = time() + $time;
  echo $startTime;
  $_SESSION["startTime".$aktuellerSchritt] = $startTime;
}
 ?>
