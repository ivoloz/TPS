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
		
   


<?php
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

		
$nichtverfugbarkeitid = $_POST["nichtverfugbarkeitid"];
echo $nichtverfugbarkeitid;

$beginn = $_POST["beginn"];
//str_replace("T", " ", $_POST["beginn"]).":00";
echo $beginn;

$ende = $_POST["ende"];
//str_replace("T", " ", $_POST["ende"]).":00";
echo $ende;

$bezeichnung = $_POST["bezeichnung"];
echo $bezeichnung;

$beschreibung = $_POST["beschreibung"];
echo $beschreibung;


$statement = $pdo->prepare("UPDATE nichtverfugbarkeit SET beginn=?, ende=? , bezeichnung=? , beschreibung=?
WHERE nichtverfugbarkeitid=?");
$statement->execute(array ($beginn ,$ende ,$bezeichnung, $beschreibung, $nichtverfugbarkeitid));

?>

	 </body>
       </html>
	   <br>


   <a href="nichtverfugbarkeitausgabe.php"><button>Nicht-Verfügbarkeiten ansehen.</button></a>
   
      		<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>

   
   
<?php endif; ?>