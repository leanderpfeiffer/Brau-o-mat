<?php
		$servername = "localhost";
		$username = "root";
		$password = "raspberry";
		$dbname = "TemperaturDaten";

		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if($conn->connection_error){
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT `counter`, `temperature` FROM `test3` ORDER BY `counter` ASC";
		$result = $conn->query($sql);

		$conn->close();
		function convertToTime($count){
			$minTime = floor($count / 60);
			$sekTime = $count % 60;
			$sekStr = strval($sekTime);
			$minStr = strval($minTime);
			if(strlen($sekStr)==1){
				$sekStr = "0" . $sekStr;	
			}
			$timeStr = $minStr . ":" . $sekStr;
			return $timeStr;
		}
?> 

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
	['Counter','Temperatur'],
	

	<?php 
		while($row = $result->fetch_assoc() AND $i < 10)
		{
			echo "[ '". convertToTime($row["counter"]) . "', ".floatval($row["temperature"])." ], ";
			
		} 
	?>
        ]);

        var options = {
          
          
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>

  </body>
</html>