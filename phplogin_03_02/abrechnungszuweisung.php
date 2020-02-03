	  
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
	
<table>
 <tr>
  <td> Monatsabrechnungid</td>
 <td> Benutzerid</td> 
 <td> Geleistete_Gesamtstunden</td> 
   <td> Max_Gesamtstunden</td>




 </tr>




	 
<?php

$auswahl = $_POST["auswahl"];


	  
include 'crud.php';
$sql = "SELECT * FROM `monatsabrechnung` where benutzerid=$auswahl ";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['monatsabrechnungid']."</td>";
 echo "<td>" . $row['benutzerid']."</td>";
 echo "<td>" . $row['geleistete_gesamtstunden']. "</td>"; 
 echo "<td>" . $row['max_gesamtstunden']. "</td>"; 


  
	
 echo "</tr>";
 }
 
 
}
else
{
 echo $result;
}
?>
 </table>
  </body>
   </html>
   



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formular</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>
<body>

<div class="formular">
	<label>Bitte einen Mitarbeiter auswählen.</label></br>
			<form action="abrechnungszuweisung.php" method="post" autocomplete="on">
		<label for="auswahl">Zuordnung</label>
    <select name="auswahl" size="1">
	
   		<?php

$sql = "SELECT benutzerid ,email FROM `benutzer` where rollenid=1";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc()){
  
          echo "<option value=".$row['benutzerid']."> ".$row['email']."</option>";	}
		}
		
		?>
    </select></br>
	
<input type="submit" value="Mitarbeiter auswählen"></br>

</form>

<a href="abrechnung.php"><button>Neue Monatsabrechnung hinzufügen.</button></a></br>

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