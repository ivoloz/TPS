
	  
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
		
		<?php
		
		include 'crud.php';
		
		$conn = OpenCon();
		
if($_GET['arbeitszeitid']) {
  $arbeitszeitid = $_GET['arbeitszeitid'];
}
echo $arbeitszeitid;
		
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

    $abfrage = "SELECT beginn,ende,beschreibung FROM erfasstearbeitszeit where arbeitszeitid=$arbeitszeitid";
 $row = $pdo->query($abfrage)->fetch();
$test = $row['beginn']; 
$test2 = $row['ende']; 
$test3 = $row['beschreibung']; 
    echo $row['beginn'];
	  echo $row['ende'];
	   echo $row['beschreibung'];
		
		?>

<div class="formular">
<label>Bitte Felder ausfüllen um Zeiten einzutragen.</label></br>
			<form action="erfasstearbeitszeitupdate.php" method="post" autocomplete="on">
	
<label for="arbeitszeitid"></label>
    <input type="hidden" value="<?php echo $arbeitszeitid; ?>" name="arbeitszeitid" /></br>	
		

<label for="beginn">Beginn: </label>
    <input type="datetime-local" value="<?php echo $row['beginn']; ?>" name="beginn" /></br>
   
<label for="ende">Ende: </label>
 <input type="datetime-local" value="<?php echo $row['ende']; ?>" name="ende" /></br>
   

<label for="beschreibung" >Beschreibung:</label>
<input type="text" value="<?php echo $row['beschreibung']; ?>" name="beschreibung"	placeholder="Beschreibung" id="beschreibung" required></br>


<input type="submit" value="Aktualisieren">

</form>
</div>

			<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>

</body>
</html>



<?php endif; ?>