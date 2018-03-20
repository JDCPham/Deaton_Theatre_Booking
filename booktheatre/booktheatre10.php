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

<div id="BookTheatreTitle">YOUR BOOKING WAS SUCCESSFUL</div>
<div id="BookTheatreSubTitle">WE'LL REDIRECT YOU BACK TO THE HOME PAGE IN A FEW SECONDS</div>
<div id="BookTheatreDateSelectionForm">

<script>
setTimeout(function () {
       window.location.href = "../index.html"; //will redirect to your blog page (an ex: blog.html)
    }, 10000);
	</script>

<div id="Footer">
<p>&copy; 2015 All Rights Reserved</p>
</div>


</body>
</html>
