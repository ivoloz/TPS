<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE hallo(
id INT PRIMARY KEY NOT NULL
)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>