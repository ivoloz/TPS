	<?php 
	
	// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}


$benutzerid = $_SESSION["id"];

	
$rollenid = $_SESSION["rollenid"];


?>
	<?php if ($rollenid == 1): ?>

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
				<a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-user-circle"></i>Arbeitszeiten</a>
				<a href="nichtverfugbarkeitausgabe.php"><i class="fa fa-thumbs-down"></i>Nicht-Verfügbarkeit</a>
				<a href="aufgabeausgabe.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meetingausgabe.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
			</div>
		</nav>
<div class="content">
		
			<div>
		
				<a href="passwort.html"><button><i class="fa fa-user-circle"></i>Passwort ändern</button></a>

			</div>
		</div>
		<div class="content">
		
			<div>
		
				<a href="logout.php"><button><i class="fa fa-user-circle"></i>Abmelden</button></a>

			</div>
		</div>
	</body>
</html>

 <?php endif; ?>
 
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
				<a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-user-circle"></i>Arbeitszeiten</a>
				<a href="nichtverfugbarkeitausgabe.php"><i class="fa fa-thumbs-down"></i>Nicht-Verfügbarkeit</a>
				<a href="aufgabeausgabe.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meetingausgabe.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
			</div>
		</nav>
<div class="content">
		
			<div>
				<a href="abrechnungausgabe.php"><button><i class="fa fa-home fa-fw"></i>Monatsabrechnung</button></a>
			
	
			</div>
		</div>
		<div class="content">
		
			<div>
				<a href="arbeitnehmerverwalten.php"><button><i class="fa fa-home fa-fw"></i>Arbeitnehmer verwalten</button></a>
			
	
			</div>
		</div>
		<div class="content">
		
			<div>
				<a href="passwort.html"><button><i class="fa fa-home fa-fw"></i>Passwort ändern</button></a>
			
	
			</div>
		</div>
		<div class="content">
		
			<div>
				<a href="logout.php"><button><i class="fa fa-home fa-fw"></i>Abmelden</button></a>
			
	
			</div>
		</div>
	</body>
</html>



 <?php endif; ?>
 
 