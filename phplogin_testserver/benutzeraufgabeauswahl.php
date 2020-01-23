<?php



$pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo');


if($_GET['aufgabeid']) {
  $aufgabeid = $_GET['aufgabeid'];
}


$id=$_SESSION["id"];



 
$statement = $pdo->prepare("insert into benutzerereignis (benutzerid,aufgabeid) values ($id , $aufgabeid)");
$statement->execute(array ($id, $aufgabeid));
?>