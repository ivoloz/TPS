<?php





// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}




//CRUD in PHP and MySQL With Prepared Statements
require_once 'meetingeingabe.php';


$beginn = $_POST["beginn"];
$ende = $_POST["ende"];

$bezeichnung = $_POST["bezeichnung"];
$beschreibung = $_POST["beschreibung"];
$auswahl = $_POST["auswahl"];




	$result = PreQuery( $beginn, $ende, $bezeichnung , $beschreibung,$auswahl);
	$meetingidangelegt = PreQuery2($beginn, $ende, $bezeichnung , $beschreibung,$auswahl);
	//$tmp2 = PreQuery3($auswahl, $meetingidangelegt);
	
	
	//3 Zuordnungen in Zuordnungstabelle anlegen
	foreach($auswahl as $current_auswahl) {
		echo "current_auswahl: ".$current_auswahl."<br>";
		$result2 = PreQuery3($current_auswahl, $meetingidangelegt);
	}


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
echo "Meetingid angelegt: ".$meetingidangelegt;

echo "<br>";
echo "Zuordnung:";
if($result2 === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}

?>

