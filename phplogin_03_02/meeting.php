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
		
<div class="formular">
<label>Bitte Felder ausfÃ¼llen um Meeting zu erstellen.</label></br>
			<form action="meetingausfuhr.php" method="post" autocomplete="on">

<label for="beginn">Beginn: </label>
    <input type="datetime-local" value="datetime" name="beginn" /></br>
   
<label for="ende">Ende: </label>
 <input type="datetime-local" value="datetime" name="ende" /></br>
   

<label for="bezeichnung" >Bezeichnung:</label>
<input type="text" name="bezeichnung" value="123" placeholder="bezeichnung" id="bezeichnung" required></br>

<label for="beschreibung" >beschreibung:</label>
<input type="text" name="beschreibung"	placeholder="beschreibung" id="beschreibung" required></br>

	<label for="auswahl">Zuordnung</label>
  <select name="auswahl[]" size="3" multiple>
	
   		<?php
include 'crud.php';
$sql = "SELECT benutzerid ,email FROM `benutzer` where rollenid=1";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc()){
  
          echo "<option value=".$row['benutzerid']."> ".$row['email']."</option>";	}
		}
		
		?>
    </select></br>
	


<input type="submit" value="Meeting erstellen"></br>


</form>
</div>
	<button onclick="goBack()">Abbrechen</button>

<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>
 <?php endif; ?>