<?php
//Connect to Database
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";

CloseCon($conn);

//include cad and create table
include 'cad.php';

$sql = "CREATE TABLE MyGuests(
id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";

$result = ExecuteQuery($sql,"Table Created Successfully");

echo $result;

//Operations
$result = AddColumn("MyGuests","subject","VARCHAR(50)");
echo $result;

$result = ModifyColumn("MyGuests","subject","VARCHAR(30)");
echo $result;

$result = DropColumn("MyGuests","reg_date");
echo $result;

?>