
<?php
$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');
 
$statement = $pdo->prepare("INSERT INTO benutzerrolle (rollenid, rolle) VALUES (?, ?)");
$statement->execute(array(1, 'Arbeitnehmer')); 
?>