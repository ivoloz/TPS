<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE erfasstearbeitszeit(
arbeitszeitid int(11) PRIMARY KEY  AUTO_INCREMENT NOT NULL,
  benutzerid int(11) NOT NULL,
  beginn datetime NOT NULL,
  ende datetime NOT NULL,
  beschreibung varchar(30) NOT NULL,
   CONSTRAINT FOREIGN KEY (benutzerid) REFERENCES benutzer(benutzerid)

)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>