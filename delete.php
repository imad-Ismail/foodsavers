<?php
include("db-connection.php");
$product_number = $_POST['del_id'];
$sql = "DELETE FROM product WHERE product_id ='$product_number'";
$data = $conn->query($sql);
 

	if($data) {
	   echo "YES";
	} else {
	   echo "NO";
	}
?>