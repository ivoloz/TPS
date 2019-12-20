<?php
//CRUD is the abbreviation for Create, Read, Update and Delete queries
//Connect to database
require_once 'db_connection.php';


//Single Query Execution
function SingleQuery($queri)
{
	$conn = OpenCon();
	
	
	if($conn->query($queri) === TRUE)
	{
		CloseCon($conn);
		return true;
	}
	else
	{
		return $conn->error;
	}

}

//Multi Queries Execution
function MultiQuery($quries)
{
	$conn = OpenCon();
	
	
	if($conn->multi_query($quries) === true)
	{
		CloseCon($conn);
		return true;
	}
	else
	{
		return $conn->error;
	}
}

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($fname,$lname,$email,$subj)
{
	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO myguests(firstname, lastname, email, subject) VALUES (?,?,?,?)");
	$query->bind_param("ssss", $fname,$lname,$email,$subj);
	
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
//Update Query Using Prepared Statement
function UpdateQuery($column,$value,$id)
{
$conn = OpenCon();
$query = $conn->prepare("UPDATE myguests SET $column = ? WHERE id = ?");
$query->bind_param("si",$value,$id);

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

//Delete Query Using Prepared Statement
function DeleteQuery($id)
{
$conn = OpenCon();
	$query = $conn->prepare("DELETE FROM myguests WHERE id = ?");
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
?>