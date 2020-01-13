<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'tps';


// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['vorname'],$_POST['nachname'], $_POST['email'], $_POST['passwort'] , $_POST['geheimtext'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['vorname']) || empty($_POST['nachname']) || empty($_POST['email']) || empty($_POST['passwort']) || empty($_POST['geheimtext'])) {
	// One or more values are empty.
	die ('Please complete the registration form');
}

// Email Validation
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	die ('Email is not valid!');
}
// Invalid Characters Validation
if (preg_match('/[A-Za-z0-9]+/', $_POST['vorname']) == 0) {
    die ('vorname is not valid!');
}
//Character Length Check
if (strlen($_POST['passwort']) > 20 || strlen($_POST['passwort']) < 5) {
	die ('passwort must be between 5 and 20 characters long!');
}
$geheimtext='1';
// geheimtext validation
if (!filter_var($_POST['geheimtext'], FILTER_VALIDATE_INT)) {
	die ('geheimtext is not valid!');
}


// We need to check if the account with that email exists.
if ($stmt = $con->prepare('SELECT benutzerid FROM benutzer WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the passwort using the PHP passwort_hash function.
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the email exists in the database.
	if ($stmt->num_rows > 0) {
		// email already exists
		echo 'email exists, please choose another!';
	} else {
		


		// vorname doesnt exists, insert new account
if ($stmt = $con->prepare('INSERT INTO benutzer (rollenid, vorname,nachname, email, passwort,kaz_von,kaz_bis, max_gesamtstunden,max_ueberstunden) VALUES ( ?,?, ?, ?,?,?,?,?,?)')) {
	// We do not want to expose passworts in our database, so hash the passwort and use passwort_verify when a user logs in.
	$passwort = password_hash($_POST['passwort'], PASSWORD_DEFAULT);
	$rollenid=2;
	$kaz_von=1;
	$kaz_bis=1;
	$max_gesamtstunden=1;
	$max_ueberstunden=1;

   $stmt->bind_param('sssssssss', $rollenid, $_POST['vorname'], $_POST['nachname'],$_POST['email'], $passwort,$kaz_von,$kaz_bis,$max_gesamtstunden,$max_ueberstunden  );
	$stmt->execute();
$from   = 'noreply@yourdomain.com';
$subject = 'Account Activation Required';
$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
$activate_link = 'http://yourdomain.com/phplogin/activate.php?email=' . $_POST['email']  ;
$message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
mail($_POST['email'], $subject, $message, $headers);
echo 'Please check your email to activate your account!';
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}

$con->close();
?>