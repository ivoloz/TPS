<?php


// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}







$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


if($_GET['aufgabeid']) {
  $aufgabeid = $_GET['aufgabeid'];
}

$status=3;

echo $status;

 
$statement = $pdo->prepare("UPDATE aufgabe SET status=$status WHERE aufgabeid = $aufgabeid");
$statement->execute(array ($status ,$aufgabeid));


?>