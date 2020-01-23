<?php

require_once './vendor/autoload.php';
$email = $_POST["email"];
echo "Hallo $email ";


//hole aktuelle nichtverfugbarkeitid
include 'crud.php';
function PreQuery2($email)
{
	$conn = OpenCon();
	$query = 'SELECT passwort FROM benutzer WHERE email=$email;';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	$result2 = $result->fetch_row();
	echo $result2[0];
	return $result2[0];
}
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
            $message->addTo($_POST['email']);


            // Set the plain-text "Body"
            $message->setBody('<a href="http://localhost/phplogin/index.html">Klicken SIe hier zum Login</a><p></p>', 'text/html');

			
            // Set a "Body"
           // $message->addPart('This is the HTML version of the message.<br>Example of inline image:<br><img src="'.$cid.'" width="200" height="200"><br>Thanks,<br>Admin', 'text/html');

            // Send the message
            $result = $mailer->send($message);
        } catch (Exception $e) {
            echo $e->getMessage();
        }


    echo 'Please check your email to activate your account!';
?>