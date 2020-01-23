
<?php
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'newuser', '2ToWInfo');
 
$statement = $pdo->prepare("update benutzer set rollenid=? where ");
$statement->execute(array(2)); 
?>