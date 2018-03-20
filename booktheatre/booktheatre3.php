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

<div id="BookTheatreTitle">SELECT END TIME</div>
<div id="BookTheatreSubTitle">CHOOSE THE TIME YOU'D LIKE TO BOOK THE THEATRE FOR. THE THEATRE IS CLOSED BEFORE 06:00 AND AFTER 22:00. YOU MUST ENTER THE TIME IN THE FORMAT HH:MM (24HR)</div>
<div id="BookTheatreDateSelectionForm">

<?php

//MAIN PROGRAM//
$Invalid = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $HourNow = GrabHour($CurrentHour);
  $MinuteNow = GrabMinute($CurrentMinute);
  $DayNow = GrabDay($CurrentDay);
  $MonthNow = GrabMonth($CurrentMonth);
  $YearNow = GrabYear($YearNow);
  $SelectedHour = ($_POST["Hour"]);
  $SelectedMinute = ($_POST["Minute"]);
  $SelectedDay = ($_SESSION["SelectedDay"]);
  $SelectedMonth = ($_SESSION["SelectedMonth"]);
  $SelectedYear = ($_SESSION["SelectedYear"]);
  $StartHour = ($_SESSION["StartHour"]);
  $StartMinute = ($_SESSION["StartMinute"]);
   
  if (CheckIfBlank($SelectedHour, $SelectedMinute) == true) {
	  $TimeErr = "Fields must not be left blank";
      } else { 
              if (CheckTimeValid($SelectedHour, $SelectedMinute, $SelectedDay, $SelectedMonth, $SelectedYear, $HourNow, $MinuteNow, $DayNow, $MonthNow, $YearNow) == true) {
		         $TimeErr = "Invalid Time"; 
	             } else {
	                     if (CheckTimeNotBeforeStart ($SelectedHour, $StartHour) == true) {
							 $TimeErr = "Time in the past"; 
						 } else {
						   $EndHour = ($_POST["Hour"]);
	                       $EndMinute = ($_POST["Minute"]);
						   StoreToSession($EndHour, $EndMinute);
						   echo '<script type="text/javascript">
						   window.location = "booktheatre4.php"
						   </script>';	
				 }	
	  }
  }
}

//CHECK TIME NOT BEFORE START//
function CheckTimeNotBeforeStart ($SelectedHour, $StartHour) {
	if ($SelectedHour <= $StartHour) {
		$Invalid = true;
	} else {
		$Invalid = false;
	}
	
	return $Invalid;
}


//CHECK IF TIME IS VALID//
function CheckTimeValid ($SelectedHour, $SelectedMinute, $SelectedDay, $SelectedMonth, $SelectedYear, $HourNow, $MinuteNow, $DayNow, $MonthNow, $YearNow) {
 if ((($SelectedHour) <= ($HourNow)) and (($SelectedDay) == ($DayNow)) and (($SelectedMonth) == ($MonthNow)) and (($SelectedYear) == ($YearNow))) { 
	if (($SelectedMinute) < ($MinuteNow)) {
	   $Invalid = true;
	   } else {
			   $Invalid = false;
	          }
	} else {
		    if (($SelectedHour >= 22) or ($SelectedHour <= 6)) {
				$Invalid = true; 
			} else {
				$Invalid = false;
			}
	}		
	if ((($SelectedHour) > 24) or (($SelectedMinute) > 59)) {
	$Invalid = true; 
 }
 
  if ((strlen($SelectedHour) != 2) or (strlen($SelectedMinute) != 2)) {
	 $Invalid = true;}
 return $Invalid;
 }
	

//CHECK IF FIELDS BLANK//
function CheckIfBlank($SelectedHour, $SelectedMinute) {
	if ((empty($SelectedHour)) or (empty($SelectedMinute))) {
	$Invalid = true;
  } else {
	$Invalid = false;
  } 
  return $Invalid;
}


// STORE DATA TO TEMPORARY SESSION//
function StoreToSession($EndHour, $EndMinute) {
	$_SESSION["EndHour"] = $EndHour;
	$_SESSION["EndMinute"] = $EndMinute;
	}

//FIND CURRENT HOUR//
function GrabHour($CurrentHour) {
	date_default_timezone_set('Europe/London');
	$CurrentHour = date("H");
	if (substr($CurrentHour, 0, 1) == 0) {
	  $CurrentHour = substr($CurrentHour, 1, 1); }
	return $CurrentHour;
}

//FIND CURRENT MINUTE//
function GrabMinute($CurrentMin) {
	date_default_timezone_set('Europe/London');
	$CurrentMin = date("i");
	if (substr($CurrentMin, 0, 1) == 0) {
	  $CurrentMin = substr($CurrentMin, 1, 1); }
	return $CurrentMin;
}

//FINDS CURRENT DAY AND REMOVES "0" IF DAY VALUE IS LESS THAN 10//
function GrabDay($CurrentDay) {
	date_default_timezone_set('Europe/London');
	$CurrentDay = date("d");
	if (substr($CurrentDay, 0, 1) == 0) {
		$CurrentDay = substr($CurrentDay, 1, 1); 
	} else {
		$CurrentDay == $CurrentDay; }
		return $CurrentDay; 
}

//FINDS CURRENT MONTH AND REMOVES "0" IF MONTH VALUE IS LESS THAN 10//
function GrabMonth($CurrentMonth) {
	date_default_timezone_set('Europe/London');
	$CurrentMonth = date("m");
	if (substr($CurrentMonth, 0, 1) == 0) {
		$CurrentMonth = substr($CurrentMonth, 1, 1); 
	} else {
		$CurrentMonth == $CurrentMonth; }
		return $CurrentMonth; 
}

//FINDS CURRENT YEAR//
function GrabYear($CurrentYear) {
	date_default_timezone_set('Europe/London');
	$CurrentYear = date("y");
		return $CurrentYear; 
}


GrabHour($CurrentHour);
GrabMinute($CurrentMin);

?>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div id="TimeInput"><input type="text" name="Hour" maxlength="2">:<input type="text" name="Minute" maxlength="2"></div>
<input type="submit" value="Next step">
</form><br>
<span class="error"> <?php echo $TimeErr;?></span>



<div id="Footer">
<p>&copy; 2015 All Rights Reserved</p>
</div>

</body>
</html>
