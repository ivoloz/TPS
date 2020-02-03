<?php
//cad means (create,alter,drop).
function ExecuteQuery($sql,$name)
{
	$conn = OpenCon();

	if ($conn->query($sql) === TRUE) 
	{
        return $name;
	} 
	else 
	{
		$error = "Error creating table: " . $conn->error;
		CloseCon($conn);

        return $error;
	}
}

?>