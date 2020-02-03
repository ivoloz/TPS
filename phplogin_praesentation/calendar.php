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
date_default_timezone_set("Europe/Berlin");
setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
//error_reporting(0);
include("db_connection.php");
$conn = OpenCon();
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit();
}
// If the user logs in first time or has not changed his password redirect to the password page...
if (!isset($_SESSION['abfrage'])) {
	header('Location: passwort.html');
	exit();
}


$benutzerid = $_SESSION["id"];

$rollenid = $_SESSION["rollenid"];
//set empty events array
$events = array();

/// get current month and year and store them in $cMonth and $cYear variables
(intval($_REQUEST["month"])>0) ? $cMonth = intval($_REQUEST["month"]) : $cMonth = date("m");
(intval($_REQUEST["year"])>0) ? $cYear = intval($_REQUEST["year"]) : $cYear = date("Y");

if(strlen($cMonth)<2) {
    $cMonth = "0".$cMonth;
}
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
if ($rollenid == 2) {
    if ($check1 == "true") {
// generate an array with all dates with events
        $sql1 = "SELECT aufgabeid, DATE(beginn) as beginn, DATE(ende) as ende, bezeichnung, beschreibung, status, prioritaet FROM aufgabe WHERE beginn LIKE '" . $cYear . "-" . $cMonth . "-%' AND ende LIKE '" . $cYear . "-" . $cMonth . "-%'";

        $sql_result1 = $conn->query($sql1);
        if ($sql_result1->num_rows > 0) {
// output data of each row
            while ($row = $sql_result1->fetch_assoc()) {
                $ende = strtotime($row['ende']);
                $beginn = strtotime($row['beginn']);

                //      echo '###'.$row['beginn'];

                $lDay1 = date('d', $beginn);
                $lDay2 = date('d', $ende);
                $dauer = 1;
                $dauer += $lDay2 - $lDay1;

                for ($i = 1; $i <= $dauer; $i++) {
                    if (strlen($lDay1) <= 1) {
                        $lDay1 = '0' . $lDay1;
                    }
                    $date = date('yy', $beginn) . "-" . date('m', $beginn) . "-" . $lDay1;


//          echo 'AAA'.$date;
                    $events[$date]["bezeichnung"] = $row["bezeichnung"];
                    $events[$date]["beschreibung"] = $row["beschreibung"];
                    $lDay1++;
                }
            }
        }
    }
    if ($check2 == "true") {
        $sql2 = "SELECT meetingid, DATE(beginn) as beginn, DATE(ende) as ende, bezeichnung, beschreibung FROM meeting WHERE beginn LIKE '" . $cYear . "-" . $cMonth . "-%' AND ende LIKE '" . $cYear . "-" . $cMonth . "-%'";
        $sql_result2 = $conn->query($sql2);
//echo $sql2;
        if ($sql_result2->num_rows > 0) {
// output data of each row
            while ($row = $sql_result2->fetch_assoc()) {
                $ende = strtotime($row['ende']);
                $beginn = strtotime($row['beginn']);

                //       echo '###'.$row['beginn'];

                $lDay1 = date('d', $beginn);
                $lDay2 = date('d', $ende);
                $dauer = 1;
                $dauer += $lDay2 - $lDay1;

                for ($i = 1; $i <= $dauer; $i++) {
                    if (strlen($lDay1) <= 1) {
                        $lDay1 = '0' . $lDay1;
                    }
                    $date = date('yy', $beginn) . "-" . date('m', $beginn) . "-" . $lDay1;


                    //           echo 'AAA'.$date;
                    $events[$date]["bezeichnung"] = $row["bezeichnung"];
                    $events[$date]["beschreibung"] = $row["beschreibung"];
                    $lDay1++;
                }
            }
        }
    }
    if ($check3 == "true") {
        $sql3 = "SELECT nichtverfugbarkeitid, DATE(beginn) as beginn, DATE(ende) as ende, bezeichnung, beschreibung FROM nichtverfugbarkeit WHERE beginn LIKE '" . $cYear . "-" . $cMonth . "-%' AND ende LIKE '" . $cYear . "-" . $cMonth . "-%'";
        $sql_result3 = $conn->query($sql3);
        if ($sql_result3->num_rows > 0) {
// output data of each row
            while ($row = $sql_result3->fetch_assoc()) {
                $ende = strtotime($row['ende']);
                $beginn = strtotime($row['beginn']);

                //       echo '###'.$row['beginn'];

                $lDay1 = date('d', $beginn);
                $lDay2 = date('d', $ende);
                $dauer = 1;
                $dauer += $lDay2 - $lDay1;

                for ($i = 1; $i <= $dauer; $i++) {
                    if (strlen($lDay1) <= 1) {
                        $lDay1 = '0' . $lDay1;
                    }
                    $date = date('yy', $beginn) . "-" . date('m', $beginn) . "-" . $lDay1;


//            echo 'AAA'.$date;
                    $events[$date]["bezeichnung"] = $row["bezeichnung"];
                    $events[$date]["beschreibung"] = $row["beschreibung"];
                    $lDay1++;
                }
            }
        }
    }
}
if ($rollenid == 1){
    if ($check1 == "true"){
    // generate an array with all dates with events
    $sql4 = "SELECT Date(beginn) as beginn, DATE(ende) as ende, bezeichnung, beschreibung FROM aufgabe as a, benutzerereignis as be WHERE beginn LIKE '" . $cYear . "-" . $cMonth . "-%' AND ende LIKE '" . $cYear . "-" . $cMonth . "-%' AND a.aufgabeid = be.aufgabeid AND be.benutzerid  = '$benutzerid'";
    $sql_result4 = $conn->query($sql4);
    if ($sql_result4->num_rows > 0) {
// output data of each row
        while ($row = $sql_result4->fetch_assoc()) {
            $ende = strtotime($row['ende']);
            $beginn = strtotime($row['beginn']);

            //      echo '###'.$row['beginn'];

            $lDay1 = date('d', $beginn);
            $lDay2 = date('d', $ende);
            $dauer = 1;
            $dauer += $lDay2 - $lDay1;

            for ($i = 1; $i <= $dauer; $i++) {
                if (strlen($lDay1) <= 1) {
                    $lDay1 = '0' . $lDay1;
                }
               $date = date('yy', $beginn) . "-" . date('m', $beginn) . "-" . $lDay1;
 //               $date = $cYear. "-" .$cMonth. "-" . $lDay1;
//          echo 'AAA'.$date;
                $events[$date]["bezeichnung"] = $row["bezeichnung"];
                $events[$date]["beschreibung"] = $row["beschreibung"];
                $lDay1++;
            }
        }
    }
}
    if($check2 == "true") {
        $sql5 = "SELECT Date(beginn) as beginn, DATE(ende) as ende, bezeichnung, beschreibung FROM meeting as m, benutzerereignis as be WHERE beginn LIKE '" . $cYear . "-" . $cMonth . "-%' AND ende LIKE '" . $cYear . "-" . $cMonth . "-%' AND m.meetingid = be.meetingid AND be.benutzerid = '$benutzerid'";
        $sql_result5 = $conn->query($sql5);
//echo $sql2;

        if ($sql_result5->num_rows > 0) {
// output data of each row
            while ($row = $sql_result5->fetch_assoc()) {
                $ende = strtotime($row['ende']);
                $beginn = strtotime($row['beginn']);

                //       echo '###'.$row['beginn'];

                $lDay1 = date('d', $beginn);
                $lDay2 = date('d', $ende);
                $dauer = 1;
                $dauer += $lDay2 - $lDay1;

                for ($i = 1; $i <= $dauer; $i++) {
                    if (strlen($lDay1) <= 1) {
                        $lDay1 = '0' . $lDay1;
                    }
                    $date = date('yy', $beginn) . "-" . date('m', $beginn) . "-" . $lDay1;
                    //               $date = $cYear. "-" .$cMonth. "-" . $lDay1;
                    //               echo 'datum: '.$date;
                    //           echo 'AAA'.$date;
                    $events[$date]["bezeichnung"] = $row["bezeichnung"];
                    $events[$date]["beschreibung"] = $row["beschreibung"];
                    $lDay1++;
                }
            }
        }
    }
    if ($check3 == "true") {
        $sql6 = "SELECT Date(beginn) as beginn, DATE(ende) as ende, bezeichnung, beschreibung FROM nichtverfugbarkeit as nv, benutzerereignis as be WHERE beginn LIKE '" . $cYear . "-" . $cMonth . "-%' AND ende LIKE '" . $cYear . "-" . $cMonth . "-%' AND nv.nichtverfugbarkeitid = be.nichtverfugbarkeitid AND be.benutzerid = '$benutzerid'";
        $sql_result6 = $conn->query($sql6);
        if ($sql_result6->num_rows > 0) {
// output data of each row
            while ($row = $sql_result6->fetch_assoc()) {
                $ende = strtotime($row['ende']);
                $beginn = strtotime($row['beginn']);

                //       echo '###'.$row['beginn'];

                $lDay1 = date('d', $beginn);
                $lDay2 = date('d', $ende);
                $dauer = 1;
                $dauer += $lDay2 - $lDay1;

                for ($i = 1; $i <= $dauer; $i++) {
                    if (strlen($lDay1) <= 1) {
                        $lDay1 = '0' . $lDay1;
                    }
                    $date = date('yy', $beginn) . "-" . date('m', $beginn) . "-" . $lDay1;
                    //               $date = $cYear. "-" .$cMonth. "-" . $lDay1;

//            echo 'AAA'.$date;
                    $events[$date]["bezeichnung"] = $row["bezeichnung"];
                    $events[$date]["beschreibung"] = $row["beschreibung"];
                    $lDay1++;
                }
            }
        }
    }
}
// calculate next and prev month and year used for next / prev month navigation links and store them in respective variables
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = intval($cMonth) - 1;
$next_month = intval($cMonth) + 1;

