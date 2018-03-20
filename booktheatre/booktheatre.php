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

<div id="BookTheatreTitle">SELECT DATE</div>
<div id="BookTheatreSubTitle">CHOOSE THE DATE YOU'D LIKE TO BOOK THE THEATRE FOR</div>

<?php
// Enable Sessions
session_start();

// Main program
$Day = $Month = $Year = "";
$DayErr = $MonthErr = $YearErr = "";
$CurrentDay = $CurrentMonth = $CurrentYear = "";
$Invalid = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $YearNow = GrabYear($CurrentYear);
 
  if (($_POST["Year"]) < ($YearNow)) {
    $DateErr = "Invalid Date";
	$Invalid = true;
  } elseif (($_POST["Year"]) == ($YearNow)) {
	        
			$MonthNow = GrabMonth($CurrentMonth);
            if (($_POST["Month"]) < ($MonthNow)) {
            $DateErr = "Invalid Date";
			$Invalid = true;
		    } elseif (($_POST["Month"]) == ($MonthNow)) {
			         
					 $DayNow = GrabDay($CurrentDay);
                     if (($_POST["Day"]) < ($DayNow)) {
                      $DateErr = "Invalid Date";
					  $Invalid = true;
			         } else {
		                 $SelectedDay = ($_POST["Day"]);	
		                 $SelectedMonth = ($_POST["Month"]);	
		                 $SelectedYear = ($_POST["Year"]);}
						 if ((CheckForInvalidDate($SelectedDay, $SelectedMonth, $SelectedYear)) == true) { 
						 $DateErr = "Invalid Date" ;
						 $Invalid = true; } 	   		 
			} else {
			    $SelectedDay = ($_POST["Day"]);	
				$SelectedMonth = ($_POST["Month"]);	
		        $SelectedYear = ($_POST["Year"]);}
				if ((CheckForInvalidDate($SelectedDay, $SelectedMonth, $SelectedYear)) == true) { 
						 $DateErr = "Invalid Date" ;
						 $Invalid = true; } 
     } else {	
		$SelectedDay = ($_POST["Day"]);	
		$SelectedMonth = ($_POST["Month"]);	
		$SelectedYear = ($_POST["Year"]);}
		if ((CheckForInvalidDate($SelectedDay, $SelectedMonth, $SelectedYear)) == true) { 
						 $DateErr = "Invalid Date" ;
						 $Invalid = true; } 
		
if (($Invalid) == false) {
	$DateConf = ("This is a valid date");
	StoreToSession($SelectedDay, $SelectedMonth, $SelectedYear);
	echo '<script type="text/javascript">
           window.location = "booktheatre2.php"
      </script>';
}

}

// Store data to session
function StoreToSession($SelectedDay, $SelectedMonth, $SelectedYear) {
	$_SESSION["SelectedDay"] = $SelectedDay;
	$_SESSION["SelectedMonth"] = $SelectedMonth;
	$_SESSION["SelectedYear"] = $SelectedYear;
	}
	

//Check for invalid dates
function CheckForInvalidDate($SelectedDay, $SelectedMonth, $SelectedYear) {
	if (($SelectedDay == 31) and ($SelectedMonth == 2)) { 
						  $Invalid = true;}
						  elseif (($SelectedDay == 30) and ($SelectedMonth == 2)) { 
						  $Invalid = true;}
						  elseif (($SelectedDay == 31) and ($SelectedMonth == 4)) { 
						  $Invalid = true;}
						  elseif (($SelectedDay == 31) and ($SelectedMonth == 6)) { 
						  $Invalid = true;}
						  elseif (($SelectedDay == 31) and ($SelectedMonth == 9)) { 
						  $Invalid = true;}
						  elseif (($SelectedDay == 31) and ($SelectedMonth == 11)) { 
						  $Invalid = true;}
						  elseif (((LeapYear($SelectedYear)) == 0) and (($SelectedMonth) == 2) and (($SelectedDay) == 29))  {
						  $Invalid = true;}
	return $Invalid; }



//Check for leap year
function LeapYear($SelectedYear) {
 $Leap = 0;
 if (($SelectedYear % 4 == 0) and (($SelectedYear % 100 != 0) or ($SelectedYear % 400 == 0))) {
   $Leap += 1;
 }
 
 if ($Leap == 1) { 
   return $Leap; 
   } else {
	 return $Leap;
	 }
}


//Finds current day and removes nought if a one digit length date
function GrabDay($CurrentDay) {
	date_default_timezone_set('Europe/London');
	$CurrentDay = date("d");
	if (substr($CurrentDay, 0, 1) == 0) {
		$CurrentDay = substr($CurrentDay, 1, 1); 
	} else {
		$CurrentDay == $CurrentDay; }
		return $CurrentDay; 
}

//Finds current month and removes nought if a one digit length date
function GrabMonth($CurrentMonth) {
	date_default_timezone_set('Europe/London');
	$CurrentMonth = date("m");
	if (substr($CurrentMonth, 0, 1) == 0) {
		$CurrentMonth = substr($CurrentMonth, 1, 1); 
	} else {
		$CurrentMonth == $CurrentMonth; }
		return $CurrentMonth; 
}

//Finds current year
function GrabYear($CurrentYear) {
	date_default_timezone_set('Europe/London');
	$CurrentYear = date("y");
		return $CurrentYear; 
}

//Removes impurities and symbols to prevent cross scripted hacking
function TestInput($Data) {
   $Data = trim($Data);
   $Data = stripslashes($Data);
   $Data = htmlspecialchars($Data);
   return $Data;
}
?>

<div id="BookTheatreDateSelectionForm">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<select name="Day">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31	</option>
</select>

<select name="Month">
  <option value="1">January</option>
  <option value="2">February</option>
  <option value="3">March</option>
  <option value="4">April</option>
  <option value="5">May</option>
  <option value="6">June</option>
  <option value="7">July</option>
  <option value="8">August</option>
  <option value="9">September</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
</select>

<select name="Year">
  <option value="15">2015</option>
  <option value="16">2016</option>
  <option value="17">2017</option>
  <option value="18">2018</option>
  <option value="19">2019</option>
  <option value="20">2020</option>
  <option value="21">2021</option>
</select>
<br>
<input type="submit" value="Next step">
</form>
<br>

<span class="error"> <?php echo $DateErr;?></span>
<span class="valid"> <?php echo $DateConf;?></span><br>
</div>


<div id="Footer">
<p>&copy; 2016 All Rights Reserved</p>
</div>

</body>
</html>
