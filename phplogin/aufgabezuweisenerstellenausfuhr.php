<?php
//CRUD in PHP and MySQL With Prepared Statements
require_once 'aufgabezuweisenerstelleneingabe.php';


$beginn = $_POST["beginn"];
$ende = $_POST["ende"];
$bezeichnung = $_POST["bezeichnung"];
$beschreibung = $_POST["beschreibung"];
$status = 2;
$prioritaet = $_POST["prioritaet"];



$result = PreQuery($beginn, $ende,$bezeichnung, $beschreibung,$status, $prioritaet);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}
include 'aufgabezuweisendurcharbeitgeber.php';
?>

