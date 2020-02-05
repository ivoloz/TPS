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
		
			<div class="content">
			<h1>Alle erfassten Nicht-Verfügbarkeiten:</h1>
		</div>
	<div class="content">
<table border="3">
 <tr>
  <td> benutzerereignisid</td>
    <td> benutzerid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
   <td> Bezeichnung</td>
<td> Beschreibung</td>



 </tr>



	 
<?php

$auswahl = $_POST["auswahl"];


	  


include 'crud.php';
$sql = "SELECT b.benutzerereignisid, b.benutzerid, n.beginn, n.ende, n.bezeichnung, n.beschreibung
FROM benutzerereignis as b
JOIN nichtverfugbarkeit as n on b.nichtverfugbarkeitid=n.nichtverfugbarkeitid
WHERE b.benutzerid =$auswahl ";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['benutzerereignisid']."</td>";
 echo "<td>" . $row['benutzerid']."</td>";
 echo "<td>" . $row['beginn']."</td>";
 echo "<td>" . $row['ende']. "</td>"; 
 echo "<td>" . $row['bezeichnung']. "</td>"; 
  echo "<td>" . $row['beschreibung']. "</td>"; 

  
	
 echo "</tr>";
 }
 
 
}
else
{
 echo $result;
}

?>
 </table>
 </div>
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
<div class="content">
<div class="formular">
	<label><h1>Bitte einen Mitarbeiter auswählen:</h1></label></br>
			<form action="nichtverfugbarkeitzuweisung.php" method="post" autocomplete="on">
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