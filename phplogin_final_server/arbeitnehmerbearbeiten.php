
	  
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
		
		<?php
		
		include 'crud.php';
		
		$conn = OpenCon();
		
if($_GET['benutzerid']) {
  $benutzerid = $_GET['benutzerid'];
}
//echo $benutzerid;
		
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo' );

    $abfrage = "SELECT vorname,nachname,kaz_von,kaz_bis,max_gesamtstunden,max_ueberstunden FROM benutzer where benutzerid=$benutzerid";
 $row = $pdo->query($abfrage)->fetch();
$test = $row['vorname']; 
$test2 = $row['nachname']; 
$test3 = $row['kaz_von']; 
$test4 = $row['kaz_bis']; 
$test5 = $row['max_gesamtstunden']; 
$test6 = $row['max_ueberstunden']; 


$date = date_create($test3);
date_format($date, 'Y-m-d\TH:i');

$date2 = date_create($test4);
date_format($date2, 'Y-m-d\TH:i');


$gesamtstunden = explode(":", $test5);
# $date3 = date_create($test5);
# echo date_format($date3, 'hh:i');

$ueberstunden = explode(":", $test6);
# $date4 = date_create($test6);
# echo date_format($date4, 'Y-m-d\TH:i');


//echo "<br><br>".$test5."<br><br>";
 
		
		?>
	<div class="content">
<div class="formular">
<label><h1>Bitte Felder ausfüllen um Arbeitnehmer zu bearbeiten:</h1></label></br>
			<form action="arbeitnehmerupdate.php" method="post" autocomplete="on">
	
<label for="benutzerid"></label>
    <input type="hidden" value="<?php echo $benutzerid; ?>" name="benutzerid" /></br>	
		
		<label for="vorname">vorname: </label>
    <input type="text" value="<?php echo $row['vorname'];?>" name="vorname" /></br>
	
			<label for="nachname">nachname: </label>
    <input type="text" value="<?php echo $row['nachname'];?>" name="nachname" /></br>
	
	<label for="kaz_von">kaz_von: </label>
    <input type="time" value="<?php echo date_format($date, 'H:i'); ?>" name="kaz_von" /></br>
	
	<label for="kaz_bis">kaz_bis: </label>
    <input type="time" value="<?php echo date_format($date2, 'H:i'); ?>" name="kaz_bis" /></br>
	
		<label for="max_gesamtstunden">max_gesamtstunden: </label>
    <input type="text" value="<?php echo $gesamtstunden[0]; ?>" name="max_gesamtstunden" /></br>
	
		<label for="max_ueberstunden">max_ueberstunden: </label>
    <input type="text" value="<?php echo $ueberstunden[0]; ?>" name="max_ueberstunden" /></br>



<input type="submit" value="Aktualisieren">

</form>

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