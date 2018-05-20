<!DOCTYPE html>
<?php
  session_start();

  $data = $_SESSION["data"];
  //$_SESSION["aktuellerSchritt"] = 1;
  $aktuellerSchritt = $_SESSION["aktuellerSchritt"];
  $nextSchritt = $aktuellerSchritt + 1;
  $anzahlRasten = $_SESSION["anzahlRasten"];
  $fertigBei = $anzahlRasten + 1;
  $buttonPressed = $_SESSION["buttonPressed"]
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
      font-weight: 300;
    }
    th{
      font-weight: 300;

    }
    .transparent{
      opacity: 0;
      height: 0px;
    }
    </style>

    <script>
      var i = 0;
      window.onload = function(){
        // Bei Seiten start werden Informationen aus Php extrahiert

        var aktuellerSchritt = <?php echo $aktuellerSchritt; ?>;
        var anzahlRasten = <?php echo $anzahlRasten; ?>;
        var buttonPressed = <?php echo $buttonPressed; ?>;

        if (buttonPressed == 1) {
          // Hintergrundfarbe des Timers wird wieder weiß
          document.getElementById("Timer").classList.remove('teal');
          document.getElementById("TimerContent").innerHTML = "Bitte erhitzen Sie die Temperatur um den Timer zu starten";
        }
      }
      var buttonPressed1 = <?php echo $buttonPressed; ?>;
      console.log(buttonPressed1);
      var timerGo = 0;
      var timerStart = 0;
      var countDownDate = 0;
      //Daten zum aktuellen Prozess werden gespeichert
      var richtTemp = <?php if(0 < $aktuellerSchritt and $aktuellerSchritt < $fertigBei) {
        echo $data["richtTemp".$aktuellerSchritt];
      }else{
        echo "\"keineRT\"";} ?>;
      var buffer = <?php echo $_SESSION["buffer"]; ?>;
      if(richtTemp != "keineRT"){
        var minTemp = richtTemp - buffer;
        var maxTemp = richtTemp + buffer;
      }
      //console.log(minTemp+", "+maxTemp+", "+buffer);

//####################################################################################

      function makeButton(){
        var card = document.getElementById("TimerContent");
        card.innerHTML="";
        var button = document.createElement("button");
        var buttonText = document.createTextNode("Weiter");
        button.setAttribute("onclick", "NextStep()");
        button.setAttribute("type", "button");
        button.classList.add("btn");
        button.classList.add("waves-effect");
        button.classList.add("waves-light");
        button.appendChild(buttonText);
        card.appendChild(button);
        }
//####################################################################################

      //AJAX liest per php script Temperatur aus
      function refreshTemp(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("AktTemp").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET","tempAuslesen.php",true);
        xmlhttp.send();
        i++;

        //Temperatur wird zu float umgewandelt
        var temperaturStr = document.getElementById("AktTemp").textContent;
        var temperatur = parseFloat(temperaturStr);

        if(richtTemp != "keineRT"){
          if(temperatur > maxTemp){

            document.getElementById("warningHot").classList.remove("transparent");
            console.log("Heiß");
            setRightTemp(1);
          }else if(temperatur < minTemp){

            document.getElementById("warningCold").classList.remove("transparent");
            console.log("Kalt");
            var timerGo = 1;

          }else if(minTemp< temperatur && temperatur < maxTemp){

            document.getElementById("warningHot").classList.add("transparent");
            document.getElementById("warningCold").classList.add("transparent");
            //Wenn die Temperatur den Idealwert erreicht hat wird der Timer gestartet
            setRightTemp(1);
            console.log("Perfekt");

          }
        }
      }

      // Aktualisiert Temperatur im SekundenTakt
      setInterval(refreshTemp, 1000);

//####################################################################################
      function conTime(){

        if(getActiveTimer() == 1){
          var countDownDate = getCountDownDate();

          // Get todays date and time
          var now = new Date().getTime();

          // Find the distance between now an the count down date
          var distance = countDownDate * 1000 - now;
          console.log(countDownDate);
          console.log(now);
          console.log(distance);
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          // Display the result in the element with id="demo"
          document.getElementById("TimerContent").innerHTML =
          + minutes + "m " + seconds + "s ";

          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("Timer").classList.add("teal");
            makeButton();
          }
        }
        if(getActiveTimer()==0 && getRightTemp()==1){
          getStartTime();
          setTimeout(setActiveTimer(1),2000);
        }

      }

      function getStartTime(){
        console.log("Los gehts");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if(this.readyState == 4 && this.status == 200){
            setCountDownDate(this.responseText);
            console.log(getCountDownDate());
          }
        };
        xmlhttp.open("GET","getStartTime.php",true);
        xmlhttp.send();

      }

      var x = setInterval(conTime, 1000);


