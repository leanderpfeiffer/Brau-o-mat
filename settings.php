<html>
<head>
	<title>Brau-omat</title>
	<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<ul class="navbar">
		<li><a href="/Brau-omat/" >Home</a></li>
		<li><a href="#news" >News</a></li>
		<li><a href="#contact">Contact</a></li>
		<li><a href="#abaout">About</a></li>
		<li><a href="/Brau-omat/settings.php" class="settings_a">Settings</a></li>
	</ul>
	<div class="content">
		<h1>Settings</h1>
		<form action="index.php" method="post">
		Richttemperatur: <input type="number" name="temp"><br>
		Buffer: <input type="text" name="buff"><br>
		<input type="submit">
		</form>

	</div>
</body>
</html>
