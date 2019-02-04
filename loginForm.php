<?php
    session_start();
    include "db-connection.php";

    $email = $_POST["email"];
    $password = $_POST["password"];
    

    $sql = "SELECT * FROM users WHERE email='$email'"; 
    
    $data = $conn->query($sql);   
    $getData = $data->fetch();
    $hash = $getData["password"];
    if(password_verify($password, $hash)) {
    if($data->rowCount() > 0){
     
            echo "hoi";
            $_SESSION['phone_number'] = $getData['phone_number'];
            $_SESSION['email'] = $getData['email'];
            $_SESSION['name'] = $getData['firstname'];
            $_SESSION['user_id'] = $getData['user_id'];
            $_SESSION['lat'] = $getData['lat'];
            $_SESSION['lon'] = $getData['lon'];
            $_SESSION['screenname'] = $getData['screenname'];
        header('Location: index.php');  

    }}else{

        // header("Location: login.php?errorCode='password or email = fout'");  
    }


   
?>



