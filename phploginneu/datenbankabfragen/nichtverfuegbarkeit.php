<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE nichtverfuegbarkeit(
ereignisid int(11) PRIMARY KEY  NOT NULL,
  beginn datetime NOT NULL,
  ende datetime NOT NULL,
  bezeichnung varchar(30) DEFAULT NULL,
  beschreibung text DEFAULT NULL


)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>