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

<div id="BookTheatreTitle">YOUR SELECTION</div>
<div id="BookTheatreSubTitle">PLEASE CHECK THE DETAILS YOU HAVE ENTERED</div>
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


$DateConfirmation = "<p>DATE: $Day/$Month/$Year</p>";
$StartTimeConfirmation = "<p>START: $StartHour:$StartMinute</p>";
$EndTimeConfirmation = "<p>END: $EndHour:$EndMinute</p>";	


$StandardDateTime = strtotime($Day."/".$Month."/".$Year." ".($StartHour+1).":".$StartMinute);



?>


<div id="BookTheatreConfirm"> 
<?php echo $DateConfirmation?>
<?php echo $StartTimeConfirmation?>
<?php echo $EndTimeConfirmation?>
<button onclick="NextPage()">Continue</button>
<button onclick="Restart()">Restart Process</button>
</div>

<div id="Footer">
<p>&copy; 2015 All Rights Reserved</p>
</div>

<script type="text/javascript">
  function NextPage() {
  window.location = "booktheatre5.php"
  }
  
  function Restart() {
  window.location = "booktheatre.php"
  }
</script>
</body>
</html>
