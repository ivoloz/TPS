<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
$email = $_SESSION['name'];
$datum = date("d.m.Y");
$uhrzeit = date("H:i");


file_put_contents('./logfile.log', "$datum $uhrzeit Anmeldung $email "."\n", FILE_APPEND);



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
			
			$pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo' );
		
$benutzerid = $_SESSION["id"];


    $abfrage = "SELECT TIME((geleistete_gesamtstunden - max_gesamtstunden)) as stunden FROM monatsabrechnung where benutzerid=$benutzerid and abgerechnet=2 ORDER BY monatsabrechnungid DESC limit 1";
 $row = $pdo->query($abfrage)->fetch();
 $test3 = $row['stunden'];
 //$test = $row['geleistete_gesamtstunden'];  
  // $test2 = $row['max_gesamtstunden'];  
    //echo $row['geleistete_gesamtstunden'];
    //echo $row['max_gesamtstunden'];


	
    $abfrage2 = "SELECT max_ueberstunden FROM benutzer where benutzerid=$benutzerid";
 $row = $pdo->query($abfrage2)->fetch();
 $test4 = $row['max_ueberstunden'];
 
     $abfrage3= "SELECT erfassungsmonat FROM monatsabrechnung where benutzerid=$benutzerid and abgerechnet=2  ORDER BY monatsabrechnungid DESC  limit 1";
 $row = $pdo->query($abfrage3)->fetch();
 $test5 = $row['erfassungsmonat'];
 $richtig= $test5/10000;
 settype($richtig, "integer");

switch ($richtig) {
    case 1:
       $monat= "Januar";
        break;
    case 2:
        $monat= "Februar";
        break;
    case 3:
        $monat= "März";
        break;
    case 4:
        $monat= "April";
        break;
    case 5:
        $monat= "Mai";
        break;
    case 6:
       $monat= "Juni";
        break;
    case 7:
        $monat= "Juli";
        break;
    case 8:
       $monat= "August";
        break;
    case 9:
        $monat= "September";
        break;
    case 10:
        $monat= "Oktober";
        break;
    case 11:
        $monat= "November";
        break;
		    case 12:
        $monat= "Dezember";
        break;
		
}


	$jahr= $test5 % 10000;
	


 
      $abfrage4= "SELECT geleistete_gesamtstunden FROM monatsabrechnung where benutzerid=$benutzerid and abgerechnet=2 ORDER BY monatsabrechnungid DESC limit 1";
 $row = $pdo->query($abfrage4)->fetch();
 $test6 = $row['geleistete_gesamtstunden'];
 
    $abfrage5= "SELECT max_gesamtstunden FROM monatsabrechnung where benutzerid=$benutzerid";
 $row = $pdo->query($abfrage5)->fetch();
 $test7 = $row['max_gesamtstunden'];

 
		$time_von_sql = explode(":", $test6);
	
	//echo $test3;
	
	if (!isset($test3)) {
		echo "Noch keine Monatsabrechnung vorhanden.<br/>";
	}
	else{
	echo 'Im '.$monat.' '.$jahr.' haben Sie ' .$time_von_sql[0].' Stunden, '.$time_von_sql[1].' Minuten, '.$time_von_sql[2].' Sekunden gearbeitet.<br/>';
	
	
	if($test6< $test7){
		echo 'Sie haben im '.$monat.' '.$jahr.' ihre maximalen Gesamtstunden nicht erreicht!<br/> ';
	}
	else {
		echo 'Sie haben im '.$monat.' '.$jahr.' ihre maximalen Gesamtstunden erreicht.<br/>';
	}
	
if ($test3 < $test4 ){

echo "Hinweis: Ihre Arbeitszeit liegt noch im Rahmen.<br/>"; 
}
else{
	

	echo "Warnung: Sie haben ihre maximalen Überstunden überschritten.<br/>"; 
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