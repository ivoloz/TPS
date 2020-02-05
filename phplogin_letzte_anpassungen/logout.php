<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
$email = $_SESSION['name'];
$datum = date("d.m.Y");
$uhrzeit = date("H:i");

file_put_contents('./logfile.log', "$datum $uhrzeit Abmeldung $email "."\n", FILE_APPEND);


session_destroy();
// Redirect to the login page:
header('Location: index.html');
?>