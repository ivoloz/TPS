
	  
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
	
<table>
 <tr>
    <td> Benutzerid</td>
	 <td> Nichtverfugbarkeitid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
   <td> Bezeichnung</td>
<td> Beschreibung</td>



 </tr>



	 
<?php


include 'crud.php';
$sql = "SELECT b.benutzerid, n.nichtverfugbarkeitid, n.beginn, n.ende, n.bezeichnung, n.beschreibung
FROM benutzerereignis as b
JOIN nichtverfugbarkeit as n on b.nichtverfugbarkeitid=n.nichtverfugbarkeitid
WHERE b.benutzerid =$benutzerid ";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['benutzerid']."</td>";
  echo "<td>" . $row['nichtverfugbarkeitid']."</td>";
 echo "<td>" . $row['beginn']."</td>";
 echo "<td>" . $row['ende']. "</td>"; 
 echo "<td>" . $row['bezeichnung']. "</td>"; 
  echo "<td>" . $row['beschreibung']. "</td>"; 
  echo "<td><a href='nichtverfugbarlöschen.php?nichtverfugbarkeitid=".$row['nichtverfugbarkeitid']."'><button>Löschen</button></a></td>";
 echo "<td><a href='nichtverfugbarbearbeiten.php?nichtverfugbarkeitid=".$row['nichtverfugbarkeitid']."'><button>bearbeiten</button></a></td>";
  
	
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
<a href="nichtverfugbarkeit.php"><button>Nicht-Verfügbarkeit hinzufügen</button></a>

<?php endif; ?>



	  
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
  <td> Nichtverfugbarkeitid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
   <td> Bezeichnung</td>
<td> Beschreibung</td>



 </tr>



	 
<?php



include 'crud.php';
$sql = "SELECT * FROM `nichtverfugbarkeit` ";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['nichtverfugbarkeitid']."</td>";
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


