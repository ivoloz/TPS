

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formular</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>
<body>

<div class="formular">
<label>Bitte Felder ausfüllen um Zeiten einzutragen.</label></br>
			<form action="meetingausfuhr.php" method="post" autocomplete="on">

<label for="beginn">Beginn: </label>
    <input type="datetime-local" value="datetime" name="beginn" /></br>
   
<label for="ende">Ende: </label>
 <input type="datetime-local" value="datetime" name="ende" /></br>
   

<label for="bezeichnung" >Bezeichnung:</label>
<input type="text" name="bezeichnung"	placeholder="bezeichnung" id="bezeichnung" required></br>

<label for="beschreibung" >beschreibung:</label>
<input type="text" name="beschreibung"	placeholder="beschreibung" id="beschreibung" required></br>

	<label for="auswahl">Zuordnung</label>
    <select name="auswahl" size="1">
	
   		<?php
include 'crud.php';
$sql = "SELECT benutzerid ,email FROM `benutzer`";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc()){
  
          echo "<option value=".$row['benutzerid']."> ".$row['email']."</option>";	}
		}
		
		?>
    </select></br>

<input type="submit" value="Aufgabe erstellen"></br>
<input type="submit" value="Abbrechen"></br>

</form>
</div>
</body>
</html>
