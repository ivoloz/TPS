
	  
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


$arbeitszeitid = $_SESSION["id"];
	
	
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



$arbeitszeitid = $_GET["arbeitszeitid"];


$statement = $pdo->prepare("DELETE FROM erfasstearbeitszeit WHERE  arbeitszeitid = ?  ");
$statement->execute(array($arbeitszeitid));
?>

	 </body>
       </html>
	   <br>
	   <p> Sie haben erfolgreich eine Arbeitszeit entfernt.</p>

<div class="content">

   <a href="erfasstearbeitszeitausgabe.php"><button>Weitere Arbeitszeiten verwalten.</button></a>
   
      		<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>

<?php endif; ?>