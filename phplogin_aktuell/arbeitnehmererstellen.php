<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}


require_once './vendor/autoload.php';
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
if (!isset($_POST['vorname'],$_POST['nachname'], $_POST['email'],  $_POST['kaz_von'], $_POST['kaz_bis'], $_POST['max_gesamtstunden'],$_POST['max_ueberstunden'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['vorname']) || empty($_POST['nachname']) || empty($_POST['email']) ||  empty($_POST['kaz_von'])|| empty($_POST['kaz_bis'])|| empty($_POST['max_gesamtstunden'])|| empty($_POST['max_ueberstunden'])) {
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

$pw = random_int (100000 , 999999 );
echo $pw;

$pw = password_hash($pw , PASSWORD_DEFAULT);

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
if ($stmt = $con->prepare('INSERT INTO benutzer (arbeitgeberid, rollenid, vorname,nachname, email, passwort, kaz_von, kaz_bis, max_gesamtstunden, max_ueberstunden) VALUES ( ?,?,?, ?, ?,?,?,?,?,?)')) {
	// We do not want to expose passworts in our database, so hash the passwort and use passwort_verify when a user logs in.

	$rollenid=1;
	$arbeitgeberid=$_SESSION['id'];


	$kaz_von_konv = $_POST['kaz_von'].":00:00";;
	$kaz_bis_konv = $_POST['kaz_bis'].":00:00";;
	$max_gesamtstunden_konv = $_POST['max_gesamtstunden'].":00:00";;
	$max_ueberstunden_konv = $_POST['max_ueberstunden'].":00:00";;

	
    $stmt->bind_param('ssssssssss', $arbeitgeberid, $rollenid, $_POST['vorname'], $_POST['nachname'],$_POST['email'], $pw , $kaz_von_konv, $kaz_bis_konv, $max_gesamtstunden_konv, $max_ueberstunden_konv);
	$stmt->execute();
try {
            // Create the SMTP Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('david.himmelstoss@gmail.com')
                ->setPassword('HiTheRt77');

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = new Swift_Message();

            // Set a "subject"
            $message->setSubject('Dein Passwort für das Zeitaufzeichnungssystem.');

            // Set the "From address"
            $message->setFrom(['david.himmelstoss@gmail.com' => 'noreply']);

            // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
            $message->addTo($_POST['email'],$_POST['vorname']);


           // Set the plain-text "Body"
            $message->setBody( '<p>Danke das Sie sich für das Zeitaufzeichnungssystem entschieden haben.</p><p> Ihr Passwort entnehmen Sie bitte im Betreff.</p><p> Bitte ändern Sie ihr Passwort bei der Erstanmeldung.</p><p> Um die Registrierung abzuschliessen klicken Sie bitte auf folgenden Link</p><a href="http://localhost/phplogin/index.html">Klicken SIe hier zum Login</a><p></p>', 'text/html'

			);

            // Set a "Body"
           // $message->addPart('This is the HTML version of the message.<br>Example of inline image:<br><img src="'.$cid.'" width="200" height="200"><br>Thanks,<br>Admin', 'text/html');

            // Send the message
            $result = $mailer->send($message);
        } catch (Exception $e) {
            echo $e->getMessage();
        }






   /*
    $from   = 'david.himmelstoss@gmail.com';
    $subject = 'Account Activation Required';
    $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
    $activate_link = 'http://zeitaufzeichnung.com/phplogin/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
    $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
    mail($_POST['email'], $subject, $message, $headers);
   */
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