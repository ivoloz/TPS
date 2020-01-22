<?php
//Connect to database
require_once 'db_connection.php';

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($beginn, $ende, $bezeichnung, $beschreibung)
{

	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO meeting(beginn, ende,  bezeichnung,beschreibung) VALUES (?,?,?,?)");
	$query->bind_param("ssss",$beginn, $ende,$bezeichnung,$beschreibung);
	
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

//hole aktuelle meetingid
include 'crud.php';
function PreQuery2($beginn, $ende,$bezeichnung,$beschreibung)
{
	$conn = OpenCon();
	$query = 'SELECT meetingid FROM meeting WHERE beginn="'.$beginn.'" AND ende="'.$ende.'" AND bezeichnung="'.$bezeichnung.'" AND beschreibung="'.$beschreibung.'" ORDER BY MEETINGID DESC LIMIT 1;';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	$result2 = $result->fetch_row();
	echo 'MEETINGID: '.$result2[0]."<br>";
	return $result2[0];
}

//mache Zurodnung Ă¼ber benutzerereignis
function PreQuery3($bid, $mid)
{

	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO benutzerereignis(benutzerid, meetingid) VALUES (?,?)");
	$query->bind_param("ss", $bid, $mid);
	
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

?>