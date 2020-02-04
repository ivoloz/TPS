<?php


// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

// If the user logs in first time or has not changed his password redirect to the password page...
if (!isset($_SESSION['abfrage'])) {
	header('Location: passwort.html');
	exit();
}







$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


if($_GET['arbeitszeitid']) {
  $arbeitszeitid = $_GET['arbeitszeitid'];
}

$status=1;


 
$statement = $pdo->prepare("UPDATE benutzerereignis SET status=$status WHERE arbeitszeitid = $arbeitszeitid");
$statement->execute(array ($status ,$arbeitszeitid));


?>