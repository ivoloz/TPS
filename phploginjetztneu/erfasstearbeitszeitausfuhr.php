<?php





// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}




//CRUD in PHP and MySQL With Prepared Statements
require_once 'erfasstearbeitszeiteingabe.php';

$id=$_SESSION["id"];

echo $id;

$benutzerid=$id;
$beginn = $_POST["beginn"];
$ende = $_POST["ende"];

$beschreibung = $_POST["beschreibung"];




$result = PreQuery($benutzerid,$beginn, $ende, $beschreibung);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}
?>

