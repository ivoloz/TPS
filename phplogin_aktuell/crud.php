<?php
//CRUD is the abbreviation for Create, Read, Update and Delete queries
//Connect to database
require_once 'db_connection.php';

//Select Query Execution
function selectdata($sql)
{
	$conn = OpenCon();
	
	$result = $conn->query($sql);
	if($result)
	{
		if($result->num_rows > 0)
		{
			return $result;
		}
		else
		{
			return "zero";
		}
	}
	else
	{
		return $result->error;
	}
}
?>