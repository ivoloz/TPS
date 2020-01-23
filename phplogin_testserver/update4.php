
		<?php

$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');


 
$statement = $pdo->prepare("UPDATE benutzer 
SET rollenid=? ;
");
$statement->execute(array(2));
?>