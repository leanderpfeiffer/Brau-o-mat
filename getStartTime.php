<?php
session_start();

$data = $_SESSION["data"];
$aktuellerSchritt = $_SESSION["aktuellerSchritt"];
$time = $data["zeit".$aktuellerSchritt];
$startTime = $_SESSION["startTime".$aktuellerSchritt];
if($startTime){
  echo $startTime;
}else{
  $startTime = time() + $time;
  echo $startTime;
  $_SESSION["startTime".$aktuellerSchritt] = $startTime;
}

 ?>
