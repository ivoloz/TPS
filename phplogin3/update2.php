<?php






$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


if($_GET['ereignisid']) {
  $ereignisid = $_GET['ereignisid'];
}

$status=2;


$id=$_SESSION["id"];
echo $id;
echo $status;

 
$statement = $pdo->prepare("UPDATE benutzerereignis SET benutzerid=$id, status=$status WHERE ereignisid = $ereignisid");
$statement->execute(array ($id, $status ,$ereignisid));
?>