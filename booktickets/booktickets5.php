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

$SeatingPlan = SQLQuery($EventID);

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
  $SQLCheckSeat = "SELECT `seat_id`,`childadult` FROM tblSeat WHERE event_id='".$EventID."'";
  
  //Execute Query
  $result = mysql_query($SQLCheckSeat);
	if ($result === false) {
		die("Could not execute query");
  
	}
 return $result;
}

//Fetch result from database
$FreeSeats = array("NULL");
while ($Record = mysql_fetch_assoc($SeatingPlan)) {
	if ($Record['childadult'] == "") {
      array_push($FreeSeats, $Record['seat_id']);
	}
}

	$Available = array();
	if (($Child + $Adult) == 1) {
		$SeatsFound == false;
	 for ($x = 1; $x <= 366; $x++) {
		 if ((($FreeSeats[$x]) != "NULL") and (($FreeSeats[$x]) != "")) {
			array_push($Available, $FreeSeats[$x]);
			$SeatsFound = true;
			break; 
		 } else {
			 $SeatsFound == false;
		 }
	 }
	}
	
	if (($Child + $Adult) == 2) {
		$SeatsFound == false;
	 for ($x = 1; $x <= 366; $x++) {
		 if ((($FreeSeats[$x]) != "NULL") and (($FreeSeats[$x]) != "") and (($FreeSeats[$x]) == ($FreeSeats[$x+1]-1))) {
			array_push($Available, $FreeSeats[$x]);
			array_push($Available, $FreeSeats[$x+1]);
			$SeatsFound = true;
			break; 
		 } else {
			 $SeatsFound == false;
		 }
	 }
	}
	
	if (($Child + $Adult) == 3) {
		$SeatsFound == false;
	 for ($x = 1; $x <= 366; $x++) {
		 if ((($FreeSeats[$x]) != "NULL") and (($FreeSeats[$x]) != "") and (($FreeSeats[$x]) == ($FreeSeats[$x+1]-1)) and (($FreeSeats[$x]) == ($FreeSeats[$x+2]-2))) {
			array_push($Available, $FreeSeats[$x]);
			array_push($Available, $FreeSeats[$x+1]);
			array_push($Available, $FreeSeats[$x+2]);
			$SeatsFound = true;
			break; 
		 } else {
			 $SeatsFound == false;
		 }
	 }
	}
	
	if (($Child + $Adult) == 4) {
		$SeatsFound == false;
	 for ($x = 1; $x <= 366; $x++) {
		 if ((($FreeSeats[$x]) != "NULL") and (($FreeSeats[$x]) != "") and (($FreeSeats[$x]) == ($FreeSeats[$x+1]-1)) and (($FreeSeats[$x]) == ($FreeSeats[$x+2]-2)) and (($FreeSeats[$x]) == ($FreeSeats[$x+3]-3))) {
			array_push($Available, $FreeSeats[$x]);
			array_push($Available, $FreeSeats[$x+1]);
			array_push($Available, $FreeSeats[$x+2]);
			array_push($Available, $FreeSeats[$x+3]);
			$SeatsFound = true;
			break; 
		 } else {
			 $SeatsFound == false;
		 }
	 }
	}
	
	if (($Child + $Adult) == 5) {
		$SeatsFound == false;
	 for ($x = 1; $x <= 366; $x++) {
		 if ((($FreeSeats[$x]) != "NULL") and (($FreeSeats[$x]) != "") and (($FreeSeats[$x]) == ($FreeSeats[$x+1]-1)) and (($FreeSeats[$x]) == ($FreeSeats[$x+2]-2)) and (($FreeSeats[$x]) == ($FreeSeats[$x+3]-3)) and (($FreeSeats[$x]) == ($FreeSeats[$x+4]-4))) {
			array_push($Available, $FreeSeats[$x]);
			array_push($Available, $FreeSeats[$x+1]);
			array_push($Available, $FreeSeats[$x+2]);
			array_push($Available, $FreeSeats[$x+3]);
			array_push($Available, $FreeSeats[$x+4]);
			$SeatsFound = true;
			break; 
		 } else {
			 $SeatsFound == false;
		 }
	 }
	}
	
	if (($Child + $Adult) == 6) {
		$SeatsFound == false;
	 for ($x = 1; $x <= 366; $x++) {
		 if ((($FreeSeats[$x]) != "NULL") and (($FreeSeats[$x]) != "") and (($FreeSeats[$x]) == ($FreeSeats[$x+1]-1)) and (($FreeSeats[$x]) == ($FreeSeats[$x+2]-2)) and (($FreeSeats[$x]) == ($FreeSeats[$x+3]-3)) and (($FreeSeats[$x]) == ($FreeSeats[$x+4]-4)) and (($FreeSeats[$x]) == ($FreeSeats[$x+5]-5))) {
			array_push($Available, $FreeSeats[$x]);
			array_push($Available, $FreeSeats[$x+1]);
			array_push($Available, $FreeSeats[$x+2]);
			array_push($Available, $FreeSeats[$x+3]);
			array_push($Available, $FreeSeats[$x+4]);
			array_push($Available, $FreeSeats[$x+5]);
			$SeatsFound = true;
			break; 
		 } else {
			 $SeatsFound == false;
		 }
	 }
	}



if ($SeatsFound == false) {
	echo "Sorry, There are no longer tickets for this event";
}

echo $Available[0];




//Prepare Database
  $SQLGetSeatNo = "SELECT `seat_id`,`tier`,`row`,`number` FROM tblSeat WHERE event_id='".$EventID."' and seat_id='".$Available[0]."'";
  
  //Execute Query
  $result2 = mysql_query($SQLGetSeatNo);
	if ($result2 === false) {
		die("Could not execute query");
  
	}

//Fetch result from database
while ($Record = mysql_fetch_assoc($SeatingPlan)) {

}

		
?>



<div id="Footer">
<p>&copy; 2016 All Rights Reserved</p>
</div>


</body>
</html>
