<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE benutzerereignis(
  benutzerereignisid int(11) PRIMARY KEY  AUTO_INCREMENT NOT NULL,
  benutzerid int(11) NOT NULL,
  nichtverfugbarkeitid int(11) NULL,
  aufgabeid int(11) NULL,
  meetingid int(11) NULL,
  bestatigt int(11) DEFAULT 1,
  CONSTRAINT FOREIGN KEY (benutzerid) REFERENCES benutzer(benutzerid),
  CONSTRAINT FOREIGN KEY (nichtverfugbarkeitid) REFERENCES nichtverfugbarkeit(nichtverfugbarkeitid) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FOREIGN KEY (aufgabeid) REFERENCES aufgabe(aufgabeid) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT FOREIGN KEY (meetingid) REFERENCES meeting(meetingid) ON DELETE CASCADE ON UPDATE RESTRICT

)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>