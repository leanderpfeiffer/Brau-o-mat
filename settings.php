<html>
<head>
	<title>Brau-omat</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		
		<div class="navbar-header">
			<a class="navbar-brand" href="/Brau-omat/index.php">Brau-omat</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a href="/Brau-omat/home.php" class="nav-link">Home</a></li>
			<li class="nav-item"><a href="#news" class="nav-link">News</a></li>
			<li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
			<li class="nav-item"><a href="#about" class="nav-link">About</a></li>
			<li class="nav-item active"><a href="#" class="nav-link">Settings</a></li>
		</ul>
	</nav>
	<div class="container">
		<h1>Settings</h1>
		<form action="index.php" method="post">
		Richttemperatur: <input type="number" name="temp"><br>
		Buffer: <input type="text" name="buff"><br>
		<input type="submit">
		</form>

	</div>

		<!-- JQuery Plugin -->
	<script src="assets/js/jquery.min.js"></script>

	<!-- Popper Plugin -->
	<script src="assets/js/popper.min.js"></script>
	
	<!-- Bootstrap JS Plugin -->
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
