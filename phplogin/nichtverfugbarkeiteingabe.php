<?php
//Connect to database
require_once 'db_connection.php';

//CRUD in PHP and MySQL With Prepared Statements
function PreQuery($beginn, $ende,$bezeichnung, $beschreibung)
{

	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO nichtverfugbarkeit(beginn, ende,  bezeichnung,beschreibung) VALUES (?,?,?,?)");
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

//hole aktuelle nichtverfugbarkeitid
include 'crud.php';
function PreQuery2($beginn, $ende,$bezeichnung,$beschreibung)
{
	$conn = OpenCon();
	$query = 'SELECT nichtverfugbarkeitid FROM nichtverfugbarkeit WHERE beginn="'.$beginn.'" AND ende="'.$ende.'" AND bezeichnung="'.$bezeichnung.'" AND beschreibung="'.$beschreibung.'" ORDER BY NICHTVERFUGBARKEITID DESC LIMIT 1 ;';
	$statement = $conn->prepare($query);
	$statement->execute();
	$result = selectdata($query);
	$result2 = $result->fetch_row();

	return $result2[0];
}

//mache Zurodnung Ă¼ber benutzerereignis
function PreQuery3($benutzerid, $nichtverfugbarkeitid)
{
	


	$conn = OpenCon();
	$query = $conn->prepare("INSERT INTO benutzerereignis(benutzerid, nichtverfugbarkeitid) VALUES (?,?)");
	$query->bind_param("ss", $benutzerid, $nichtverfugbarkeitid);
	
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