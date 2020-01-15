<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

$pdo = new PDO('mysql:host=localhost;dbname=test', '', '');

if($_GET['sid']) {
  $sid = $_GET['sid'];
}
$id=$_SESSION["id"];
echo $id;

$statement = $pdo->prepare("UPDATE hallo SET id=$id where sid=$sid");
$statement->execute(array($id));   


?>
