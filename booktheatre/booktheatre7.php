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

<div id="BookTheatreTitle">EVENT DETAILS</div>
<div id="BookTheatreSubTitle">WE NEED SOME INFORMATION ABOUT THE EVENT OR REHEARSAL YOU'RE HOLDING IN THE THEATRE</div>
<div id="BookTheatreDateSelectionForm">

<?php

//MAIN PROGRAM//

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $EventName = ($_POST["EventName"]);
 $EventDescription = ($_POST["EventDescription"]);
 $Equipment = ($_POST["Equipment"]);
 $Tickets = ($_POST["Tickets"]);
 $ErrMsg = ErrorCheck($EventName, $EventDescription, $Equipment, $Tickets);
 $Invalid = false;
 
 if ($ErrMsg == "") {
	 $Invalid = false;
	 StoreToSession($EventName, $EventDescription, $Equipment, $Tickets);
	 echo '<script type="text/javascript">
						 window.location = "booktheatre8.php"
						 </script>';	
 } else {
	 $Invalid = true;
 }
}


//CHECK FOR ERRORS//
function ErrorCheck($EventName, $EventDescription, $Equipment, $Tickets) {
 //MAKE SURE NO FIELDS ARE EMPTY//
 if (empty($EventName)) {
	 $ErrMsg = "Field is blank, please fill in";
 } else {
	 if (empty($EventDescription)) {
		 $ErrMsg = "Field is blank, please fill in";
	 } else {
		 if (empty($Equipment)) {
			 $ErrMsg = "Field is blank, please fill in";
		 } else {
			 if (empty($Tickets)) {
			 $ErrMsg = "Field is blank, please fill in";
		    } else {
			 
			 //MAKE SURE TICKET FIELD ACCEPTS NUMERIC CHARACTERS ONLY/
			 if ((is_numeric($Tickets) == false)) {
	           $ErrMsg = "Invalid Characters in field.";
                } else {
					 if (($Tickets) > 365) {
			            $ErrMsg = "The Maximum Capacity of the theatre is 365";
		                  } else {
	                         $ErrMsg = "";
	 
                             }
                         }
	                 }
		        }
	      }
 }
 return $ErrMsg;
 }

//STORE DATA TO SESSION//
function StoreToSession($EventName, $EventDescription, $Equipment, $Tickets) {
	$_SESSION["EventName"] = $EventName;
	$_SESSION["EventDescription"] = $EventDescription;
	$_SESSION["Equipment"] = $Equipment;
	$_SESSION["Tickets"] = $Tickets;
}





?>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div id="DetailInput">
  

  
  

  Event Name:<br><input type="text" name="EventName" maxlength="20"><br><br>
  Event Descrption:<br><textarea name="EventDescription" rows="10" cols="30"></textarea><br><br>
  Equipment Required:<br><textarea name="Equipment" rows="10" cols="30"></textarea><br><br>
  If you are selling tickets, how many will be sold?<br><input type="text" name="Tickets"><br><br><br></div>
<span class="error"> <?php echo $ErrMsg;?></span><br>
  <input type="submit" value="Continue">

</form><br><br><br><br><br>

<span class="error"> <?php echo $TimeErr;?></span>




<div id="Footer">
<p>&copy; 2015 All Rights Reserved</p>
</div>

</body>
</html>
