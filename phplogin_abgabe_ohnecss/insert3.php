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


//CRUD is the abbreviation for Create, Read, Update and Delete queries
//Connect to database
require_once 'db_connection.php';

echo $_SESSION["name"];
$id=$_SESSION["name"];

//Delete Query Using Prepared Statement
function InsertQuery($sid)

{

$conn = OpenCon();

	$query = $conn->prepare("INSERT INTO test
    SELECT *  FROM terminverfugbar  WHERE sid = ?
	and id from accounts WHERE name=$id;");

	$query->bind_param("i",$sid);
	//var_dump($query);

	
	if($query->execute())
	{
		CloseCon($conn);
		return true;
	}
	else
	{
		return $conn->error;
	}
}
//Überprüfen,welche sid übergeben wurde!!!!!
if($_GET['sid']) {
  $sid = $_GET['sid'];
}
//Übergebene sid mit der insert-funktion verschieben.
$result = InsertQuery($sid);
if($result === true)
{
  echo 'success';
  
}
else
{
  echo $result;
}
?>