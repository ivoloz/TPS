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

$benutzerid = $_SESSION["id"];
	echo $benutzerid;

require_once 'crud.php';

$conn = OpenCon();
$query = "SELECT (ende-beginn) AS zeit FROM `erfasstearbeitszeit` where benutzerid=$benutzerid";
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	$result2 = $result->fetch_row();
	echo $result2[0];
	return $result2[0];
	

?>