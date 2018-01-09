<html>
<head>		
	<title>Brau-omat</title>
	<meta http-equiv="refresh" content="0;
		URL=http://192.168.1.36/Brau-omat/home.php">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container">
	<p>test </p>
	<?php
	session_start();
	$count = $_SESSION["count"];
	if($_SESSION["ref"]=="login"){
		$data = array();
		$buffer = $_POST["buff"];
		$_SESSION["buffer"] = $buffer;
		$_SESSION["startTime"] = false;
		$_SESSION["now"] = 1;
		$_SESSION["tempCount"] = 0;
		$_SESSION["tempData"] = array();
		$_SESSION["data"]=1;
		
		for($i=1; $i<=$count; $i++){
			$data["name".$i] = $_POST["name".$i];
			$data["time".$i] = floatval($_POST["time".$i] * 60);
			$data["temp".$i] = $_POST["temp".$i];
		}
	var_dump($data);
	}
	
	if($_SESSION["ref"]=="settings"){
		$data = $_SESSION["data"];
		echo "Es funktioniert";
		for($i=1; $i<=$count; $i++){
			if($_POST["name".$i]){	
				$data["name".$i] = $_POST["name".$i];
			}
			if($_POST["time".$i]){
				$data["time".$i] = floatval($_POST["time".$i] * 60);
			}
			if($_POST["temp".$i]){
				$data["temp".$i] = $_POST["temp".$i];
			}
		}
		if($_POST["buffer"]){
			$_SESSION["buffer"] = $_POST["buffer"];
		}
	}
	var_dump($data);
	$_SESSION["data"] = $data;
	?>
	</div>
				<!-- JQuery Plugin -->
	<script src="assets/js/jquery.min.js"></script>

	<!-- Popper Plugin -->
	<script src="assets/js/popper.min.js"></script>
	
	<!-- Bootstrap JS Plugin -->
	<script src="assets/js/bootstrap.min.js"></script>
</body>
	
</html>