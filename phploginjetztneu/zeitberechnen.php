<?php


// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

$id=$_SESSION["id"];

echo $id;

require_once 'crud.php';
$sql = "SELECT (beginn-ende) AS zeit FROM `erfasstearbeitszeit` where id=$id";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo 'nix';
 }
 
 
 
else
{
 echo $result;
}

 
}
?>