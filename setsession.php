<?php
include("db-connection.php");
session_start();
$lat = $_POST['lat'];
$lon = $_POST['lon'];

$_SESSION['lat'] = $lat;
$_SESSION['lon'] = $lon;
$_SESSION["autoLocation"] = "true";

	if($_SESSION["lat"] !== null && $_SESSION["lon"] !== null) {
	   echo "YES";
	} else {
	   echo "NO";
	}



?>