<?php
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

$nichtverfugbarkeitid = $_GET["nichtverfugbarkeitid"];
echo $nichtverfugbarkeitid;

$statement = $pdo->prepare("DELETE FROM nichtverfugbarkeit WHERE nichtverfugbarkeitid = $nichtverfugbarkeitid");
$statement->execute(array($nichtverfugbarkeitid));
?>

