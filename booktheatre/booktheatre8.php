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

<div id="BookTheatreTitle">CONFIRM YOUR BOOKING</div>
<div id="BookTheatreSubTitle">MAKE SURE ALL THE DETAILS ARE CORRECT, BEFORE BOOKING THE SLOT</div>
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
$Type = $_SESSION["Types"];
$Title = $_SESSION["Title"];
$FirstName = $_SESSION["FirstName"];
$LastName = $_SESSION["LastName"];
$DOB = $_SESSION["DOB"];
$EMail = $_SESSION["EMail"];



$NameConf = "Dear <b><span id='Pink'>".$Title." ".$FirstName." ".$LastName.",</span></b>";
$EMailConf = "Your E-Mail address is <b><span id='Pink'>".$EMail."</span></b>";
$DateConf = "You are booking to use the theatre on <b><span id='Pink'>".$Day."/".$Month."/".$Year."</span></b>";	
$TimeConf = "From <b><span id='Pink'>".$StartHour.":".$StartMinute." until ".$EndHour.":".$EndMinute."</span></b>";
$EventConf = "For the event titled <b><span id='Pink'>".$EventName."</span></b>";
$DescConf = "The description for the event is <b><span id='Pink'>".$EventDescription."</span></b>";
$TickConf = "<b><span id='Pink'>".$Tickets." </span></b>tickets will be sold";


$StandardDateTime = strtotime($Day."/".$Month."/".$Year." ".($StartHour+1).":".$StartMinute);



?>


<div id="SmallConf"> 
<?php echo $NameConf?><br>
<?php echo $EMailConf?><br>
<?php echo $DateConf?><br>
<?php echo $TimeConf?><br>
<?php echo $EventConf?><br>
<?php echo $DescConf?><br>
<?php echo $TickConf?><br>
</div>
<div id="BookTheatreConfirm">
<button onclick="NextPage()">Continue</button>
<button onclick="Restart()">Restart Process</button>
</div>

<div id="Footer">
<p>&copy; 2015 All Rights Reserved</p>
</div>

<script type="text/javascript">
  function NextPage() {
  window.location = "booktheatre9.php"
  }
  
  function Restart() {
  window.location = "booktheatre.php"
  }
</script>
</body>
</html>
