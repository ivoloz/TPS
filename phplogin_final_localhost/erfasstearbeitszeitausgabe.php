	  
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
			
			
				<?php $pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');
		
$benutzerid = $_SESSION["id"];


    $abfrage = "SELECT kaz_von,kaz_bis, max_gesamtstunden, max_ueberstunden FROM benutzer where benutzerid=$benutzerid ";
 $row = $pdo->query($abfrage)->fetch();
 $test = $row['kaz_von'];
  $test2 = $row['kaz_bis'];
   $test3 = $row['max_gesamtstunden'];
    $test4 = $row['max_ueberstunden'];
	
	
	$date = date_create($test);
date_format($date, 'H:i');

	$date2 = date_create($test2);
date_format($date2, 'H:i');

	$gesamtstunden = explode(":", $test3);
	//echo $gesamtstunden[0];
	
		$ueberstunden = explode(":", $test4);
	//echo $ueberstunden[0];
 
 ?>
 
 <div class="content">
 
 <p>Ihre Kernarbeitszeit verläuft von <?php echo date_format($date, 'H:i'); ?>  Uhr bis <?php echo date_format($date2, 'H:i'); ?> Uhr.<br>
 Ihre Maximalen Gesamstunden belaufen sich pro Monat auf <?php echo $gesamtstunden[0]; ?> Stunden.<br>
 Ihre Maximalen Überstunden belaufen sich pro Monat auf <?php echo $ueberstunden[0]; ?> Stunden.
 </p>
			</div>
		
		
		<div class="content">
			<h1>Ihre erfassten Arbeitszeiten:</h1>
		</div>
	
		

<div class="content">

<table border="3">
 <tr>
   <td> Arbeitszeitid</td>
  <td> Benutzerid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
 <td> Saldo</td> 
   <td> Beschreibung</td>



 </tr>


	 
<?php




include 'crud.php';
$sql = "SELECT arbeitszeitid, benutzerid, beginn, ende, time(ende-beginn) as zeit, beschreibung FROM `erfasstearbeitszeit` where benutzerid=$benutzerid";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['arbeitszeitid']."</td>";
 echo "<td>" . $row['benutzerid']."</td>";
 echo "<td>" . $row['beginn']. "</td>"; 
 echo "<td>" . $row['ende']. "</td>"; 
echo "<td>" . $row['zeit']. "</td>";
  echo "<td>" . $row['beschreibung']."</td>";
     echo "<td><a href='zeitenlöschen.php?arbeitszeitid=".$row['arbeitszeitid']."'><button> löschen</button></a></td>";
   echo "<td><a href='zeitenbearbeiten.php?arbeitszeitid=".$row['arbeitszeitid']."'><button> bearbeiten</button></a></td>";

 


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
  <div class="content">
  <p>
  <a href="erfasstearbeitszeit1.php"><button>Neue Arbeitszeit erfassen</button></a></br>
  </p>
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
			<h1>Alle erfassten Arbeitszeiten:</h1>
		</div>
		
		<div class="content">
	
<table border="3">
 <tr>
  <td> Arbeitszeitid</td>
    <td> Benutzerid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
  <td> Saldo</td> 
<td> Beschreibung</td>



 </tr>



	 
<?php


include 'crud.php';
$sql = "SELECT arbeitszeitid, benutzerid, beginn, ende, time(ende-beginn) as zeit, beschreibung FROM `erfasstearbeitszeit`";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['arbeitszeitid']."</td>";
 echo "<td>" . $row['benutzerid']."</td>";
 echo "<td>" . $row['beginn']. "</td>"; 
 echo "<td>" . $row['ende']. "</td>"; 
echo "<td>" . $row['zeit']. "</td>";
  echo "<td>" . $row['beschreibung']."</td>";


 


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
			<form action="erfasstearbeitszeitzuweisung.php" method="post" autocomplete="off">
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
    </select><br>
	



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