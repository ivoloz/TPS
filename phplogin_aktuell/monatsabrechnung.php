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
  erfassungsmonat varchar(30) NOT NULL,
  geleistete_gesamtstunden varchar(30) NOT NULL,
  max_gesamtstunden varchar(30) NOT NULL,
  CONSTRAINT FOREIGN KEY (benutzerid) REFERENCES benutzer(benutzerid)

)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>