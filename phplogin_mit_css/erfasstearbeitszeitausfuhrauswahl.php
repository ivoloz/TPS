	<?php 
	
	// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

// If the user logs in first time or has not changed his password redirect to the password page...
if (!isset($_SESSION['abfrage'])) {
	header('Location: passwort.html');
	exit();
}


$benutzerid = $_SESSION["id"];
	
	
$rollenid = $_SESSION["rollenid"];


?>
<?php if ($rollenid == 2): ?>
	
		<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Übersichtsseite</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">

				<nav class="navtop">
			<div>
				<!-- <h1>Zeitapp</h1> -->
				<a href="home.php"><i class="fa fa-home fa-fw"></i>Übersicht</a>
				<a href="kalender.php"><i class="fa fa-calendar"></i>Kalender</a>
				<a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-clock"></i>Arbeitszeiten</a>
				<a href="nichtverfugbarkeitausgabe.php"><i class="fa fa-thumbs-down"></i>Nicht-Verfügbarkeit</a>
				<a href="aufgabeausgabe.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meetingausgabe.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
			</div>
		</nav>



<?php
$auswahl = $_POST["auswahl"];
$beginn = $_POST["beginn"];
$ende = $_POST["ende"];

echo $auswahl;
echo $beginn;
echo $ende;





require_once 'crud.php';

$conn = OpenCon();

//SQL: TIME(ZAHL) -> Formatieren als Stunden
//SQL: Summe auf DB: SELECT TIME(SUM(ende-beginn)) AS zeit FROM `erfasstearbeitszeit` where benutzerid=4
//In PHP $time_von_sql = explode(":", result2[0]) ==> $time_von_sql[0] Stunden, $time_von_sql[1] Minuten, $time_von_sql[2] Sekunden

$query = 'SELECT TIME(ende-beginn) AS zeit FROM `erfasstearbeitszeit` where benutzerid="'.$auswahl.'" and beginn="'.$beginn.'" ;';
	$time_von_sql = array();
	$time_von_sql[0] = 0; //h
	$time_von_sql[1] = 0; //m
	$time_von_sql[2] = 0; //s
	
	
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	
	while($row = $result->fetch_assoc()){
		$current_time_von_sql = explode(":", $row['zeit']);
		
		//aufsummieren
		$time_von_sql[0] = $time_von_sql[0] +  $current_time_von_sql[0];
		$time_von_sql[1] = $time_von_sql[1] +  $current_time_von_sql[1];
		$time_von_sql[2] = $time_von_sql[2] +  $current_time_von_sql[2];
	}
	
	echo 'Sie haben ' .$time_von_sql[0].' Stunden, '.$time_von_sql[1].' Minuten, '.$time_von_sql[2].' Sekunden gearbeitet.';
	
	return $time_von_sql;

?>

</body>
</html>

<?php endif; ?>
