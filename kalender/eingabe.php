<?php
//Connect to database
require_once 'db_connection.php';

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($title, $start, $end)
{
	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO events(title, start_event, end_event) VALUES (?,?,?)");
	$query->bind_param("sss", $title, $start, $end);
	
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
?>