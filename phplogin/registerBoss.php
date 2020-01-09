<?php
require_once './vendor/autoload.php';
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['vorname'], $_POST['nachname'], $_POST['email'], $_POST['password'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['vorname']) || empty($_POST['nachname']) || empty($_POST['email']) || empty($_POST['password'])) {
	// One or more values are empty.
	die ('Please complete the registration form');
}

// Email Validation
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	die ('Email is not valid!');
}
// Invalid Characters Validation
//if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
//    die ('Username is not valid!');
//}
//Character Length Check
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	die ('Password must be between 5 and 20 characters long!');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Email exists, please choose another!';
	} else if ($stmt = $con->prepare('INSERT INTO accounts (vorname, nachname, email, password, activation_code) VALUES (?, ?, ?, ?, ?)')) {
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $uniqid = uniqid();
        $stmt->bind_param('sssss', $_POST['vorname'], $_POST['nachname'], $_POST['email'],$password, $uniqid);
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
            $message->setBody("Sehr geehrter Mitarbeiter, hier ihr vorläufiges Passwort: ".$_POST['password'].
            "\nBitte melden Sie sich mit diesem Passwort einmalig an, und ändern Sie es umgehend\nMFG \nAdmin");

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
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>