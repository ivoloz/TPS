<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE config(
key_id int(11) PRIMARY KEY  NOT NULL,
  schluessel varchar(256) NOT NULL
)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>