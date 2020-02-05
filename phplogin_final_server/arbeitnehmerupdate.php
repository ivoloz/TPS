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
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo' );

		
$benutzerid = $_POST["benutzerid"];
//echo $benutzerid;

$vorname = $_POST["vorname"];
//echo $vorname;

$nachname = $_POST["nachname"];
//echo $nachname;

$kaz_von = $_POST["kaz_von"];
//echo $kaz_von;

$kaz_bis = $_POST["kaz_bis"];
//echo $kaz_bis;

$max_gesamtstunden = $_POST["max_gesamtstunden"];
//echo $max_gesamtstunden;

$max_ueberstunden = $_POST["max_ueberstunden"];
//echo $max_ueberstunden;


$statement = $pdo->prepare("UPDATE benutzer SET vorname=?, nachname=? ,kaz_von=?,kaz_bis=?,max_gesamtstunden=?,max_ueberstunden=?
WHERE benutzerid=?");
$statement->execute(array ($vorname ,$nachname ,$kaz_von, $kaz_bis,$max_gesamtstunden.":00:00",$max_ueberstunden.":00:00", $benutzerid));

?>

	 </body>
       </html>
	   <br>
	   <p> Sie haben erfolgreich einen Arbeitnehmer bearbeitet.</p>

<div class="content">
   <a href="arbeitnehmerverwalten.php"><button>Weitere Arbeitnehmer verwalten.</button></a>
   
      		<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>

   
   
<?php endif; ?>