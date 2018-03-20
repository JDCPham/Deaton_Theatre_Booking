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

<div id="BookTheatreTitle">YOUR DETAILS</div>
<div id="BookTheatreSubTitle">IN ORDER TO PLACE YOUR BOOKING, WE NEED SOME OF YOUR PERSONAL DETAILS TO VERIFY WHO YOU ARE</div>
<div id="BookTheatreDateSelectionForm">

<?php

//MAIN PROGRAM//

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $Type = ($_POST["Type"]);
 $Title = ($_POST["Title"]);
 $FirstName = ($_POST["FirstName"]);
 $LastName = ($_POST["LastName"]);
 $DOB = ($_POST["DOB"]);
 $EMail = ($_POST["EMail"]);
 $Invalid = false;
 $ErrMsg = ErrorCheck($FirstName, $LastName, $EMail);
 
 if ($ErrMsg == "") {
	 $Invalid = false;
	 StoreToSession($FirstName, $LastName, $DOB, $EMail, $Type, $Title);
	 echo '<script type="text/javascript">
						 window.location = "booktheatre7.php"
						 </script>';	
 } else {
	 $Invalid = true;
 }
}


//CHECK FOR ERRORS//
function ErrorCheck($FirstName, $LastName, $EMail) {
 //MAKE SURE NO FIELDS ARE EMPTY//
 if (empty($FirstName)) {
	 $ErrMsg = "Field is blank, please fill in";
 } else {
	 if (empty($LastName)) {
		 $ErrMsg = "Field is blank, please fill in";
	 } else {
		 if (empty($EMail)) {
			 $ErrMsg = "Field is blank, please fill in";
		 } else {
			 //MAKE SURE NO INVALID CHARACTERS IN NAME FIELDS//
			 if (!preg_match("/^[a-zA-Z ]*$/",$FirstName)) {
	           $ErrMsg = "Invalid Characters in field.";
                } else {
	              if (!preg_match("/^[a-zA-Z ]*$/",$LastName)) {
		            $ErrMsg = "Invalid Characters in field.";
	                 } else {
		              //MAKE SURE EMAIL CONTAINS "@" and "."//
					  if (!filter_var($EMail, FILTER_VALIDATE_EMAIL)) {
                         $ErrMsg = "E-Mail Not Valid";
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
function StoreToSession($FirstName, $LastName, $DOB, $EMail, $Type, $Title) {
	$_SESSION["Type"] = $Type;
	$_SESSION["Title"] = $Title;
	$_SESSION["FirstName"] = $FirstName;
	$_SESSION["LastName"] = $LastName;
	$_SESSION["DOB"] = $DOB;
	$_SESSION["EMail"] = $EMail;
}





?>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div id="DetailInput">
  
  <span id="DetailInput2">
  
  <input type="radio" name="Type" value="Student" checked> Student
  <input type="radio" name="Type" value="Teacher"> Teacher<br>
  
  <input type="radio" name="Title" value="Mr" checked> Mr
  <input type="radio" name="Title" value="Mrs"> Mrs
  <input type="radio" name="Title" value="Ms"> Ms
  <input type="radio" name="Title" value="Miss"> Miss
  <input type="radio" name="Title" value="Dr"> Dr</span><br><br>

  First Name:<br><input type="text" name="FirstName" maxlength="20"><br><br>
  Last Name:<br><input type="text" name="LastName" maxlength="20"><br><br>
  Date Of Birth:<br><input type="date" name="DOB"><br><br>
  E-Mail Address:<br><input type="text" name="EMail"><br><br><br></div>
<span class="error"> <?php echo $ErrMsg;?></span><br>
  <input type="submit" value="Continue">

</form><br>

<span class="error"> <?php echo $TimeErr;?></span>




<div id="Footer">
<p>&copy; 2015 All Rights Reserved</p>
</div>

</body>
</html>
