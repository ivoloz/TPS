<?php



$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


if($_GET['ereignisid']) {
  $ereignisid = $_GET['ereignisid'];
}


$id=$_SESSION["id"];

echo $id;

echo $ereignisid;

 
$statement = $pdo->prepare("insert into benutzerereignis (benutzerid,ereignisid) values ($id , $ereignisid)");
$statement->execute(array ($id, $ereignisid));
?>