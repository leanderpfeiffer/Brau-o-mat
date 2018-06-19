<?php
session_start();

$data = $_SESSION["data"];
$aktuellerSchritt = $_SESSION["aktuellerSchritt"];
$startTime = $_SESSION["startTime".$aktuellerSchritt];
//Werte aus der Session abrufen

if($startTime){
  echo $startTime;
  //Wenn bereits eine Startzeit festgelegt wurde, wird diese verwendet

}else{
  $time = $data["zeit".$aktuellerSchritt];
  $startTime = time() + $time;
  echo $startTime;
  $_SESSION["startTime".$aktuellerSchritt] = $startTime;
  //Ansonsten wird mithilfe der aktuellen Zeit eine neue berechnet und in der Session gespeichert
}

 ?>
