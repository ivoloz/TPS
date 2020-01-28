<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'tps';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['passwort']) ) {
	// Could not get the data that should have been sent.
	die ('Please fill both the email and passwort field!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT benutzerid, rollenid, passwort FROM benutzer WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
}
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($benutzerid, $rollenid,$passwort);
	$stmt->fetch();
	// Account exists, now we verify the passwort.
	// Note: remember to use passwort_hash in your registration file to store the hashed passworts.
	if (password_verify($_POST['passwort'], $passwort)) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['email'];
		$_SESSION['id'] = $benutzerid;
		$_SESSION['rollenid'] = $rollenid;
		
	
		header('Location: home.php');
	} else {
		echo 'Incorrect passwort!';
	}
} else {
	echo 'Incorrect email!';
}
$stmt->close();
?>