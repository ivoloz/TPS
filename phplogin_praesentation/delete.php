<?php
//CRUD is the abbreviation for Create, Read, Update and Delete queries
//Connect to database
require_once 'db_connection.php';

include 'insert.php';
//Delete Query Using Prepared Statement
function DeleteQuery($id)

{

$conn = OpenCon();
	$query = $conn->prepare("DELETE FROM terminverfugbar WHERE id = ?");
	$query->bind_param("i",$id);
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
//Überprüfen,welche id übergeben wurde!!!!!
if($_GET['id']) {
  $id = $_GET['id'];
}
//Übergebene id mit der delete-funktion löschen.
$result = DeleteQuery($id);
if($result === true)
{
  echo 'success';
  
}
else
{
  echo $result;
}
?>