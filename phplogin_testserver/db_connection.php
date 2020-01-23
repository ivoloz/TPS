<?php
//Connect to Database
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "newuser";
 $dbpass = "2ToWInfo";
 $db = "tps";


 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>