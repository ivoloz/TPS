<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE benutzer(
  benutzerid int(11) PRIMARY KEY  AUTO_INCREMENT NOT NULL,
  arbeitgeberid int(11),
  rollenid int(11) ,
  vorname varchar(30) NOT NULL,
  nachname varchar(30) NOT NULL,
  email varchar(128) NOT NULL,
  passwort varchar(256) NOT NULL,
  kaz_von time ,
  kaz_bis time ,
  max_gesamtstunden time ,
  max_ueberstunden time ,
   init_passwort varchar(256) NOT NULL,
  CONSTRAINT FOREIGN KEY (rollenid) REFERENCES benutzerrolle(rollenid),
    CONSTRAINT FOREIGN KEY (arbeitgeberid) REFERENCES benutzer(benutzerid)
)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;

?>