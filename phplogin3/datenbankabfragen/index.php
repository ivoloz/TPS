<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE terminverfugbar(
id int,
sid INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
bezeichnung VARCHAR(30) NOT NULL,
terminbeginn datetime NOT NULL,
terminende datetime NOT NULL,
prioritat int(11) NOT NULL,
beschreibung VARCHAR(30) NOT NULL,
radiogroup varchar(30) NOT NULL,
status varchar(30)

)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>