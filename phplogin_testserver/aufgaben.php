<?php


// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

?>

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
				<a href="arbeitszeiten.php"><i class="fa fa-user-circle"></i>Arbeitszeiten</a>
				<a href="nichtverfuegbar.php"><i class="fa fa-thumbs-down"></i>Nicht-Verfügbarkeit</a>
				<a href="aufgaben.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meetings.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Ausloggen</a>
			</div>
		</nav>


	  
	
<table>
 <tr>
  <td> Ereigniereignisid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
  <td> Bezeichnung</td>
  <td> Beschreibung</td>
   <td> Status</td>
 <td> Prioritaet</td>


 </tr>



	 
<?php

include 'crud.php';
$sql = "SELECT * FROM `ereignis`";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['ereignisid']."</td>";
 echo "<td>" . $row['beginn']. "</td>"; 
 echo "<td>" . $row['ende']. "</td>"; 
  echo "<td>" . $row['bezeichnung']."</td>";
     echo "<td>" . $row['beschreibung']."</td>";
	 	  echo "<td>" . $row['status']."</td>";
  echo "<td>" . $row['prioritaet']."</td>";
	 if ($row['status']==1) {
	echo "<td><a href='update2.php?ereignisid=".$row['ereignisid']."'>auswahl</a></td>";
	} else { 
	echo false;}	
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