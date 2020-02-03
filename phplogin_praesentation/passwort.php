
	
	<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Übersichtsseite</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">

				<nav class="navtop">
			<div>
				<!-- <h1>Zeitapp</h1> -->
				<a href="home.php"><i class="fa fa-home fa-fw"></i>Übersicht</a>
				<a href="kalender.php"><i class="fa fa-calendar"></i>Kalender</a>
				<a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-user-circle"></i>Arbeitszeiten</a>
				<a href="nichtverfugbarkeitausgabe.php"><i class="fa fa-thumbs-down"></i>Nicht-Verfügbarkeit</a>
				<a href="aufgabeausgabe.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meetingausgabe.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
			</div>
		</nav>
		<div class="content">
<?php
	session_start();
	$passwort_alt_hashed = password_hash($_POST["passwort_alt"] , PASSWORD_DEFAULT);
	$passwort_alt = $_POST["passwort_alt"];
	$passwort_neu_hashed = password_hash($_POST["passwort_neu"] , PASSWORD_DEFAULT);
	$passwort_neu = $_POST["passwort_neu"];
	
	//echo "PW alt: ".$passwort_alt."<br>";
	//echo "PW neu: ".$passwort_neu."<br>";
	
	$benutzerid = $_SESSION["id"];
	//echo "benutzerid: ".$benutzerid."<br>";


include 'crud.php';
function PreQuery2($benutzerid){
	$conn = OpenCon();
	$query = 'SELECT passwort FROM benutzer WHERE benutzerid='.$benutzerid.';';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	$result2 = $result->fetch_row();
	//echo "PW alt: ".$result2[0]."<br>";;
	return $result2[0];
}
	
	$passwort_alt_von_sql_hashed = PreQuery2($benutzerid);
	
	if (password_verify($passwort_alt, $passwort_alt_von_sql_hashed)){
		function UpdateQuery($bid, $pwneu) {
			$pwne_hashed = password_hash($pwneu, PASSWORD_DEFAULT);
			
			$conn = OpenCon();
			$query = $conn->prepare('UPDATE benutzer SET passwort = "'.$pwne_hashed.'" WHERE benutzerid="'.$bid.'";');
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
		
		UpdateQuery($benutzerid, $passwort_neu);
		
		
		echo "Dein Passwort wurde erfolgreich geändert.";
		$_SESSION['abfrage'] = TRUE;
	}
		
	else {
		echo "Das Passwort war falsch.";
	}



?>

</body>
</html>

<br>
<button onclick="goBack()">Zurück</button>
<script>
function goBack() {
  window.history.back();
}
</script>



