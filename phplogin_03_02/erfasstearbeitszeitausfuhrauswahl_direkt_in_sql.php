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

<div class="content">
<?php
$auswahl = $_POST["auswahl"];
$monat = $_POST["monat"];
$jahr = $_POST["jahr"];
$erfassungsmonat= $monat.$jahr;
echo $erfassungsmonat;

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

	//echo $result2[0];
	
	if(sizeof($time_von_sql)>1) {
		echo '' .$benutzerid.' hat ' .$time_von_sql[0].' Stunden, '.$time_von_sql[1].' Minuten, '.$time_von_sql[2].' Sekunden gearbeitet.';
	}
	else {
		echo "Kein Daten";
	}
	//return $result2[0];

	//$t = strtotime('$result2[0]');
    //echo date('H:i:s',$t);


	
			
		
		

		
	//max_gesamtstunden von benutzer holen und in monatsabrechnung einfügen für den jeweiligen Arbeitnehmer
		$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');
		
		$wert= $_POST["auswahl"];

    $abfrage = "SELECT max_gesamtstunden FROM benutzer where benutzerid=$wert";
 $row = $pdo->query($abfrage)->fetch();
$test = $row['max_gesamtstunden'];  

  

$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

	$bid= $_POST["auswahl"];
	$gesamt= $result2[0];
	$test = $row['max_gesamtstunden']; 
    $abgerechnet=1;	

 
$statement = $pdo->prepare("insert into monatsabrechnung (benutzerid,erfassungsmonat, geleistete_gesamtstunden, max_gesamtstunden,abgerechnet) values (?,?,?,?,?)");
$statement->execute(array ($bid ,$erfassungsmonat,$gesamt,$test,$abgerechnet));
 



?>
</div>

	 </body>
       </html>
	   <br>
	   <p> Sie haben erfolgreich eine Monatsabrechnung erstellt.</p>


   <a href="abrechnungausgabe.php"><button>Weitere Monatsabrechnungunen verwalten.</button></a>
   
      		<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>

   
   
<?php endif; ?>
