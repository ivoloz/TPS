<?php
$auswahl = $_POST["auswahl"];
$monat = $_POST["monat"];
$jahr = $_POST["jahr"];

//echo " $auswahl ";
//echo "$monat ";
//echo " $jahr ";



include 'crud.php';

$conn = OpenCon();

//SQL: TIME(ZAHL) -> Formatieren als Stunden
//SQL: Summe auf DB: SELECT TIME(SUM(ende-beginn)) AS zeit FROM `erfasstearbeitszeit` where benutzerid=4 and beginn LIKE "2020-02-%%"
//In PHP $time_von_sql = explode(":", result2[0]) ==> $time_von_sql[0] Stunden, $time_von_sql[1] Minuten, $time_von_sql[2] Sekunden

//$jahr = "2020";
//$monat = "01";

$query = 'SELECT TIME(SUM(ende-beginn)) AS zeit FROM `erfasstearbeitszeit` where benutzerid="'.$auswahl.'" and beginn LIKE "'.$jahr.'-'.$monat.'-%%";';
	
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	$result2 = $result->fetch_row();
	
	
	$time_von_sql = explode(":", $result2[0]);
	
	echo $result2[0];
	
	echo 'Sie haben ' .$time_von_sql[0].' Stunden, '.$time_von_sql[1].' Minuten, '.$time_von_sql[2].' Sekunden gearbeitet.';
	
	//return $result2[0];

	//$t = strtotime('$result2[0]');
    //echo date('H:i:s',$t);
	
	
	
			
		
		

		
		
		$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');
		
		$wert= $_POST["auswahl"];

    $abfrage = "SELECT max_gesamtstunden FROM benutzer where benutzerid=$wert";
 $row = $pdo->query($abfrage)->fetch();
$test = $row['max_gesamtstunden'];  

    echo $row['max_gesamtstunden'];
	
	
	


$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

	$bid= $_POST["auswahl"];
	$gesamt= $result2[0];
	$test = $row['max_gesamtstunden'];  

 
$statement = $pdo->prepare("insert into monatsabrechnung (benutzerid, geleistete_gesamtstunden, max_gesamtstunden) values (?,?,?)");
$statement->execute(array ($bid ,$gesamt,$test));



?>

