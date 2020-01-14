<?php
//CRUD in PHP and MySQL With Prepared Statements
require_once 'eingabe.php';


$title = $_POST["title"];
$start = $_POST["start_event"];
$end = $_POST["end_event"];

$result = PreQuery($title, $start, $end);

if($result === true)
{
	echo 'success';
	
}
else
{
	echo $result;
}
?>

