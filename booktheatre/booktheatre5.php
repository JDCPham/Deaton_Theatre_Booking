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

<div id="BookTheatreTitle">BOOKING STATUS</div>
<div id="BookTheatreSubTitle">WE'RE CHECKING IF THAT SLOT IS AVAILABLE</div>
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
  

//GET CALENDAR FROM JSON FILE AND DECODE INTO PHP ARRAY//
   $File = file_get_contents("schedule.txt");
   $Schedule = json_decode($File);
   $Schedule = json_decode($File, true);
   $ElementCount = count($Schedule);
   echo ($Schedule[0]['name']);

//CONVERT USER INPUT (DATE & TIME) INTO STANDARD UNIX EPOCH FORMAT//
$StandardDateTime = strtotime("20".$Year."-".$Month."-".$Day."T".$StartHour.":".$StartMinute."+00:00");

//LINEAR SEARCH FOR OVERLAPS BETWEEN EXISTING EVENTS IN JSON CALENDAR, AND SELECTED TIME SLOT FOR BOOKING//
$SlotAvail = true;
for ($i = 0; $i <= $ElementCount; $i++) {
	if ((($StandardDateTime) >= ($Schedule[$i]['start'])) and (($StandardDateTime) <= ($Schedule[$i]['end']))){
	  $SlotInfo = "<span id='Red'>Sorry, this slot is not available. ".($Schedule[$i]['name'])." is taking place at that time.</span>";
	  $SlotAvail = false;
    } 
	
	if (($i == $ElementCount) and ($SlotAvail == true)) {
		$SlotAvail = true;
		$SlotInfo = "<span id='Green'>The slot is free! Click continue to proceed with the booking</span>";
	}
}


?>
<div id="BookTheatreSlot"> 
<?php echo $SlotInfo?>
</div>

<div id="BookTheatreConfirm"> 
<?php 
if ($SlotAvail == false){
  echo "<button onclick='Restart()'>Restart Process</button>";
  } elseif ($SlotAvail == true) {
	echo "<button onclick='NextPage()'>Continue</button>";
   }
   ?>
</div>

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
