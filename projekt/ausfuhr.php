<?php
//CRUD in PHP and MySQL With Prepared Statements
require_once 'eingabe.php';


$bez = $_POST["bezeichnung"];
$terminbeginn = $_POST["terminbeginn"];
$zeitanfang = $_POST["zeitanfang"];
$terminende = $_POST["terminende"];
$zeitende = $_POST["zeitende"];
$prio = $_POST["prioritat"];
$beschr = $_POST["beschreibung"];
$radiogroup = $_POST["radiogroup"];
$result = PreQuery($bez, $terminbeginn, $zeitanfang, $terminende, $zeitende, $prio, $beschr, $radiogroup);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}
?>

