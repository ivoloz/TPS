<?php


// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}







$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


if($_GET['ereignisid']) {
  $ereignisid = $_GET['ereignisid'];
}

$status=2;


$id=$_SESSION["id"];
echo $id;
echo $status;

 
$statement = $pdo->prepare("UPDATE ereignis SET benutzerid=$id, status=$status WHERE ereignisid = $ereignisid");
$statement->execute(array ($id, $status ,$ereignisid));
?>