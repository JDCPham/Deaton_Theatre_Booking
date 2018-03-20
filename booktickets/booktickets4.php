<!DOCTYPE HTML>

<html>
<head>

<title>The Deaton Theatre - Book Tickets</title>
<link rel="stylesheet" type="text/css" href="../framework/css/style.css">	
<link rel="stylesheet" type="text/css" href="../framework/css/menu.css">
<script src='https://www.google.com/recaptcha/api.js'></script>	
</head>

<body style="overflow: visible;">

<div id='Menu'>
<ul>
<li><a href='../index.html'>Home</a></li>
<li><a href='../booktheatre/booktheatre.php'>Book Theatre</a></li>
<li><a href='booktickets.php'>Book Tickets</a></li>
<li><a href='../managetickets/managetickets.php'>Manage Tickets</a></li>
</ul>
</div>


<?php
//Enable Sessions
session_start();



$EventName = $_SESSION["EventName"];
$EventID = $_SESSION["EventID"];
$Title = $_SESSION["Title"];
$FirstName = $_SESSION["FirstName"];
$LastName = $_SESSION["LastName"];
$DOB = $_SESSION["DOB"];
$EMail = $_SESSION["EMail"];
$Phone = $_SESSION["Phone"];
$PostCode = $_SESSION["PostCode"];
$Date = $_SESSION["Date"];
$StartTime = $_SESSION["StartTime"];
$Venue = $_SESSION["Venue"];
$Price = $_SESSION["Price"];
$Interval = $_SESSION["Interval"];
$Notes = $_SESSION["Notes"];
$EMail = $_SESSION["EMail"];
$Child = $_SESSION["Child"];
$Adult = $_SESSION["Adult"];

$result = SQLQuery($EventID);

function SQLQuery($EventID) {
  //Declare Database Details
  $servername = "localhost:8889";
  $username = "root";
  $password = "root";
  $dbname = "deatontheatre";
  
  //Connect to Database
  if (($connection = mysql_connect($servername, $username, $password, $dbname)) === false) {
	  die("Could not connect to the database");
  }	  
  //Select Database
  if ((mysql_select_db($dbname, $connection)) === false) {
	  die("Could not access table on database");
  }
  
  //Prepare Database
  $SQLGetEvent = "SELECT `childprice`,`adultprice` FROM tblEvent WHERE event_id='".$EventID."'";
  
  //Execute Query
  $result = mysql_query($SQLGetEvent);
	if ($result === false) {
		die("Could not execute query");
  
	}
 return $result;
}

//Fetch result from database
while ($row = mysql_fetch_assoc($result)) {
  $ChildPrice = $row['childprice'];
  $AdultPrice = $row['adultprice'];
}

?>

<div id="EventTitle"><?php echo strtoupper($EventName)?></div>

<div id="EventDescription">
<span id="EventDescriptionLeft"><p>Date:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Date?></p></span><br>	

<span id="EventDescriptionLeft"><p>Venue:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Venue?></p></span><br>

<span id="EventDescriptionLeft"><p>Doors Open:</p></span>
<span id="EventDescriptionRight"><p><?php echo $StartTime?></p></span><br>

<span id="EventDescriptionLeft"><p>Price Range:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Price?></p></span><br>

<span id="EventDescriptionLeft"><p>Interval:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Interval?></p></span><br>

<span id="EventDescriptionLeft"><p>Notes:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Notes?></p></span><br>
</div>



<div id="CustomerDetails">
<span id="EventDescriptionLeft"><p>Name</p></span>
<span id="EventDescriptionRight"><p><?php echo ($Title." ".$FirstName." ".$LastName)?></p></span><br>	

<span id="EventDescriptionLeft"><p>DOB:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Venue?></p></span><br>

<span id="EventDescriptionLeft"><p>E-Mail:</p></span>
<span id="EventDescriptionRight"><p><?php echo $EMail?></p></span><br>

<span id="EventDescriptionLeft"><p>Phone Number:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Phone?></p></span><br>

<span id="EventDescriptionLeft"><p>Post Code:</p></span>
<span id="EventDescriptionRight"><p><?php echo $PostCode?></p></span><br>

</div>

<div id="TicketDetails">
<span id="EventDescriptionLeft"><p>Qty Child Tickets:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Child?></p></span><br>	

<span id="EventDescriptionLeft"><p>Qty Adult Tickets:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Adult?></p></span><br>

<span id="EventDescriptionLeft"><p>Total Child Tickets:</p></span>
<span id="EventDescriptionRight"><p><?php echo ("£".($ChildPrice*$Child))?></p></span><br>

<span id="EventDescriptionLeft"><p>Total Adult Tickets:</p></span>
<span id="EventDescriptionRight"><p><?php echo ("£".($AdultPrice*$Adult))?></p></span><br>

<span id="EventDescriptionLeft"><p>Total:</p></span>
<span id="EventDescriptionRight"><p><?php echo ("£".(($AdultPrice*$Adult)+($ChildPrice*$Child)))?></p></span><br>

</div>


<div id="BookTicketsConfirm">
<button onclick="FindTickets()">Confirm</button></div>
<div id="BookTicketsCancel">
<button onclick="Quit()">Cancel</button>
</div>

<div id="Footer">
<p>&copy; 2016 All Rights Reserved</p>
</div>

<script type="text/javascript">
  function FindTickets() {
  window.location = "booktickets5.php"
  }
  
  function Quit() {
  window.location = "booktickets.php"
  }
</script>

</body>
</html>
