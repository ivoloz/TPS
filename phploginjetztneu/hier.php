
<?php


// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

$test=$_SESSION["arbeit"];
echo $test;


$id=$_SESSION["id"];
echo $id;


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Link</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>
<body>


   

<a href='abfrage.php?id=111'>zeitabfrage</a>




</form>
</div>
</body>
</html>
