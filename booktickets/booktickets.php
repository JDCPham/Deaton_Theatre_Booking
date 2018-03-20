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
$result = SQLQuery();

//Enable Sessions
session_start();

function SQLQuery() {
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
  $sql = "SELECT `name`,`event_id` FROM tblEvent";
  
  //Execute Query
  $result = mysql_query($sql);
	if ($result === false) {
		die("Could not execute query");
	}
  return $result;
} 
?>

<div id="BookTicketsHeader">UPCOMING EVENTS</div>

<?php
function DisplayResults($result) {
  //Fetch result from database
  while ($row = mysql_fetch_assoc($result)) {
	  echo "<div id='EventName'><a style='text-decoration:none; color:#FCF' href='booktickets2.php?eventname=".$row['name']."&eventid=".$row['event_id']."'>".strtoupper($row["name"])."</div><br>"	;
  
  }
}

DisplayResults($result);

?>




</div>




<div id="Footer">
<p>&copy; 2015 All Rights Reserved</p>
</div>

</body>
</html>
