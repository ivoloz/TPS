<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE benutzerrolle(
rollenid INT(11) PRIMARY KEY NOT NULL,
rolle VARCHAR(30) NOT NULL


)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>