// if current month is December or January month navigation links have to be updated to point to next / prev years
if ($cMonth == "12") {
    $next_month = "01";
    $next_year = $cYear + 1;
} elseif ($cMonth == "01") {
    $prev_month = "12";
    $prev_year = $cYear - 1;
}

if ($prev_month < 10) $prev_month = '0' . $prev_month;
if ($next_month < 10) $next_month = '0' . $next_month;
?>

<table width="100%">
    <tr>
        <td class="mNav"><a href="javascript:LoadMonth('<?php echo $prev_month; ?>', '<?php echo $prev_year; ?>')">&lt;&lt;</a>
        </td>
        <td colspan="5" class="cMonth" ><?php setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge'); echo strftime("%B %Y ",strtotime($cYear . "-" . $cMonth . "-01")); ?></td>
        <td class="mNav"><a href="javascript:LoadMonth('<?php echo $next_month; ?>', '<?php echo $next_year; ?>')">&gt;&gt;</a>
        </td>
    </tr>
    <tr>
        <td class="wDays">Montag</td>
        <td class="wDays">Dienstag</td>
        <td class="wDays">Mittwoch</td>
        <td class="wDays">Donnerstag</td>
        <td class="wDays">Freitag</td>
        <td class="wDays">Samstag</td>
        <td class="wDays">Sonntag</td>
    </tr>
    <?php
    $first_day_timestamp = mktime(0, 0, 0, $cMonth, 1, $cYear); // time stamp for first day of the month used to calculate
    $maxday = date("t", $first_day_timestamp); // number of days in current month
    $thismonth = getdate($first_day_timestamp); // find out which day of the week the first date of the month is
    $startday = $thismonth['wday'] - 1; // 0 is for Sunday and as we want week to start on Mon we subtract 1

    for ($i = 0; $i < ($maxday + $startday); $i++) {

        if (($i % 7) == 0) echo "<tr>";

        if ($i < $startday) {
            echo "<td>&nbsp;</td>";
            continue;
        };

        $current_day = $i - $startday + 1;
        if ($current_day < 10) $current_day = '0' . $current_day;

// set css class name based on number of events for that day
        if (array_key_exists($cYear . "-" . $cMonth . "-" . $current_day, $events)) {
            $css = 'withevent';
        //    $click = "onclick=\"LoadEvents('" . $cYear . "-" . $cMonth . "-" . $current_day . "')\"";
            $click = "onclick=\"LoadEvents('" . $cYear . "-" . $cMonth . "-" . $current_day . "', $check1, $check2, $check3)\"";

        } else {
            $css = 'noevent';
            $click = '';
        }

        echo "<td class='" . $css . "'" . $click . ">" . $current_day . "</td>";

        if (($i % 7) == 6) echo "</tr>";
    }

?>
  </table>
