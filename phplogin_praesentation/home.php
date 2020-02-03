<?php

file_put_contents('./logfile.log', "wasimFileSteht", FILE_APPEND);

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
		<div class="content">
			<p>Sie(<?=$_SESSION['name']?>) haben sich erfolgreich eingeloggt.</p>
		</div>
		
			<?php if ($rollenid == 1): ?>
		
				<div class="content">
		<p>
			<?php	
			
include 'crud.php';

$conn = OpenCon();
			
			$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');
		
$benutzerid = $_SESSION["id"];


    $abfrage = "SELECT TIME((geleistete_gesamtstunden - max_gesamtstunden)) as stunden FROM monatsabrechnung where benutzerid=$benutzerid limit 1";
 $row = $pdo->query($abfrage)->fetch();
 $test3 = $row['stunden'];
 //$test = $row['geleistete_gesamtstunden'];  
  // $test2 = $row['max_gesamtstunden'];  
    //echo $row['geleistete_gesamtstunden'];
    //echo $row['max_gesamtstunden'];

	
		$time_von_sql = explode(":", $test3);
	
	//echo $test3;
	
	//echo 'Sie haben ' .$time_von_sql[0].' Stunden, '.$time_von_sql[1].' Minuten, '.$time_von_sql[2].' Sekunden gearbeitet.';



if ($test3 < 0){
echo "Hinweis:Sie haben zu wenig gearbeitet."; 
}
else{
	if($test3 > 80) {
		echo "Warnung: Sie haben zu viel gearbeitet."; 
	}
	else {
		echo "Hinweis: Ihre Arbeitszeit liegt noch im Rahmen.";
	}
	
}


	?>
	</p>
		</div>
		
				<div class="content">
			
			<p><a href="freieaufgabeausgabe.php">Verfügbare Aufgaben</a><br>
			<a href="aufgabeausgabe.php">Zugewiesene Aufgaben</a><br>
			<a href="meetingausgabe.php">Einladung für Meeting erhalten</a><br></p>
			
		</div>
		
			<?php endif; ?>
	</body>
</html>