<?php
//Connect to database
require_once 'db_connection.php';

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($benutzerid,$beginn, $ende,$beschreibung)
{

	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO erfasstearbeitszeit(benutzerid,beginn, ende,  beschreibung) VALUES (?,?,?,?)");
	$query->bind_param("ssss",$benutzerid,$beginn, $ende,$beschreibung);
	
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