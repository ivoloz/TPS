<?php



$pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo' );


if($_GET['aufgabeid']) {
  $aufgabeid = $_GET['aufgabeid'];
}

if($_GET['benutzerid']) {
  $benutzerid = $_GET['benutzerid'];
}


echo $benutzerid;
echo $aufgabeid;

 
$statement = $pdo->prepare("insert into benutzerereignis (benutzerid,aufgabeid) values ($benutzerid , $aufgabeid)");
$statement->execute(array ($benutzerid, $aufgabeid));
?>