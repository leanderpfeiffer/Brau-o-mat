<?php
	session_start();
	function generateRandomString($length) {
    		return substr(str_shuffle(str_repeat($x='1234567890', ceil($length/strlen($x)) )),1,$length);}
	// Nutzer Angeben in Session speichern
 	$anzahlRasten = $_POST["anzahlRasten"];
 	$_SESSION["anzahlRasten"] = $anzahlRasten;
	$user = $_POST["user"].generateRandomString(3);
 	$_SESSION["last_page"] = "login";
  	$_SESSION["user"] = $user;

// Erstellt Tabelle in der Datenbank
  $servername = "localhost";
  $username = "root";
  $password = "raspberry";
  $dbname = "TemperaturDaten";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
  }
  $sql = "
  DROP TABLE IF EXISTS ".$user;
  var_dump($sql);
  if($conn->query($sql) === TRUE){

  }else{
    echo "Error: ".$sql."<br>".$conn->error;
  }
  $conn->close();
  $conn = new mysqli($servername, $username, $password, $dbname);

  if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
  }
  $sql = "
  CREATE TABLE ".$user." (
  counter INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  progress INT(2),
  temperature DECIMAL(6,3))";

  if($conn->query($sql) === TRUE){

  }else{
    echo "Error: ".$sql."<br>".$conn->error;
  }
  $conn->close();
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Brau-omat 2.0</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <nav>
      <div class="nav-wrapper teal">
        <a href="#" class="brand-logo center">Brau-omat</a>
      </div>
    </nav>
    <form action="processing.php" method="post" class="container">
      <div class="row">
      <?php
        // Gibt für jeden Rast eine Karte aus
        for($i = 1; $i <= $anzahlRasten; $i++){
          echo "<div class=\"col s12 m6 l4\">";
          echo "<div class=\"card\">";
          echo "<div class=\"card-content\">";
  				echo "<span class=\"card-title\">Vorgang ".$i."</span>";
  				echo "<label for=\"text\">Name:<label>";
  				echo "<input type=\"text\" class=\"validate\" name=\"schrittName".$i."\">";
  				echo "<label for=\"number\">Zeit (in Minuten):<label>";
  				echo "<input type=\"number\" class=\"validate\" name=\"zeit".$i."\">";
  				echo "<label for=\"number\">Richttemperatur (in °C):<label>";
  				echo "<input type=\"number\" class=\"validate\" name=\"richtTemp".$i."\">";
  				echo "</div>";
          echo "</div>";
          echo "</div>";
				}
      ?>
      <div class="col s12 m6 l4">
      <div class="card ">
        <div class="card-content">
          <label for="number">Buffer:</label>
          <input type="number" class="validate" name="buffer">
          <button type="submit" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">save</i></button>
      </div>
    </div>
    </div>
    </div>

    </form>

  </body>
</html>
