<!DOCTYPE html>
<?php
	session_start();

	$anzahlRasten = $_SESSION["anzahlRasten"];

	if($_SESSION["last_page"]=="login"){
		$_SESSION["buttonPressed"] = 0;
		$data = array();
		$buffer = $_POST["buffer"];
		$_SESSION["buffer"] = $buffer;
		$_SESSION["startTime"] = false;
		$_SESSION["aktuellerSchritt"] = 0;

		for($i=1; $i<=$anzahlRasten; $i++){
			$data["schrittName".$i] = $_POST["schrittName".$i];
			$data["zeit".$i] = floatval($_POST["zeit".$i] * 60);
			$data["richtTemp".$i] = $_POST["richtTemp".$i];

		}
		// Wenn die letzte Seite die login seite war werden die eingegeben werte jetzt in
		// einer Array gespeichert
	}

	if($_SESSION["last_page"]=="settings"){

		$data = $_SESSION["data"];
		for($i=1; $i<=$anzahlRasten; $i++){
			if($_POST["schrittName".$i]){
				$data["schrittName".$i] = $_POST["schrittName".$i];
			}
			if($_POST["zeit".$i]){
				$data["zeit".$i] = floatval($_POST["zeit".$i] * 60);
			}
			if($_POST["richtTemp".$i]){
				$data["richtTemp".$i] = $_POST["richtTemp".$i];
			}
		}
		if($_POST["buffer"]){
			$_SESSION["buffer"] = $_POST["buffer"];
		}
		// Wenn die letzte Seite die Einstellungs Seite war werden die geänderten variablen
		// überschrieben
	}

	if($_SESSION["last_page"]=="vorlagen"){
		$data = array();
		$_SESSION["anzahlRasten"] = 3;
		$_SESSION["buffer"] = 2;
		$_SESSION["aktuellerSchritt"] = 0;
		$_SESSION["buttonPressed"] = 0;
		$data["schrittName1"] = "Phase 1";
		$data["schrittName2"] = "Phase 2";
		$data["schrittName3"] = "Phase 3";
		$data["zeit1"] = 60;
		$data["zeit2"] = 180;
		$data["zeit3"] = 60;
		$data["richtTemp1"] = 20;
		$data["richtTemp2"] =	25;
		$data["richtTemp3"] = 20;
		//Wenn zulest die vorlagen Seite aktiv war, wird die Vorlage verwendet
	}

	$_SESSION["data"] = $data;
	//Daten werden in der Session gespeichert

?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Brau-o-mat</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
      <div class="nav-wrapper teal lighten-2">
        <a href="#" class="brand-logo center">Brau-o-mat</a>
      </div>
    </nav>
    <div class="container">
			<br>
			<div class="progress">
      	<div class="indeterminate"></div>
  		</div>
		</div>
		<script type="text/javascript">
			//Leitet weiter zur Hauptseite
			window.location.replace("/Brau-o-mat/dashboard.php");
		</script>
  </body>
</html>
