

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



<div class="formular">
<label>Bitte Felder ausfüllen um Aufgabe einem Mitarbeiter zuzuweisen.</label></br>
			<form action="einfachzuweisungausfuhr.php" method="post" autocomplete="on">

<label for="beginn">Beginn: </label>
    <input type="datetime-local" value="datetime" name="beginn" /></br>
   
<label for="ende">Ende: </label>
 <input type="datetime-local" value="datetime" name="ende" /></br>
   
   				<label for="bezeichnung">Bezeichnung:</label>
<input type="text" name="bezeichnung" placeholder="Bezeichnung" id="bezeichnung" required></br>

<label for="beschreibung" >Beschreibung:</label>
<input type="text" name="beschreibung"	placeholder="Beschreibung" id="beschreibung" required></br>

<label for="prioritaet" >Priorität:</label>
    <select name="prioritaet" size="1">
	    <option>Bitte auswählen</option>
        <option>1</option>
        <option>2</option>
		<option>3</option>
    </select></br>

		
	<label for="auswahl">Zuordnung</label>
    <select name="auswahl" size="1">
	
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
	
	
	<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>

<input type="submit" value="Aufgabe zuweisen"></br>

</form>
</div>
</body>
</html>

   <?php endif; ?>