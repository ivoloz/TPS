<?php
//Connect to database
require_once 'db_connection.php';

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($beginn, $ende,$bezeichnung, $beschreibung)
{

	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO nichtverfugbarkeit(beginn, ende,  bezeichnung,beschreibung) VALUES (?,?,?,?)");
	$query->bind_param("ssss",$beginn, $ende,$bezeichnung,$beschreibung);
	
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