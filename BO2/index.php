<!DOCTYPE html>
<?php
// zerstört die letzte Session
	session_start();
	session_unset();
	session_destroy();
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
  </head>
  <body>

		<nav>
      <div class="nav-wrapper teal">
        <a href="#" class="brand-logo center">Brau-omat</a>
      </div>
    </nav>


	    <div class="container">
				<h2 class="header">Willkommen</h2>
				<p class="flow-text">!Willkommenstext</p>
				<div class="row">
					<div class="col s12 m7">
						<div class="card">
							<div class="card-content">
								<span class="card-title">Eigenen Brauvorgang erstellen</span>
			          <form action="eigen.php" method="post">
			          	<div>
			          		<label for="text">
			                Name ihres Brauvorgangs
			              </label>
			          		<input type="text" class="validate" name="user">
			        		</div>
			        		<div>
			          				<label for="number">Anzahl der zuplanenden Maischevorgänge:</label>
			          				<input type="number" class="validate" name="anzahlRasten">
			        		</div>
			      			<button type="submit" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">save</i></button>
			      		</form>
							</div>
						</div>
					</div>
					<div class="col s12 m5">
						<div class="card">
							<div class="card-content">
								<span class="card-title">Vorlage Aussuchen</span>
								<p>Einen von mehreren Vorlagen auswählen und ohne große Sorgen Brauen.</p>
								<br>
								<form action="vorlagen.php" method="post">
									<button type="submit" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">search</i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col s12 m5">
					<div class="card">
						<div class="card-content">
							<span class="card-title">Temperaturverlauf abrufen</span>
							<form action="tempverlauf.php" method="post">
								<div>
									<label for="text">
										Datenkennung
									</label>
									<input type="text" class="validate" name="user">
								</div>
								<button type="submit" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">save</i></button>
							</form>
						</div>
					</div>
	    </div>
		</div>

		<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>
  </body>
</html>
