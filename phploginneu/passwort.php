<?php
	session_start();
	$passwort_alt = md5($_POST["passwort_alt"]);
	$passwort_neu = md5($_POST["passwort_neu"]);
	$benutzerid = $_SESSION["id"];




	$verbindung = mysqli_connect('localhost', 'root', '', 'tps');





	$abfrage = "SELECT passwort FROM benutzer WHERE benutzerid=$benutzerid";
	$ergebnis = mysqli_query($abfrage);
	$pw_alt = mysqli_fetch_object($ergebnis);

	echo $pw_alt;






	if ($pw_alt == $passwort_alt)
	{$aendern = "UPDATE benutzer SET passwort =$passwort_neu WHERE benutzerid=$benutzerid";
	$update = mysql_query($aendern);
	echo "Dein Passwort wurde erfolgreich ge&auml;ndert.";}




	else
	{echo "Das Passwort war falsch.";}
	 ?>