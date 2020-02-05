<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE meeting(
  meetingid int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  beginn datetime NOT NULL,
  ende datetime NOT NULL,
  bezeichnung varchar(30) NOT NULL ,
  beschreibung varchar(30) NOT NULL 


)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>