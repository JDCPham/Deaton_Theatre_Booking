<?php
// Start the session
session_start();
?>

<!DOCTYPE HTML>

<html>
<head>

<title>The Deaton Theatre - Book Tickets</title>
<link rel="stylesheet" type="text/css" href="../framework/css/style.css">	
<link rel="stylesheet" type="text/css" href="../framework/css/menu.css">	
</head>

<body style="overflow: visible;">

<div id='Menu'>
<ul>
<li><a href='../index.html'>Home</a></li>
<li><a href='booktheatre.php'>Book Theatre</a></li>
<li><a href='../booktickets/booktickets.php'>Book Tickets</a></li>
<li><a href='../managetickets/managetickets.php'>Manage Tickets</a></li>
</ul>
</div>

<div id="BookTheatreTitle">BOOKING</div>
<div id="BookTheatreSubTitle">HANG ON A SECOND, WE'RE SAVING YOUR BOOKING</div>
<div id="BookTheatreDateSelectionForm">

<?php

//MAIN PROGRAM//
$Day = $_SESSION["SelectedDay"];
$Month = $_SESSION["SelectedMonth"];
$Year = $_SESSION["SelectedYear"];
$StartHour = $_SESSION["StartHour"];
$StartMinute = $_SESSION["StartMinute"];
$EndHour = $_SESSION["EndHour"];
$EndMinute = $_SESSION["EndMinute"];
$EventName = $_SESSION["EventName"];
$EventDescription = $_SESSION["EventDescription"];
$Equipment = $_SESSION["Equipment"];
$Tickets = $_SESSION["Tickets"];
$Type = $_SESSION["Type"];
$Title = $_SESSION["Title"];
$FirstName = $_SESSION["FirstName"];
$LastName = $_SESSION["LastName"];
$DOB = $_SESSION["DOB"];
$EMail = $_SESSION["EMail"];

WriteToCalendar($EventName, $Day, $Month, $Year, $StartHour, $StartMinute, $EndHour, $EndMinute, $EventDescription, $Equipment, $Tickets, $Type, $Title, $FirstName, $LastName, $DOB, $EMail);


   
//APPEND DATE/TIME, EVENT DETAILS, ORGANISERS DETAILS TO ARRAY, AND WRITE TO FILE//
function WriteToCalendar($EventName, $Day, $Month, $Year, $StartHour, $StartMinute, $EndHour, $EndMinute, $EventDescription, $Equipment, $Tickets, $Type, $Title, $FirstName, $LastName, $DOB, $EMail) {
   $File = file_get_contents("schedule.txt");
   $Schedule = json_decode($File);
   $Schedule = json_decode($File, true);
   $ElementCount = count($Schedule);
   $Schedule[$ElementCount+1] = array("name" => $EventName, "start" => (strtotime("20".$Year."-".$Month."-".$Day."T".$StartHour.":".$StartMinute."+00:00")), "end" => (strtotime("20".$Year."-".$Month."-".$Day."T".$EndHour.":".$EndMinute."+00:00")), 'desc' => $EventDescription, 'equip' => $Equipment, 'tickets' => $Tickets, 'type' => $Type, 'title' => $Title, 'fname' => $FirstName, 'lname' => $LastName, 'dob' => (strtotime($DOB)), 'email' => $EMail);
   file_put_contents("schedule.txt", json_encode($Schedule));
   echo "<script type='text/javascript'>
         window.location = 'booktheatre10.php'</script>";
	
}


?>

<div id="Footer">
<p>&copy; 2015 All Rights Reserved</p>
</div>

<script type="text/javascript">
  function NextPage() {
  window.location = "booktheatre6.php"
  }
  
  function Restart() {
  window.location = "booktheatre.php"
  }
</script>
</body>
</html>
