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
	<label>Bitte einen Mitarbeiter auswählen.</label></br>
			<form action="erfasstearbeitszeitausfuhrauswahl_direkt_in_sql.php" method="post" autocomplete="on">
			

<label for="monat">Monat</label>
 <select name="monat" size="1">
 <option value="01">Januar</option>
  <option value="02">Februar</option>
   <option value="03">März</option>
    <option value="04">April</option>
	 <option value="05">Mai</option>
	  <option value="06">Juni</option>
	   <option value="07">Juli</option>
	    <option value="08">August</option>
		 <option value="09">September</option>
		  <option value="10">Oktober</option>
		   <option value="11">November</option>
		    <option value="12">Dezember</option>
  </select>
  
  <label for="jahr">Jahr</label>
 <select name="jahr" size="1">
 <option value="2019">2019</option>
  <option value="2020">2020</option>
   <option value="2021">2021</option>
    <option value="2022">2022</option>
	 <option value="2023">2023</option>
	  <option value="2024">2024</option>
	   <option value="2025">2025</option>
	    <option value="2026">2026</option>
  </select><br>

			
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



<input type="submit" value="Mitarbeiter auswählen"></br>


	
</form>
</div>
</body>
</html>

<?php endif; ?>