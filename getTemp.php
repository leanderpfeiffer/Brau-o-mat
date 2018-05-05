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

echo $temperatur."°C";
?>
