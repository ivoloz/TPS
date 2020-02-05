
	  
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
		
					<?php $pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo' );
		
$benutzerid = $_SESSION["id"];


    $abfrage = "SELECT kaz_von,kaz_bis, max_gesamtstunden, max_ueberstunden FROM benutzer where benutzerid=$benutzerid ";
 $row = $pdo->query($abfrage)->fetch();
 $test = $row['kaz_von'];
  $test2 = $row['kaz_bis'];
   $test3 = $row['max_gesamtstunden'];
    $test4 = $row['max_ueberstunden'];
	
	
	$date = date_create($test);
date_format($date, 'H:i');

	$date2 = date_create($test2);
date_format($date2, 'H:i');

	$gesamtstunden = explode(":", $test3);
	//echo $gesamtstunden[0];
	
		$ueberstunden = explode(":", $test4);
	//echo $ueberstunden[0];
 
 ?>
 
 <div class="content">
 
 <p>Ihre Kernarbeitszeit verläuft von <?php echo date_format($date, 'H:i'); ?>  Uhr bis <?php echo date_format($date2, 'H:i'); ?> Uhr.<br>
 Ihre Maximalen Gesamstunden belaufen sich pro Monat auf <?php echo $gesamtstunden[0]; ?> Stunden.<br>
 Ihre Maximalen Überstunden belaufen sich pro Monat auf <?php echo $ueberstunden[0]; ?> Stunden.
 </p>
			</div>
		
	
		<?php
		
				include 'crud.php';
		
		$conn = OpenCon();
		
	$benutzerid = $_SESSION["id"];
      
		
		$pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo' );

    $abfrage = "SELECT kaz_von, kaz_bis FROM benutzer where benutzerid=$benutzerid";
 $row = $pdo->query($abfrage)->fetch();
$test = $row['kaz_von']; 
$test2 = $row['kaz_bis']; 

$date = date_create($test);
$date_formatted1 = date_format($date, 'Y-m-d\TH:i');
$time1 = substr($date_formatted1,11,5);


$date2 = date_create($test2);
$date_formatted2 = date_format($date2, 'Y-m-d\TH:i');
$time2 = substr($date_formatted2,11,5);


?>
		

<div class="content">
<div class="formular">
<label><h1>Bitte Felder ausfüllen um Arbeitszeit zu erfassen:</h1></label></br>
			<form action="erfasstearbeitszeitausfuhr.php" method="post" autocomplete="on">

<label for="beginn">Beginn:</label><br>
    <!-- <input type="datetime-local" min="<?php echo date_format($date, 'Y-m-d\TH:i'); ?>" max="<?php echo date_format($date2, 'Y-m-d\TH:i'); ?>" value="datetime" name="beginn" /></br> -->
	<input type="date" value="date" name="beginndatum" />
	<input type="time" min="<?php echo $time1; ?>" max="<?php echo $time2; ?>" value="time" name="beginnzeit" /></br>
   
<label for="ende">Ende: </label><br>
 <!-- <input type="datetime-local" min="<?php echo date_format($date, 'Y-m-d\TH:i'); ?>" max="<?php echo date_format($date2, 'Y-m-d\TH:i'); ?>" value="datetime" name="ende" /> -->
 <input type="date" value="date" name="endedatum" />
 <input type="time" min="<?php echo $time1; ?>" max="<?php echo $time2; ?>" value="time" name="endezeit" /></br>
 </br>
   

<label for="beschreibung" >Beschreibung:</label>
<input type="text" name="beschreibung"	placeholder="Beschreibung" id="beschreibung" required></br>


<input type="submit" value="Arbeitszeit erfassen">

</form>
			<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>
</div>

		</div>


</body>
</html>



<?php endif; ?>