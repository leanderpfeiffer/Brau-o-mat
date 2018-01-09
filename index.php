<?php
	session_start();
	session_unset();
	session_destroy();
?>

<html>
<head>
	<title>Brau-omat</title>
	<!-- <link href="main.css" rel="stylesheet" type="text/css" /> -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light  sticky-top">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Brau-omat</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a href="#Home" class="nav-link disabled">Home</a></li>
			<li class="nav-item"><a href="#News" class="nav-link disabled">Graph</a></li>
			<li class="nav-item"><a href="#Settings" class="nav-link disabled">Settings</a></li>
		</ul>
	</nav>


	<div class="container jumbotron">
		<h1>Brau-omat</h1>
		<form action="login.php" method="post"class="col-sm-4">
			<div class="form-group">
				<label for="text">Name ihres Brauvorgangs</label>
				<input type="text" class="form-control" name="user">
			</div>
			<div class="form-group">
				<label for="number">Anzahl der zuplanenden Maischevorgänge:</label>
				<input type="number" class="form-control" name="count">
			</div>
			<button type="submit" class="btn btn-primary">Los gehts!</button>
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
