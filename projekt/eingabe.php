<?php
//Connect to database
require_once 'db_connection.php';

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($bez, $terminbeginn, $zeitanfang, $terminende, $zeitende,$prio,$beschr,$radiogroup)
{
	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO erste(bezeichnung, terminbeginn, zeitanfang, terminende, zeitende, prioritat, beschreibung,radiogroup) VALUES (?,?,?,?,?,?,?,?)");
	$query->bind_param("ssssssss", $bez, $terminbeginn, $zeitanfang, $terminende, $zeitende,$prio,$beschr,$radiogroup);
	
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