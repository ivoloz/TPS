<?php
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');
 
$statement = $pdo->prepare("INSERT INTO config (key_id, schluessel) VALUES (?, ?)");
$statement->execute(array(1, 'Schneewittchen7')); 
?>