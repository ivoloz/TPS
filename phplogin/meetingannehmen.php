<?php


// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}







$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


$benutzerid = $_SESSION["id"];
	echo $benutzerid;

if($_GET['benutzerereignisid']) {
  $benutzerereignisid = $_GET['benutzerereignisid'];
}

$bestatigt=3;

echo $bestatigt;

 
$statement = $pdo->prepare("UPDATE benutzerereignis SET bestatigt=$bestatigt WHERE benutzerereignisid = $benutzerereignisid and benutzerid=$benutzerid");
$statement->execute(array ($bestatigt ,$benutzerereignisid));


?>