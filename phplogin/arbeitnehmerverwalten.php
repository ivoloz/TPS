	  
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
		
	<div>
	<h1>Erfasste Arbeitnehmer:</h1>
	</div>
	
<table>
 <tr>
   <td> Benutzerid</td>
  <td> Arbeitgeberid</td>
 <td> Vorname</td> 
 <td> Nachname</td> 
   <td> Email</td>
     <td> Passwort</td>
	     <td> kaz_von</td>
		     <td> kaz_bis</td>
			     <td> max_gesamtstunden</td> 
    <td> max_ueberstunden</td>				 



 </tr>



	 
<?php


include 'crud.php';
$sql = "SELECT * FROM `benutzer` where rollenid=1";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['benutzerid']."</td>";
 echo "<td>" . $row['arbeitgeberid']."</td>";
 echo "<td>" . $row['vorname']."</td>";
 echo "<td>" . $row['nachname']. "</td>"; 
 echo "<td>" . $row['email']. "</td>"; 
  echo "<td>" . $row['passwort']."</td>";
  echo "<td>" . $row['kaz_von']."</td>";
    echo "<td>" . $row['kaz_bis']."</td>";
	  echo "<td>" . $row['max_gesamtstunden']."</td>";
 	  echo "<td>" . $row['max_ueberstunden']."</td>";


 echo "</tr>";
 }
 
 
}
else
{
 echo $result;
}

?>
 </table>
 <a href="arbeitnehmererstellen.html"><i class="fa fa-tasks"></i>Hinzufügen</a></br>
 
 	</body>
</html>
 
 <?php endif; ?>
