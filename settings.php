<?php
  session_start();
// Nutzer Angeben in Session speichern
  $anzahlRasten = $_SESSION["anzahlRasten"];
	$_SESSION["last_page"]= "settings";
	$data = $_SESSION["data"];
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
						<li><a href="dashboard.php">Dashboard</a></li>
						<li><a href="graph.php">Graph</a></li>
						<li  class="active"><a href="#">Einstellungen</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div class="container">
			<h2 class="header">Einstellungen</h2>
			<br>
			<form action="processing.php" method="post">
	      <div class="row">
			<?php
				// Gibt für jeden MV eine Karte aus
				for($i = 1; $i <= $anzahlRasten; $i++){
					echo "<div class=\"col s12 m6 l4\">";
					echo "<div class=\"card\">";
					echo "<div class=\"card-content\">";
					echo "<span class=\"card-title\">Vorgang ".$i."</span>";
					echo "<label for=\"text\">Name:<label>";
					echo "<input type=\"text\" name=\"schrittName".$i."\" placeholder=\"".$data["schrittName".$i]."\">";
					echo "<label for=\"number\">Zeit (in Minuten):<label>";
					echo "<input type=\"number\" class=\"validate\" name=\"zeit".$i."\" placeholder=\"".$data["zeit".$i] / 60 ."\">";
					echo "<label for=\"number\">Richttemperatur (in °C):<label>";
					echo "<input type=\"number\" class=\"validate\" name=\"richtTemp".$i."\" placeholder=\"".$data["richtTemp".$i]."\">";
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
			?>
			<div class="col s12 m6 l4">
			<div class="card ">
				<div class="card-content">
					<label for="number">Buffer:</label>
					<input type="number" class="validate" name="buffer" placeholder="<?php echo $_SESSION["buffer"];  ?>">
					<button type="submit" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">save</i></button>
			</div>
		</div>
		</div>
			</div>
		</form>
		</div>

</body>
</html>
