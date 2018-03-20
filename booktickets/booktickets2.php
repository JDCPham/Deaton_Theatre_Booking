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
<li><a href='../booktheatre/booktheatre.php'>Book Theatre</a></li>
<li><a href='booktickets.php'>Book Tickets</a></li>
<li><a href='../managetickets/managetickets.php'>Manage Tickets</a></li>
</ul>
</div>


<?php
//Enable Sessions
session_start();

$EventName = ($_GET['eventname']);
$EventID = intval($_GET['eventid']);
$Venue = "Deaton Theatre, Forest School";
$result = SQLQuery($EventID);

function ErrorCheck($FirstName, $LastName, $DOB, $EMail, $EMail2, $PostCode, $Title, $Phone) {
	if ((empty($FirstName)) or (empty($LastName)) or (empty($DOB)) or (empty($EMail)) or (empty($EMail2)) or (empty($PostCode)) or (empty($Title)) or (empty($Phone))) {
		$ErrMsg = "A Field is blank, check form again";
	} else {
		if ((!preg_match("/^[a-zA-Z ]*$/",$FirstName)) or (!preg_match("/^[a-zA-Z ]*$/",$LastName))) {
	           $ErrMsg = "Invalid Characters in field.";
		} else {
			 if (!filter_var($EMail, FILTER_VALIDATE_EMAIL)) {
                         $ErrMsg = "E-Mail Not Valid";
			 } else {
				 if (($EMail) != ($EMail2)) {
					 $ErrMsg = "E-Mail not matching";
				 } else {
		         $ErrMsg = "";
	             }
	         }
	    }
	}
return $ErrMsg;
}

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
  $SQLGetEvent = "SELECT `name`,`date`,`start`,`childprice`,`adultprice`,`intermission`,`notes` FROM tblEvent WHERE event_id='".$EventID."'";
  
  //Execute Query
  $result = mysql_query($SQLGetEvent);
	if ($result === false) {
		die("Could not execute query");
  
	}
 return $result;
}

//Fetch result from database
while ($row = mysql_fetch_assoc($result)) {
  $Date = $row['date'];
  $StartTime = $row['start'];
  $Price = ("£".($row['childprice'])." Child, £".($row['adultprice'])." Adults");
  $Interval = $row['intermission'];
  $Notes = $row['notes'];
}

//STORE DATA TO SESSION//
function StoreToSession($FirstName, $LastName, $DOB, $EMail, $EMail2, $PostCode, $Title, $EventName, $EventID, $Venue, $Date, $StartTime, $Price, $Interval, $Notes, $Phone) {
	$_SESSION["FirstName"] = $FirstName;
	$_SESSION["LastName"] = $LastName;
	$_SESSION["DOB"] = $DOB;
	$_SESSION["EMail"] = $EMail;
	$_SESSION["PostCode"] = $PostCode;
	$_SESSION["Title"] = $Title;
	$_SESSION["EventName"] = $EventName;
	$_SESSION["EventID"] = $EventID;
	$_SESSION["Venue"] = $Venue;
	$_SESSION["Date"] = $Date;
	$_SESSION["StartTime"] = $StartTime;
	$_SESSION["Price"] = $Price;
	$_SESSION["Interval"] = $Interval;
	$_SESSION["Notes"] = $Notes;
	$_SESSION["Phone"] = $Phone;

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 $FirstName = ($_POST['ForeName']);
 $LastName = ($_POST['LastName']);
 $DOB = ($_POST['DOB']);
 $EMail = ($_POST['Email']);
 $EMail2 = ($_POST['Email2']);
 $PostCode = ($_POST['PostCode']);
 $Title = ($_POST['Title']);
 $Phone = ($_POST['Phone']);
 $Invalid = false;
 $ErrMsg = ErrorCheck($FirstName, $LastName, $DOB, $EMail, $EMail2, $PostCode, $Title, $Phone);
 
 if ($ErrMsg == "") {
	 $Invalid = false;
	 StoreToSession($FirstName, $LastName, $DOB, $EMail, $EMail2, $PostCode, $Title, $EventName, $EventID, $Venue, $Date, $StartTime, $Price, $Interval, $Notes, $Phone);
	 echo '<script type="text/javascript">
						 window.location = "booktickets3.php"
						 </script>';	
 } else {
	 $Invalid = true;
 }
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

<div id="Form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?eventname=<?php echo $EventName?>&eventid=<?php echo $EventID?>"
<span id="TicketFormLabel"><span id="FormRadio">
<input type="radio" name="Title" value="Miss">Miss 
<input type="radio" name="Title" value="Mrs">Mrs 
<input type="radio" name="Title" value="Mr">Mr 
<input type="radio" name="Title" value="Dr">Dr 
<input type="radio" name="Title" value="Other">Other
</span></span>
<br><br>

<span id="TicketFormLabel"><p>First Name</p></span><input type="text" name="ForeName">
<span id="TicketFormLabel"><p>Last Name</p></span><input type="text" name="LastName"><span class="error">* <?php echo $LastNameErr;?></span>
<span id="TicketFormLabel"><p>Date of Birth:</p><input type="date" name="DOB"><span class="error">* <?php echo $DOBErr;?></span><br>
<span id="TicketFormLabel"><p>E-Mail Address</p></span><input type="text" name="Email" size="35"><span class="error">* <?php echo $FirstNameErr;?></span>
<span id="TicketFormLabel"><p>Confirm E-Mail Address</p></span><input type="text" name="Email2" size="35"><span class="error">* <?php echo $FirstNameErr;?></span><br>
<span id="TicketFormLabel"><p>Phone Number</p></span><input type="text" name="Phone"><br>
<span id="TicketFormLabel"><p>Postcode</p></span><input type="text" name="PostCode" size="10"><span class="error">* <?php echo $LastNameErr;?></span><br><br>
<span class="error"> <?php echo $ErrMsg;?></span><br><br>
<input type="submit" name="submit" value="Submit"> 

</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="Footer">
<p>&copy; 2016 All Rights Reserved</p>
</div>

</body>
</html>
