<?php



//Single Query Execution
require_once 'crud.php';

$sql = "INSERT INTO myguests(firstname,lastname,email,subject) VALUES ('w','w','t@gmail.com','First Insert Using Single Query')";

$result = SingleQuery($sql);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}

//Multi Queries Execution
require_once 'crud.php';

$sql = "INSERT INTO myguests(firstname,lastname,email,subject) VALUES ('a','a','a@gmail.com','First Insert Using Multiple Queries');";
$sql .= "INSERT INTO myguests(firstname,lastname,email,subject) VALUES ('b','b','b@gmail.com','First Insert Using Multiple Queries');";
$sql .= "INSERT INTO myguests(firstname,lastname,email,subject) VALUES ('c','c','c@gmail.com','First Insert Using Multiple Queries');";

$result = MultiQuery($sql);

if($result === true)
{
 echo 'success';
 
}
else
{
 echo $result;
}


//CRUD in PHP and MySQL With Prepared Statements
require_once 'crud.php';


$firstn = "Ahmed";
$lastn = "Khan";
$email = "ahmed.khan@cloudways.com";
$subject = "Inserting Data using prepared Query";
$result = PreQuery($firstn,$lastn,$email,$subject);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}
?>



<table>
 <tr>
 <td> Name</td>
 <td> Email</td>
 <td> Message</td>
 </tr>
<?php
//Select Query Execution//Output Browser
require_once 'crud.php';
$sql = "SELECT * FROM `myguests`";
$result = selectdata($sql);
if($result != "zero")
{
 
 while($row = $result->fetch_assoc())
 {
 echo "<tr>";
 echo "<td>" . $row['firstname'].' '.$row['lastname'] . "</td>";
 echo "<td>" . $row['email']. "</td>"; 
 echo "<td>" . $row['subject']. "</td>"; 
 echo "</tr>";
 }
 
 
}
else
{
 echo $result;
}
?>
 </table>
<?php
//Update Query Using Prepared Statement
require_once 'crud.php';



$result = UpdateQuery("firstname","David",1);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}

//Delete Query Using Prepared Statement
require_once 'crud.php';

$result = DeleteQuery(1);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}
?>




