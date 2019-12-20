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

//Operations
//Modify Column
function ModifyColumn($table,$columnname,$datatype)
{
	$query = "ALTER TABLE ". $table."
	MODIFY COLUMN ". $columnname ." ".$datatype;
	
	$result = ExecuteQuery($query,"Column successfully modified");
	return $result;

}
//Add Column
function AddColumn($table,$columnname,$datatype)
{
	$query = "ALTER TABLE ". $table."
	ADD ". $columnname ." ".$datatype;
	
	$result = ExecuteQuery($query,"Column Added successfully");
	return $result;
}
//Drop Column
function DropColumn($table,$columnname)
{
	$query = "ALTER TABLE ". $table."
	DROP COLUMN ". $columnname;
	
	$result = ExecuteQuery($query,"Column deleted successfully");
	return $result;
}
// Drop Table
function DropTable($table)
{
	$query = "DROP TABLE ". $table;
	
	$result = ExecuteQuery($query,"Table deleted successfully");
	return $result;
}
?>