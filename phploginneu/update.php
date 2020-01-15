<?php
//CRUD is the abbreviation for Create, Read, Update and Delete queries
//Connect to database
require_once 'db_connection.php';


//Delete Query Using Prepared Statement
function UpdateQuery($column,$value,$id)

{

$conn = OpenCon();
	$query = $conn->prepare("UPDATE terminverfugbar SET $column = ? WHERE id = ?");
	$query->bind_param("si",$value,$id);
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
//Übergebene id mit der update-funktion updaten.
$result = UpdateQuery($column,$value,$id);
if($result === true)
{
  echo 'success';
  
}
else
{
  echo $result;
}
?>