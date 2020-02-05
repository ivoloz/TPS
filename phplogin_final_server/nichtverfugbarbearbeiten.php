
	  
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
		
		include 'crud.php';
		
		$conn = OpenCon();
		
if($_GET['nichtverfugbarkeitid']) {
  $nichtverfugbarkeitid = $_GET['nichtverfugbarkeitid'];
}
//echo $nichtverfugbarkeitid;
		
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo' );

    $abfrage = "SELECT beginn,ende, bezeichnung,beschreibung FROM nichtverfugbarkeit where nichtverfugbarkeitid=$nichtverfugbarkeitid";
 $row = $pdo->query($abfrage)->fetch();
$test = $row['beginn']; 
$test2 = $row['ende']; 
$test3 = $row['bezeichnung']; 
$test4 = $row['beschreibung']; 


$date = date_create($test);
date_format($date, 'Y-m-d\TH:i');

$date2 = date_create($test2);
date_format($date2, 'Y-m-d\TH:i');

 
		
		?>
<div class="content">
<div class="formular">
<label><h1>Bitte Felder ausfüllen um Nicht-Verfügbarkeiten zu bearbeiten:</h1></label></br>
			<form action="nichtverfugbarkeitupdate.php" method="post" autocomplete="on">
	
<label for="nichtverfugbarkeitid"></label>
    <input type="hidden" value="<?php echo $nichtverfugbarkeitid; ?>" name="nichtverfugbarkeitid" /></br>	
		

<label for="beginn">Beginn: </label>
    <input type="datetime-local" value="<?php echo date_format($date, 'Y-m-d\TH:i'); ?>" name="beginn" /></br>
   
<label for="ende">Ende: </label>
 <input type="datetime-local" value="<?php echo date_format($date2, 'Y-m-d\TH:i'); ?>" name="ende" /></br>
   
<label for="bezeichnung" >Beschreibung:</label>
<input type="text" value="<?php echo $row['bezeichnung']; ?>" name="bezeichnung"	placeholder="bezeichnung" id="bezeichnung" required></br>

<label for="beschreibung" >Beschreibung:</label>
<input type="text" value="<?php echo $row['beschreibung']; ?>" name="beschreibung"	placeholder="Beschreibung" id="beschreibung" required></br>


<input type="submit" value="Aktualisieren">

</form>

<?php echo "<td><a href='nichtverfugbarlöschen.php?nichtverfugbarkeitid=".$nichtverfugbarkeitid."'><button> löschen</button></a></td></br>"; ?>

			<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>
</div>


</body>
</html>



<?php endif; ?>