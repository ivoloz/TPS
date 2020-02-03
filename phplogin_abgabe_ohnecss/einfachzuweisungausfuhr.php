
	  
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
//CRUD in PHP and MySQL With Prepared Statements
require_once 'einfachzuweisungeingabe.php';



$beginn = $_POST["beginn"];
$ende = $_POST["ende"];
$bezeichnung = $_POST["bezeichnung"];
$beschreibung = $_POST["beschreibung"];
$status = 2;
$prioritaet = $_POST["prioritaet"];
$auswahl = $_POST["auswahl"];

	$result = PreQuery( $beginn, $ende, $bezeichnung , $beschreibung, $status,$prioritaet,$auswahl);
	$aufgabeidangelegt = PreQuery2($beginn, $ende, $bezeichnung , $beschreibung, $status,$prioritaet,$auswahl);
	$tmp2 = PreQuery3($auswahl, $aufgabeidangelegt);


echo "Aufgabe einfuegen: ";
if($result === true)
{
	echo 'Sie haben erfolgreich eine Aufgabe zugewiesen.';
	
}
else
{
	echo $result;
}

//echo "<br>";
//echo "Aufgabeid angelegt: ".$aufgabeidangelegt;

//echo "<br>";
//echo "Zuordnung:";
if($tmp2 === true)
{
	echo '';
	
}
else
{
	echo $result;
}


?>

</body>
</html>
<br>
<a href="einfachzuweisung.php"><button>Weitere Aufgabe zuweisen.</button></a>

	<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>

