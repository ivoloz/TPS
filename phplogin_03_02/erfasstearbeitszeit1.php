
	  
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
				<a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-clock"></i>Arbeitszeiten</a>
				<a href="nichtverfugbarkeitausgabe.php"><i class="fa fa-thumbs-down"></i>Nicht-Verf�gbarkeit</a>
				<a href="aufgabeausgabe.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meetingausgabe.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
			</div>
		</nav>
		
		<div class="content">
			<p>Bitte Felder ausf�llen um Arbeitszeit zu erfassen.</p>
		</div>
		
	
		<?php
		
				include 'crud.php';
		
		$conn = OpenCon();
		
	$benutzerid = $_SESSION["id"];
        echo $benutzerid;
		
		$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

    $abfrage = "SELECT kaz_von, kaz_bis FROM benutzer where benutzerid=$benutzerid";
 $row = $pdo->query($abfrage)->fetch();
$test = $row['kaz_von']; 
$test2 = $row['kaz_bis']; 
if (isset($test) && isset($test2)) {
    $date = date_create($test);
    echo $date_formatted1 = date_format($date, 'Y-m-d\TH:i');
    $time1 = substr($date_formatted1, 11, 5);
    echo $time1;

    $date2 = date_create($test2);
    echo $date_formatted2 = date_format($date2, 'Y-m-d\TH:i');
    $time2 = substr($date_formatted2, 11, 5);
    echo $time2;
}
?>
		

<div class="content">
<div class="formular">
<label></label></br>
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
			<button onclick="goBack()">Zur�ck</button>

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