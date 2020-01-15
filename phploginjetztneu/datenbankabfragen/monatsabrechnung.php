<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE monatsabrechnung(
monatsabrechnungid int(11) PRIMARY KEY  AUTO_INCREMENT NOT NULL,
  benutzerid int(11) NOT NULL,
  erfassungsmonat timestamp NOT NULL DEFAULT current_timestamp(),
  geleistete_gesamtstunden time DEFAULT NULL,
  max_gesamtstunden time DEFAULT NULL,
  abgerechnet tinyint(1) DEFAULT NULL,
   CONSTRAINT FOREIGN KEY (benutzerid) REFERENCES benutzer(benutzerid)

)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>