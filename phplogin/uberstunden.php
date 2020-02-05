<?php
$query2 = 'SELECT TIME(SUM(geleistete_gesamtstunden - max_gesamtstunden)) AS zeit FROM `monatsabrechnung` where monatsabrechnungid=$monatsabrechnungid";';
	
	$statement = $conn->prepare($query2);
	$statement->execute();
	$result = selectdata($query2);
	$result2 = $result->fetch_row();
	
	
	$time_von_sql = explode(":", $result2[0]);
	
	echo $result2[0];
	
	echo 'Sie haben ' .$time_von_sql[0].' Stunden, '.$time_von_sql[1].' Minuten, '.$time_von_sql[2].' Sekunden gearbeitet.';
	
	?>