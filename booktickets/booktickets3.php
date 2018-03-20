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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 $Child = ($_POST['Child']);
 $Adult = ($_POST['Adult']);
 $Invalid = false;
 $ErrMsg = ErrorCheck($Child, $Adult);
 
 if ($ErrMsg == "") {
	 $Invalid = false;
	 StoreToSession($Child, $Adult);
	 echo '<script type="text/javascript">
						 window.location = "booktickets4.php"
						 </script>';	
 } else {
	 $Invalid = true;
 }
}

function ErrorCheck($Child, $Adult) {
	if ($Adult == 0)  {
		$ErrMsg = "You must purchase at least one adult ticket";
	} else {
		$ErrMsg = "";
	}
return $ErrMsg;
}

function StoreToSession($Child, $Adult) {
	$_SESSION["Child"] = $Child;
	$_SESSION["Adult"] = $Adult;

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
<span id="EventDescriptionRight"><p><?php echo $DOB?></p></span><br>

<span id="EventDescriptionLeft"><p>E-Mail:</p></span>
<span id="EventDescriptionRight"><p><?php echo $EMail?></p></span><br>

<span id="EventDescriptionLeft"><p>Phone Number:</p></span>
<span id="EventDescriptionRight"><p><?php echo $Phone?></p></span><br>

<span id="EventDescriptionLeft"><p>Post Code:</p></span>
<span id="EventDescriptionRight"><p><?php echo $PostCode?></p></span><br>

</div>

<div id="Form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<span id="TicketFormLabel"><p>Child Tickets</p></span>
<select name="Child">
  <option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
</select>

<span id="TicketFormLabel"><p>Adult Tickets</p></span>
<select name="Adult">
  <option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
</select>

<br><br><span class="error"> <?php echo $ErrMsg;?></span><br><br><br>

<input type="submit" name="submit" value="Submit"> 

</form>
<div id="Footer">
<p>&copy; 2016 All Rights Reserved</p>
</div>

</body>
</html>
