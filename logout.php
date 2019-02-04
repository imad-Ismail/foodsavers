<?php
session_start();
include("db-connection.php");
session_destroy();

echo 'You have cleaned session';
   header('Refresh: 0; URL = index.php');
	


?>