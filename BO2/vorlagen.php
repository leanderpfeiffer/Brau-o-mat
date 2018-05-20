<!DOCTYPE html>
<?php
  function generateRandomString($length) {
    return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }
  session_start();
  $_SESSION["last_page"] = "vorlagen";
  $user = generateRandomString(3);
  $_SESSION["user"] = $user;

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
  counter INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  progress INT(3),
  temperature DECIMAL(7,3))";
  var_dump($sql);
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
    <style media="screen">
    .header{
      color: #009688;
      font-weight: 300
    }
  </style>
  <script type="text/javascript">
    function VorAuswahl(auswahl){
      url = "processing.php?q=" + auswahl.toString();
      window.location.replace(url);
    }
  </script>
  </head>
  <body>
    <nav>
      <div class="nav-wrapper teal">
        <a href="#" class="brand-logo center">Brau-omat</a>
      </div>
    </nav>
    <div class="container">
      <h2 class="header">Vorlagen</h2>
      <p class="flow-text">!Willkommenstext</p>
      <div class="row">
        <div class="col s12 m6">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Test-Vorlage</span>
              <ul class="collection">
                <li class="collection-item">Phase 1 - 1min - 20°</li>
                <li class="collection-item">Phase 2 - 3min - 25°</li>
                <li class="collection-item">Phase 3 - 1min - 20°</li>
              </ul>
              <button type="button" name="button" class="btn waves-effect waves-light" onclick="VorAuswahl(1)">Auswählen</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
