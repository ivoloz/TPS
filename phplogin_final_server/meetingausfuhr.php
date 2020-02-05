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
//CRUD in PHP and MySQL With Prepared Statements
require_once 'meetingeingabe.php';


$beginn = $_POST["beginn"];
$ende = $_POST["ende"];

$bezeichnung = $_POST["bezeichnung"];
$beschreibung = $_POST["beschreibung"];
$auswahl = $_POST["auswahl"];




	$result = PreQuery( $beginn, $ende, $bezeichnung , $beschreibung,$auswahl);
	$meetingidangelegt = PreQuery2($beginn, $ende, $bezeichnung , $beschreibung,$auswahl);
	//$tmp2 = PreQuery3($auswahl, $meetingidangelegt);
	
	
	//3 Zuordnungen in Zuordnungstabelle anlegen
	foreach($auswahl as $current_auswahl) {
		//echo "current_auswahl: ".$current_auswahl."<br>";
		$result2 = PreQuery3($current_auswahl, $meetingidangelegt);
	}


//echo "Aufgabe einfuegen: ";
if($result === true)
{
	echo 'Sie haben erfolgreich ein Meeting erstellt.';
	
}
else
{
	echo $result;
}

//echo "<br>";
//echo "Meetingid angelegt: ".$meetingidangelegt;

//echo "<br>";
//echo "Zuordnung:";
if($result2 === true)
{
	echo '';
	
}
else
{
	echo $result;
}

?>
<br>
<div class="content">
<a href="meetingausgabe.php"><button>Meetings ansehen</button></a><br>

		<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script> 

<?php endif; ?>