//####################################################################################

      // Bei Knopfdruck werden die Daten des nächsten Schritt geladen
      function NextStep(){

        // Nächster Schritt wird gestartet
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if(this.readyState == 4 && this.status == 200){
            //document.getElementById("brand-logo").innerHTML = this.responseText;
		refreshPage();
          }
        };
        xmlhttp.open("GET","NextStep.php",true);
        xmlhttp.send();

      }

      function refreshPage(){
        // Lädt Seite neu
        window.location.replace("/BO2/dashboard.php");
      }
//##################################################################################
      var activeTimer = 0;
      function setActiveTimer(value){
        activeTimer = value;
      }
      function getActiveTimer(){
        return activeTimer;
      }
      var rightTemp = 0;
      function setRightTemp(value){
        rightTemp = value;
      }
      function getRightTemp(){
        return rightTemp;
      }
      function setCountDownDate(value){
        countDownDate = value;
      }
      function getCountDownDate(){
        return countDownDate;
      }
//##################################################################################

    </script>
  </head>

  <body>

    <nav>
      <div class="nav-wrapper teal">
        <div class="row">
          <div class="col s0 m1 l1"></div>
          <div class="col m5">
            <a href="index.php" class="brand-logo" id="brand-logo">Brau-omat</a>
          </div>
          <div class="col m6">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li class="active"><a href="#">Dashboard</a></li>
              <li><a href="graph.php">Graph</a></li>
              <li><a href="settings.php">Einstellungen</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <div class="container">

      <div class="card">
        <div class="card-content">
          <h2 class="header" id="AktSchrittName">
            <?php
            if($aktuellerSchritt == 0) {
              echo "Willkommen zum Dashboard";
            }elseif ($aktuellerSchritt >= $fertigBei) {
              echo "Brauvorgang beendet";
            }
            else{
              echo $data["schrittName".$aktuellerSchritt];
            };
            ?>
         </h2>
          <p class="flow-text" id="AktSchrittInfo">
            <?php
            if($aktuellerSchritt == 0) {
              echo "Hier erhalten Sie alle Informationen zum aktuellen Brauvorgang";
            }elseif ($aktuellerSchritt >= $fertigBei) {
              echo "Über die Navigationsleiste können Sie sich nun den Vorgang Graphisch anzeigen lassen";
            }
            else{
              echo "Schritt ".$aktuellerSchritt." von ".$anzahlRasten;
            };
            ?>
          </p>
        </div>
      </div>
      <div class="row">

        <div class="col s12 m6 l4">
          <div class="card">
            <div class="card-content">
              <table>
                <tbody id="Temperatur">
                  <tr>
                    <th class="header">Aktuelle Temperatur:</th>
                    <th id="AktTemp"></th>
                  </tr>
                  <?php
                    if(0 < $aktuellerSchritt && $aktuellerSchritt < $fertigBei){
                      echo "<tr><th class=\"header\">Richttemperatur:</th>";
                      echo "<th>".$data["richtTemp".$aktuellerSchritt]." °C</th></tr>";

                    }
                  ?>
                  <tr>
                    <th class="header">Buffer:</th>
                    <th><?php echo $_SESSION["buffer"]; ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col s12 m6 l4">
          <div class="card teal" id="Timer">
            <div class="card-content" id="TimerContent">
              <button type="button" name="button" onclick="NextStep()" class="btn waves-effect waves-light">
                Brauvorgang starten
              </button>
            </div>
          </div>
        </div>

        <div class="col s12 m6 l4">
          <div class="card">
            <div class="card-content" id="NächsterSchrittInfo">

              <?php
              if($aktuellerSchritt < $anzahlRasten){
                echo "<h5 class=\"header\">Nächster Schritt:</h5>";

                echo "<table><tbody>";

                echo "<tr><th class=\"header\">Name:</th><th>".$data["schrittName".$nextSchritt]."</th></tr>";
                echo "<tr><th class=\"header\">Richttemperatur:</th><th>".$data["richtTemp".$nextSchritt]." °C</th></tr>";
                echo "<tr><th class=\"header\">Dauer:</th><th>".$data["zeit".$nextSchritt]/60 ." min</th></tr>";
                echo "</tbody></table>";
              }else{
                echo "<h5 class=\"header\">Keine weiteren Schritte</h5>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="card red darken-4 transparent" id="warningHot">
        <div class="card-content red darken-1">
          <h5 class="white-text center">Gemisch zu heiß!</h5>
          <p class="white-text center">Bitte Temperatur senken</p>
        </div>
      </div>
      <div class="card red darken-4 transparent" id="warningCold">
        <div class="card-content red darken-1">
          <h5 class="white-text center">Gemisch zu kalt!</h5>
          <p class="white-text center">Bitte Temperatur erhöhen</p>
        </div>
      </div>
      <div class="transparent" id="transport">

      </div>
    </div>
  </body>
</html>
