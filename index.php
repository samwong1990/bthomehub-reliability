<?php
	$db = new PDO('sqlite:'.dirname(__FILE__) . '/wifi.db') or die("Can't open sqlitedb");
	$stat = $db->query("SELECT * FROM log;")->fetchAll();	
?>
<html>
  <head>
	
    <script type='text/javascript' src='http://www.google.com/jsapi'></script>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
	
    <script type='text/javascript'>
		google.load('visualization', '1', {'packages':['annotatedtimeline']});
		google.setOnLoadCallback(drawChart);
		var chart;
		var currentDataSet;
		var data;
		var dataSet;
		var options = {
			scaleType: 'allmaximized',
			thickness: 10,
			wmode: 'opaque',
		};
	function drawChart() {
		dataSet = new google.visualization.DataTable();
		dataSet.addColumn('date', 'Time');
        dataSet.addColumn('number', 'Working');
        dataSet.addColumn('string', 'title1');
        dataSet.addColumn('string', 'text1');
        dataSet.addRows([
		<?php
		$max = count($stat);
		$comments = array();
		for($i=0; $i < $max; $i++){
			$datetime = explode(" ", $stat[$i][0]);
			$date = explode("-", $datetime[0]);
			$time = explode(":", $datetime[1]);
			$date[1] = intval($date[1])-1;
			// new Date(year, month, day, hours, minutes, seconds, milliseconds);
			echo "[new Date($date[0], $date[1] , $date[2], $time[0], $time[1], $time[2], 0), " 
			. $stat[$i][1] . ", " . "' '" . ", " . "' '" . "]";
			if($i+1 == $max){
				echo "\n"; 
			}else{
				echo ",\n";
			}
		}
		?>
        ]);
		
		chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div'));
		currentDataSet = dataSet;
        chart.draw(dataSet, options);
      }
    </script>
  </head>

  <body>
	<div id='header'>
		
    <div id='chart_div' style='width: 100%; height: 400px;'></div>
	
  </body>
</html>
