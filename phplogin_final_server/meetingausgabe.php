﻿
	  
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
		
				
			<div class="content">
			<h1>Ihre zugewiesenen Meetings:</h1>
		</div>
	  
	  <div class="content">
<div class="content">
<table border="3">
 <tr>
    <td> Benutzerereignisid</td>
   <td> Benutzerid</td>
   <td> Bestätigt</td>
  <td> Meetingid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
   <td> Bezeichnung</td>
<td> Beschreibung</td>



 </tr>



	 
<?php

include 'crud.php';
$sql = "SELECT b.benutzerereignisid,b.benutzerid, b.bestatigt, n.meetingid, n.beginn, n.ende, n.bezeichnung, n.beschreibung 
FROM benutzerereignis as b
JOIN meeting as n on b.meetingid=n.meetingid
WHERE b.benutzerid =$benutzerid";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['benutzerereignisid']."</td>";
 echo "<td>" . $row['benutzerid']."</td>";
if ($row['bestatigt']==1){
	 echo "<td>offen</td>";
 }	 elseif ($row['bestatigt']==2){
	 echo "<td>abgelehnt</td>";
 }   elseif ($row['bestatigt']==3){
		  echo "<td>angenommen</td>";
	  }
 echo "<td>" . $row['meetingid']."</td>";
 echo "<td>" . $row['beginn']."</td>";
 echo "<td>" . $row['ende']. "</td>"; 
 echo "<td>" . $row['bezeichnung']. "</td>"; 
 echo "<td>" . $row['beschreibung']. "</td>"; 
 
  if ($row['bestatigt']==1) {
			 echo "<td><a href='meetingablehnen.php?benutzerereignisid=".$row['benutzerereignisid']."'><button>ablehnen</button></a></td>";
		 echo "<td><a href='meetingannehmen.php?benutzerereignisid=".$row['benutzerereignisid']."'><button>annehmen</button></a></td>";
	} 

  
	
 echo "</tr>";
 }
 
 
}
else
{
 echo "Noch keine Eintraege vorhanden.";
}

?>
 </table>
 </div>
 <div class="content">
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
			<h1>Alle erfassten Meetings:</h1>
		</div>
	<div class="content">
	<table border="3">
 <tr>
  <td> Meetingid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
   <td> Bezeichnung</td>
<td> Beschreibung</td>



 </tr>



	 
<?php



include 'crud.php';
$sql = "SELECT * FROM `meeting` ";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['meetingid']."</td>";
 echo "<td>" . $row['beginn']."</td>";
 echo "<td>" . $row['ende']. "</td>"; 
 echo "<td>" . $row['bezeichnung']. "</td>"; 
  echo "<td>" . $row['beschreibung']. "</td>"; 
  echo "<td><a href='meetinglöschen.php?meetingid=".$row['meetingid']."'><button> löschen</button></a></td>";
   echo "<td><a href='meetingbearbeiten.php?meetingid=".$row['meetingid']."'><button> bearbeiten</button></a></td>";
  
	
 echo "</tr>";
 }
 
 
}
else
{
 echo "Noch keine Eintraege vorhanden.";
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
			<form action="meetingzuweisung.php" method="post" autocomplete="on">
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
<div class="content">
<a href="meeting.php"><button>Meeting hinzufügen</button></a></br>

</body>
</html>
		<button onclick="goBack()">Zurück</button>

<script>
function goBack() {
  window.history.back();
}
</script>
</div>
</div>





<?php endif; ?>
