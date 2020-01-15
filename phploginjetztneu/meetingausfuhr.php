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



$result = PreQuery($beginn, $ende, $bezeichnung,$beschreibung);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}
?>

