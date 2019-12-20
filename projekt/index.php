<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE erste(
id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
bezeichnung VARCHAR(30) NOT NULL,
terminbeginn date NOT NULL,
zeitanfang time NOT NULL,
terminende date NOT NULL,
zeitende time NOT NULL,
prioritat int(11) NOT NULL,
beschreibung VARCHAR(30) NOT NULL,
radiogroup varchar(30) NOT NULL
)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;


?>