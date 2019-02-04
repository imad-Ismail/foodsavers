<?php

    require_once("database_connection.php");
    $time = date("2012-12-31");
    echo $time;
    $sql = "INSERT INTO product (user_id, cat_id, title, description, imagelist, expire_date, contact)
            VALUES (1, 1, 'title', 'description', 'imagelist', '$time', 'contact')";
    
    $data = $conn->query($sql);     

    // foreach ($data as $row)
    // {   
    //     $htmlOutput = ""; 
    //     $htmlOutput  = '<p class = "result">';
    //     $htmlOutput .= $row['firstname'];
    //     $htmlOutput .= "</p>";

    //     echo $htmlOutput;
    // }  
  
?>