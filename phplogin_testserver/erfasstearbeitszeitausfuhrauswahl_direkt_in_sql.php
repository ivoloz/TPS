<?php
$auswahl = $_POST["auswahl"];
echo "Hallo $auswahl ";




require_once 'crud.php';

$conn = OpenCon();

//SQL: TIME(ZAHL) -> Formatieren als Stunden
//SQL: Summe auf DB: SELECT TIME(SUM(ende-beginn)) AS zeit FROM `erfasstearbeitszeit` where benutzerid=4 and beginn LIKE "2020-02-%%"
//In PHP $time_von_sql = explode(":", result2[0]) ==> $time_von_sql[0] Stunden, $time_von_sql[1] Minuten, $time_von_sql[2] Sekunden

$jahr = "2020";
$monat = "01";

$query = 'SELECT TIME(SUM(ende-beginn)) AS zeit FROM `erfasstearbeitszeit` where benutzerid="'.$auswahl.'" and beginn LIKE "'.$jahr.'-'.$monat.'-%%";';
	
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	$result2 = $result->fetch_row();
	
	
	$time_von_sql = explode(":", $result2[0]);
	
	echo 'Sie haben ' .$time_von_sql[0].' Stunden, '.$time_von_sql[1].' Minuten, '.$time_von_sql[2].' Sekunden gearbeitet.';
	
	return $result2[0];

	//$t = strtotime('$result2[0]');
    //echo date('H:i:s',$t);
	

?>

