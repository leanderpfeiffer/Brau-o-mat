<html>
<head>
	<title>Brau-omat</title>
	<!-- <link href="main.css" rel="stylesheet" type="text/css" /> -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container jumbotron">	<!--seperates navbar from body-->
		<h1>Brau-omat</h1>
		<form action="login.php" method="post"class="col-sm-4">
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
