<?php


// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

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
				<a href="hier.php"><i class="fa fa-calendar"></i>Kalender</a>
				<a href="erfasstearbeitszeit.html"><i class="fa fa-user-circle"></i>Arbeitszeiten</a>
				<a href="nichtverfugbarkeit.php"><i class="fa fa-thumbs-down"></i>Nicht-Verfügbarkeit</a>
				<a href="einfachzuweisung.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meeting.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Ausloggen</a>
			</div>
		</nav>
		<div class="content">
			<p>Sie(<?=$_SESSION['name']?>) haben sich erfolgreich eingeloggt.</p>
			<a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-tasks"></i>Erfasstearbeitszeitausgabe</a></br>
		<a href="passwort.html"><i class="fa fa-tasks"></i>passwort</a></br>
		<a href="arbeitnehmererstellen.html"><i class="fa fa-tasks"></i>arbeitnehmererstellen</a></br>
				<a href="ereignisfreierstellen.html"><i class="fa fa-tasks"></i>ereignisfreierstellen</a></br>
			<a href="ereignisausgabe.php"><i class="fa fa-tasks"></i>ereignisausgabe</a></br>
		</div>
	</body>
</html>