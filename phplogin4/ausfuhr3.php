<?php
require_once 'eingabe.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formular</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="formular">
<label>Bitte Felder ausfüllen um Aufgabe zu erstellen.</label></br>
			<form action="ausfuhr.php" method="post" autocomplete="off">

<label for="beginn">Aufgaben Beginn: </label>
    <input type="datetime-local" value="datetime" name="beginn" /></br>
   
<label for="ende">Aufgaben Ende: </label>
 <input type="datetime-local" value="datetime" name="ende" /></br>
   
	<label for="bezeichnung">Bezeichnung:</label>
<input type="text" name="bezeichnung" placeholder="Bezeichnung" id="bezeichnung" ></br>

<label for="beschreibung" >Beschreibung:</label>
<input type="text" name="beschreibung"	placeholder="Beschreibung" id="beschreibung" required></br>


<label for="prioritaet" >Priorität:</label>
    <select name="prioritaet" size="1">
	    <option>1</option>
        <option>2</option>
	   
    </select></br>


<input type="submit" value="Aufgabe erstellen"></br>
<input type="submit" value="Abbrechen"></br>

</form>
</div>
</body>
</html>
