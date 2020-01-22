<?php
//Connect to database
require_once 'db_connection.php';

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($beginn, $ende,$bezeichnung,$beschreibung,$status,$prioritaet)
{

	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO aufgabe( beginn, ende,bezeichnung, beschreibung,status,prioritaet) VALUES (?,?,?,?,?,?)");
	$query->bind_param("ssssss", $beginn, $ende, $bezeichnung, $beschreibung,$status,$prioritaet);
	
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

//hole aktuelle aufgabeid
include 'crud.php';
function PreQuery2($beginn, $ende,$bezeichnung,$beschreibung,$status,$prioritaet)
{
	$conn = OpenCon();
	$query = 'SELECT aufgabeid FROM aufgabe WHERE beginn="'.$beginn.'" AND ende="'.$ende.'" AND bezeichnung="'.$bezeichnung.'" AND beschreibung="'.$beschreibung.'" AND status="'.$status.'" AND prioritaet="'.$prioritaet.'" ORDER BY AUFGABEID DESC LIMIT 1;';
	//$query = 'SELECT aufgabeid FROM aufgabe ORDER BY AUFGABEID DESC LIMIT 1;';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	$result2 = $result->fetch_row();
	echo $result2[0];
	return $result2[0];
}


//mache Zurodnung über benutzerereignis
function PreQuery3($benutzerid, $aufgabeid)
{

	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO benutzerereignis(benutzerid, aufgabeid) VALUES (?,?)");
	$query->bind_param("ss", $benutzerid, $aufgabeid);
	
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