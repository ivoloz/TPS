<?php
###########################################################
/*
GuestBook Script
Copyright (C) 2012 StivaSoft ltd. All rights Reserved.


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

For further information visit:
http://www.phpjabbers.com/
info@phpjabbers.com

Version:  1.0
Released: 2013-09-07
*/
###########################################################

//error_reporting(0);
include("db_connection.php");
$conn = $connection = OpenCon();
//$date = mysqli_real_escape_string($conn, $_REQUEST['date']);
$date = $_REQUEST['date'];
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit();
}


$benutzerid = $_SESSION["id"];

$rollenid = $_SESSION["rollenid"];
$check1 = false;
$check2 = false;
$check3 = false;
if (isset($_REQUEST['check1'] )) {
    $check1 = $_REQUEST['check1'];
}
if (isset($_REQUEST['check2'] )) {
    $check2 = $_REQUEST['check2'];
}
if (isset($_REQUEST['check3'] )) {
    $check3 = $_REQUEST['check3'];
}
//echo $check1.$check2.$check3;
//$check1=$check2=$check3 = "true";
//set empty events array
if ($rollenid == 2) {
    if ($check1 == "true") {
  //     echo 'sql1';
        $sql1 = 'SELECT * FROM aufgabe as a, benutzerereignis as be, benutzer as b
WHERE beginn <= "' . $date . ' 23:59:59" AND ende >= "' . $date . ' 00:00:00" AND a.aufgabeid = be.aufgabeid AND be.benutzerid = b.benutzerid ';

//SELECT * FROM aufgabe WHERE beginn >= "2020-01-27 00:00:00" AND ende <= "2020-01-27 23:59:59"
//echo $sql1;
        $sql_result1 = $conn->query($sql1);

        if ($sql_result1->num_rows > 0) {

            echo "<h2>" . "Aufgaben:" . "</h2>";
            while ($row = $sql_result1->fetch_assoc()) {
                $beginn = strtotime($row['beginn']);
                $beginn = date('d:m:yy:h:i', $beginn);
                $ende = strtotime($row['ende']);
                $ende = date('d:m:yy:h:i', $ende);
                echo "<h2>" . stripcslashes($row["bezeichnung"]) . " " . stripcslashes($row["beschreibung"]) . "</h2>";
                echo "<span>" . stripcslashes($row["vorname"]) . " " . stripcslashes($row["nachname"]) . "</span>";
                echo "<p>Von: " . $beginn . " Uhr  Bis: " . $ende . " Uhr</p>";

            }
        }
    }
    if ($check2 == "true") {
        $sql2 = 'SELECT * FROM meeting as m, benutzerereignis as be,  benutzer as b
WHERE beginn <= "' . $date . ' 23:59:59" AND ende >= "' . $date . ' 00:00:00" AND m.meetingid = be.meetingid AND be.benutzerid = b.benutzerid';
        $sql_result2 = $connection->query($sql2);

        if ($sql_result2->num_rows > 0) {
            // output data of each row
            echo "<h2>" . "Meetings:" . "</h2>";
            while ($row = $sql_result2->fetch_assoc()) {
                $beginn = strtotime($row['beginn']);
                $beginn = date('d:m:yy:h:i', $beginn);
                $ende = strtotime($row['ende']);
                $ende = date('d:m:yy:h:i', $ende);
                echo "<h2>" . stripcslashes($row["bezeichnung"]) . " " . stripcslashes($row["beschreibung"]) . "</h2>";
                echo "<span>" . stripcslashes($row["vorname"]) . " " . stripcslashes($row["nachname"]) . "</span>";
                echo "<p>Von: " . $beginn . " Uhr  Bis: " . $ende . " Uhr</p>";
            }
        }
    }
    if ($check3 == "true") {
        $sql3 = 'SELECT * FROM nichtverfugbarkeit as n, benutzerereignis as be, benutzer as b
 WHERE beginn <= "' . $date . ' 23:59:59" AND ende >= "' . $date . ' 00:00:00" AND n.nichtverfugbarkeitid = be.nichtverfugbarkeitid AND be.benutzerid = b.benutzerid ';
        $sql_result3 = $connection->query($sql3);

        if ($sql_result3->num_rows > 0) {
            // output data of each row
            echo "<h2>" . "Nichtverfugbarkeiten:" . "</h2>";
            while ($row = $sql_result3->fetch_assoc()) {
                $beginn = strtotime($row['beginn']);
                $beginn = date('d:m:yy:h:i', $beginn);
                $ende = strtotime($row['ende']);
                $ende = date('d:m:yy:h:i', $ende);
                echo "<h2>" . stripcslashes($row["bezeichnung"]) . " " . stripcslashes($row["beschreibung"]) . "</h2>";
                echo "<span>" . stripcslashes($row["vorname"]) . " " . stripcslashes($row["nachname"]) . "</span>";
                echo "<p>Von: " . $beginn . " Uhr  Bis: " . $ende . " Uhr</p>";
            }
        }
    }
}
if ($rollenid == 1) {
    if ($check1 == "true") {
        $sql4 = 'SELECT * FROM aufgabe as a, benutzerereignis as be, benutzer as b
WHERE beginn <= "' . $date . ' 23:59:59" AND ende >= "' . $date . ' 00:00:00" AND a.aufgabeid = be.aufgabeid AND be.benutzerid = b.benutzerid and b.benutzerid = "' . $benutzerid . '"';

//SELECT * FROM aufgabe WHERE beginn >= "2020-01-27 00:00:00" AND ende <= "2020-01-27 23:59:59"
//echo $sql1;
        $sql_result4 = $conn->query($sql4);

        if ($sql_result4->num_rows > 0) {
            // output data of each row
            echo "<h2>" . "Aufgaben:" . "</h2>";
            while ($row = $sql_result4->fetch_assoc()) {

                $beginn = strtotime($row['beginn']);
                $beginn = date('d:m:yy:h:i', $beginn);
                $ende = strtotime($row['ende']);
                $ende = date('d:m:yy:h:i', $ende);
                echo "<h2>" . stripcslashes($row["bezeichnung"]) . " " . stripcslashes($row["beschreibung"]) . "</h2>";
                echo "<span>" . stripcslashes($row["vorname"]) . " " . stripcslashes($row["nachname"]) . "</span>";
                echo "<p>Von: " . $beginn . " Uhr  Bis: " . $ende . " Uhr</p>";

            }
        }
    }
    if ($check2 == "true") {
        $sql5 = 'SELECT * FROM meeting as m, benutzerereignis as be,  benutzer as b
WHERE beginn <= "' . $date . ' 23:59:59" AND ende >= "' . $date . ' 00:00:00" AND m.meetingid = be.meetingid AND be.benutzerid = b.benutzerid and b.benutzerid = "' . $benutzerid . '"';
        $sql_result5 = $connection->query($sql5);

        if ($sql_result5->num_rows > 0) {
            // output data of each row
            echo "<h2>" . "Meetings:" . "</h2>";
            while ($row = $sql_result5->fetch_assoc()) {
                $beginn = strtotime($row['beginn']);
                $beginn = date('d:m:yy:h:i', $beginn);
                $ende = strtotime($row['ende']);
                $ende = date('d:m:yy:h:i', $ende);
                echo "<h2>" . stripcslashes($row["bezeichnung"]) . " " . stripcslashes($row["beschreibung"]) . "</h2>";
                echo "<span>" . stripcslashes($row["vorname"]) . " " . stripcslashes($row["nachname"]) . "</span>";
                echo "<p>Von: " . $beginn . " Uhr  Bis: " . $ende . " Uhr</p>";
            }
        }
    }
    if ($check3 == "true") {
        $sql6 = 'SELECT * FROM nichtverfugbarkeit as n, benutzerereignis as be, benutzer as b
 WHERE beginn <= "' . $date . ' 23:59:59" AND ende >= "' . $date . ' 00:00:00" AND n.nichtverfugbarkeitid = be.nichtverfugbarkeitid AND be.benutzerid =b.benutzerid and b.benutzerid = "' . $benutzerid . '"';

        $sql_result6 = $connection->query($sql6);

        if ($sql_result6->num_rows > 0) {
            // output data of each row
            echo "<h2>" . "Nichtverfugbarkeiten:" . "</h2>";
            while ($row = $sql_result6->fetch_assoc()) {
                $beginn = strtotime($row['beginn']);
                $beginn = date('d:m:yy:h:i', $beginn);
                $ende = strtotime($row['ende']);
                $ende = date('d:m:yy:h:i', $ende);
                echo "<h2>" . stripcslashes($row["bezeichnung"]) . " " . stripcslashes($row["beschreibung"]) . "</h2>";
                echo "<span>" . stripcslashes($row["vorname"]) . " " . stripcslashes($row["nachname"]) . "</span>";
                echo "<p>Von: " . $beginn . " Uhr  Bis: " . $ende . " Uhr</p>";
            }
        }
    }
}
?>