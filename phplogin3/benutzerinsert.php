
<?php
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');
 
$statement = $pdo->prepare("update benutzer set rollenid=? where ");
$statement->execute(array(2)); 
?>