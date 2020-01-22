<?php
//CRUD in PHP and MySQL With Prepared Statements
require_once 'einfachzuweisungeingabe.php';



$beginn = $_POST["beginn"];
$ende = $_POST["ende"];
$bezeichnung = $_POST["bezeichnung"];
$beschreibung = $_POST["beschreibung"];
$status = 2;
$prioritaet = $_POST["prioritaet"];
$auswahl = $_POST["auswahl"];

	$result = PreQuery( $beginn, $ende, $bezeichnung , $beschreibung, $status,$prioritaet,$auswahl);
	$aufgabeidangelegt = PreQuery2($beginn, $ende, $bezeichnung , $beschreibung, $status,$prioritaet,$auswahl);
	$tmp2 = PreQuery3($auswahl, $aufgabeidangelegt);


echo "Aufgabe einfuegen: ";
if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}

echo "<br>";
echo "Aufgabeid angelegt: ".$aufgabeidangelegt;

echo "<br>";
echo "Zuordnung:";
if($tmp2 === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}


?>

