<?php

require_once './vendor/autoload.php';
$email = $_POST["email"];
//echo "Hallo $email ";


include 'crud.php';

$pw = random_int (100000 , 999999 );
//echo $pw;


		function UpdateQuery($pwhashed, $email) {
		    $pwhashed = password_hash($pw , PASSWORD_DEFAULT);
			
			$conn = OpenCon();
			$query = $conn->prepare('UPDATE benutzer SET passwort = "'.$pwhashed.'" WHERE email="'.$email.'";');
			//echo 'UPDATE benutzer SET passwort = "'.$pwne_hashed.'" WHERE benutzerid="'.$bid.'";';
			//$query->bind_param("ss", $pwne_hashed, $bid);
			
			
			if($query->execute())
			{
				CloseCon($conn);
				return true;
			}
			else
			{
				return $conn->error;
			}
			
		}
		
		$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

 $pwhashed = password_hash($pw , PASSWORD_DEFAULT);

$statement = $pdo->prepare("UPDATE benutzer SET passwort= ? WHERE email = ?");
$statement->execute(array ($pwhashed ,$email));

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
             $message->setSubject('Dein Passwort für das Zeitaufzeichnungssystem: ');

            // Set the "From address"
            $message->setFrom(['david.himmelstoss@gmail.com' => 'noreply']);

            // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
            $message->addTo($_POST['email']);


           
            // Set the plain-text "Body"
            $message->setBody('<h1>Willkommen!</h1>
<p>Sie haben ein neues Passwort angefordert.</p>
<p>Ihr neues Passwort lautet: </p>'.$pw.'
<p>Damit Sie sich wieder anmelden können klicken Sie bitte auf folgenden Link:</p>
<a href="http://localhost/phplogin/index.html">Klicken SIe hier zum Login</a><p></p>', 'text/html');

			
            // Set a "Body"
           // $message->addPart('This is the HTML version of the message.<br>Example of inline image:<br><img src="'.$cid.'" width="200" height="200"><br>Thanks,<br>Admin', 'text/html');

            // Send the message
            $result = $mailer->send($message);
        } catch (Exception $e) {
            echo $e->getMessage();
        }


    echo 'Bitte in ihrem E-Mail Postfach nachsehen für neues Passwort!';
?>