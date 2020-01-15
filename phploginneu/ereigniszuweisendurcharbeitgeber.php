<?php



$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


if($_GET['ereignisid']) {
  $ereignisid = $_GET['ereignisid'];
}

if($_GET['benutzerid']) {
  $benutzerid = $_GET['benutzerid'];
}


echo $benutzerid;
echo $ereignisid;

 
$statement = $pdo->prepare("insert into benutzerereignis (benutzerid,ereignisid) values ($benutzerid , $ereignisid)");
$statement->execute(array ($benutzerid, $ereignisid));
?>