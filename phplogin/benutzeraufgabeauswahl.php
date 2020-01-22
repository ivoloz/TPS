<?php



$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


if($_GET['aufgabeid']) {
  $aufgabeid = $_GET['aufgabeid'];
}


$id=$_SESSION["id"];

echo $id;

echo $aufgabeid;

 
$statement = $pdo->prepare("insert into benutzerereignis (benutzerid,aufgabeid) values ($id , $aufgabeid)");
$statement->execute(array ($id, $aufgabeid));
?>