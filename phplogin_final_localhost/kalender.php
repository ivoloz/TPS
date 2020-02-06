<?php

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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="de" xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kalender</title>
<link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="calendar.css" rel="stylesheet" type="text/css" />
</head>
<body>

<nav class="navtop">
    <div>
        <a href="home.php"><i class="fa fa-home fa-fw"></i>Übersicht</a>
        <a href="kalender.php"><i class="fa fa-calendar"></i>Kalender</a>
        <a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-user-circle"></i>Arbeitszeiten</a>
        <a href="nichtverfugbarkeitausgabe.php"><i class="fa fa-thumbs-down"></i>Nicht-Verfügbarkeit</a>
        <a href="aufgabeausgabe.php"><i class="fa fa-tasks"></i>Aufgaben</a>
        <a href="meetingausgabe.php"><i class="fa fa-user-circle"></i>Meetings</a>
        <a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
    </div>
</nav>
<?php if ($rollenid == 2) {?>
<form class="formular">
    <input class="checkbox" type="checkbox" name="check1" value="Ja" >Aufgaben
    <input class="checkbox" type="checkbox" name="check2" value="Ja" >Meetings
    <input class="checkbox" type="checkbox" name="check3" value="Ja" >Nichtverfugbarkeiten
    <select id="auswahl" name="auswahl" size="1">

        <?php
        include 'crud.php';
        $sql = "SELECT benutzerid ,email FROM `benutzer` where rollenid=1";
        $result = selectdata($sql);
        if($result != "zero")
        {

            while($row = $result->fetch_assoc()){

                echo "<option  value=".$row['benutzerid']."> ".$row['email']."</option>";
            }
        }

        ?>
    </select>Mitarbeiterauswahl


<input type="button" name="formSubmit" value="Filter anwenden" onclick="submitForm()" >
</form>
<div id="Calendar"> </div>
<div id="Events"> </div>

<script language="javascript" src="calendar.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    function submitForm() {
        var form = document.querySelectorAll(".checkbox");

        //var dataString = [form[0].checked,form[1].checked,form[2].checked,];
        var x=document.getElementById("auswahl");

        for (var i = 0; i < x.options.length; i++) {
            if(x.options[i].selected ==true){
               var bid = x.options[i].value;
            }
        }

        var monthBox = document.querySelector(".cMonth").innerHTML;
        var month = monthBox.split(" ")[0];
        var year = monthBox.split(" ")[1];
        switch (monthBox.split(" ")[0]) {
            case "Januar":
                month = "01";
                break;
            case "Februar":
                month = "02";
                break;
            case "März":
                month = "03";
                break;
            case "April":
                month = "04";
                break;
            case "Mai":
                month = "05";
                break;
            case "Juni":
                month = "06";
                break;
            case "Juli":
                month = "07";
                break;
            case "August":
                month = "08";
                break;
            case "September":
                month = "09";
                break;
            case "Oktober":
                month = "10";
                break;
            case "November":
                month = "11";
                break;
            case "Dezember":
                month = "12";
                break;
            case "January":
                month = "01";
                break;
            case "February":
                month = "02";
                break;
            case "March":
                month = "03";
                break;
            case "May":
                month = "05";
                break;
            case "June":
                month = "06";
                break;
            case "July":
                month = "07";
                break;
            case "October":
                month = "10";
                break;
            case "December":
                month = "12";
                break;
            default:
                month = "01";
                break;
        }

        var dataObject = {
            check1: form[0].checked,
            check2: form[1].checked,
            check3: form[2].checked,
            month: month,
            year: year,
            bid: bid
        }
        console.log(dataObject);
        $.ajax({
            type: 'POST',
            url: 'calendar.php',
            data: dataObject,
            success: function (data) {
                $('#myResponse').html(data);
                console.log(data);
                document.querySelector("#Calendar").innerHTML = data;
   //            submitEvents();
            }

        });

        return false;
    }

</script>
<?php }else { ?>
    <form class="formular">
    <input class="checkbox" type="checkbox" name="check1" value="Ja" >Aufgaben
    <input class="checkbox" type="checkbox" name="check2" value="Ja" >Meetings
    <input class="checkbox" type="checkbox" name="check3" value="Ja" >Nichtverfugbarkeiten



<input type="button" name="formSubmit" value="Filter anwenden" onclick="submitForm()" >
</form>
<div id="Calendar"> </div>
<div id="Events"> </div>

<script language="javascript" src="calendar.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    function submitForm() {
        var form = document.querySelectorAll(".checkbox");

        //var dataString = [form[0].checked,form[1].checked,form[2].checked,];


        var monthBox = document.querySelector(".cMonth").innerHTML;
        var month = monthBox.split(" ")[0];
        var year = monthBox.split(" ")[1];
        switch (monthBox.split(" ")[0]) {
            case "Januar":
                month = "01";
                break;
            case "Februar":
                month = "02";
                break;
            case "März":
                month = "03";
                break;
            case "April":
                month = "04";
                break;
            case "Mai":
                month = "05";
                break;
            case "Juni":
                month = "06";
                break;
            case "Juli":
                month = "07";
                break;
            case "August":
                month = "08";
                break;
            case "September":
                month = "09";
                break;
            case "Oktober":
                month = "10";
                break;
            case "November":
                month = "11";
                break;
            case "Dezember":
                month = "12";
                break;
            case "January":
                month = "01";
                break;
            case "February":
                month = "02";
                break;
            case "March":
                month = "03";
                break;
            case "May":
                month = "05";
                break;
            case "June":
                month = "06";
                break;
            case "July":
                month = "07";
                break;
            case "October":
                month = "10";
                break;
            case "December":
                month = "12";
                break;
            default:
                month = "01";
                break;
        }

        var dataObject = {
            check1: form[0].checked,
            check2: form[1].checked,
            check3: form[2].checked,
            month: month,
            year: year
        }
        console.log(dataObject);
        $.ajax({
            type: 'POST',
            url: 'calendar.php',
            data: dataObject,
            success: function (data) {
                $('#myResponse').html(data);
                console.log(data);
                document.querySelector("#Calendar").innerHTML = data;
                //            submitEvents();
            }

        });

        return false;
    }

</script>
<?php } ?>
</body>
</html>
