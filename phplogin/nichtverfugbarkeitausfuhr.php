<?php





// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}




//CRUD in PHP and MySQL With Prepared Statements
require_once 'nichtverfugbarkeiteingabe.php';


$beginn = $_POST["beginn"];
$ende = $_POST["ende"];

$bezeichnung = $_POST["bezeichnung"];
$beschreibung = $_POST["beschreibung"];
$benutzerid=$_SESSION["id"];



	$result = PreQuery( $beginn, $ende, $bezeichnung , $beschreibung);
	$nichtverfugbarkeitidangelegt = PreQuery2($beginn, $ende, $bezeichnung , $beschreibung);
	$tmp2 = PreQuery3($benutzerid, $nichtverfugbarkeitidangelegt);


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
echo "Nichtverfugbarkeitid angelegt: ".$nichtverfugbarkeitidangelegt;

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

