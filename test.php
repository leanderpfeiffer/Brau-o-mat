<html>
<head>
	<title>Brau-omat</title>
	
	<script type="text/javascript">
		var i = 0;
		function refreshTemp(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200){
					document.getElementById("dynamic").innerHTML = this.responseText;
				}
			};
		xmlhttp.open("GET","term.php",true);
		xmlhttp.send();
		i++;
		console.log(i);
		};
		function start(){
			document.getElementById("test").innerHTML = "";
			setInterval(refreshTemp, 1000);
		};
		
	</script>
</head>
	<body>

	
	<div id="dynamic"></div>
	<div id="test"><button type="button" onclick="start()">Start</button></div>
	
	</body>
</html>
