<?php
//Connect to database
require_once 'db_connection.php';

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($beginn, $ende, $bezeichnung,$beschreibung,$status,$prioritaet)
{

	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO ereignis(beginn, ende, bezeichnung, beschreibung,status,prioritaet) VALUES (?,?,?,?,?,?)");
	$query->bind_param("ssssss",$beginn, $ende, $bezeichnung,$beschreibung,$status,$prioritaet);
	
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