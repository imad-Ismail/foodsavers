<?php
include("db-connection.php");
$pid = $_GET['pid'];

				  $sql = "SELECT * FROM users WHERE user_id = $pid";
				                 $data = $conn->query($sql);  
               					  if($data->rowCount() > 0){
                         
                             foreach ($data as $row)
                             {   
                                 $u_like = $row['likes'];
                             }
                         }
                         echo $u_like;
                         ?>