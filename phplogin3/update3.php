
		<?php






$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

if($_POST['email']) {
  $email = $_POST['email'];
}

$rollenid=1;
 
$statement = $pdo->prepare("UPDATE benutzer SET rollenid=$rollenid where email=$email");
$statement->execute(array ($rollenid));
?>