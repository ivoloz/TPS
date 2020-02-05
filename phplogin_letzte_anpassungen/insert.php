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



//Delete Query Using Prepared Statement
function InsertQuery($ereignisid)

{

$conn = OpenCon();

	$query = $conn->prepare("INSERT INTO benutzerereignis 
    SELECT * ereignis  WHERE ereignisid = ?;");

	$query->bind_param("i",$ereignisid);
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
//Überprüfen,welche ereignisid übergeben wurde!!!!!
if($_GET['ereignisid']) {
  $ereignisid = $_GET['ereignisid'];
}
//Übergebene ereignisid mit der insert-funktion verschieben.
$result = InsertQuery($ereignisid);
if($result === true)
{
  echo 'success';
  
}
else
{
  echo $result;
}

include 'update2.php';
?>