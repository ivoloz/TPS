	  
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
		<title>�bersichtsseite</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">

				<nav class="navtop">
			<div>
				<!-- <h1>Zeitapp</h1> -->
				<a href="home.php"><i class="fa fa-home fa-fw"></i>�bersicht</a>
				<a href="kalender.php"><i class="fa fa-calendar"></i>Kalender</a>
				<a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-user-circle"></i>Arbeitszeiten</a>
				<a href="nichtverfugbarkeitausgabe.php"><i class="fa fa-thumbs-down"></i>Nicht-Verf�gbarkeit</a>
				<a href="aufgabeausgabe.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meetingausgabe.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
			</div>
		</nav>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


$benutzerid = $_SESSION["id"];
	//echo $benutzerid;

if($_GET['benutzerereignisid']) {
  $benutzerereignisid = $_GET['benutzerereignisid'];
}

$bestatigt=3;

//echo $bestatigt;

 
$statement = $pdo->prepare("UPDATE benutzerereignis SET bestatigt=$bestatigt WHERE benutzerereignisid = $benutzerereignisid and benutzerid=$benutzerid");
$statement->execute(array ($bestatigt ,$benutzerereignisid));


?>


</body>
</html>

<p>Sie haben erfolgreich ein Meeting best�tigt.</p>
<a href="meetingausgabe.php"><button>Weitere Meetings</button></a>

	<button onclick="goBack()">Zur�ck</button>

<script>
function goBack() {
  window.history.back();
}
</script>



<?php endif; ?>