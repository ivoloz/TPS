<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE benutzerereignis(
benutzerid int(11)  NOT NULL,
  ereignisid int(11) NOT NULL,
  beginn datetime NOT NULL,
  ende datetime NOT NULL,
  status varchar(30) NOT NULL,
  CONSTRAINT FOREIGN KEY (benutzerid) REFERENCES benutzer(benutzerid),
  CONSTRAINT FOREIGN KEY (ereignisid) REFERENCES ereignis(ereignisid),
  PRIMARY KEY (benutzerid, ereignisid)

)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>