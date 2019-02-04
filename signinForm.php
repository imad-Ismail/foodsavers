<?php
    // echo "Inschrijven";
    // echo "<br>";
    // echo $_POST["firstname"]; 
    // echo "<br>";
    // echo $_POST["lastname"];
    // echo "<br>";
    // echo $_POST["email"]; 
    // echo "<br>";
    // echo $_POST["password"];
    // echo "<br>";
    // echo $_POST["phone_number"];
    // echo "<br>";
    // echo $_POST["postalcode"];
    // echo "<br>";
    // echo $_POST["house_number"]; 

 
    include "db-connection.php";

    $firstname = htmlspecialchars($_POST["firstname"], ENT_QUOTES, 'UTF-8');
    $lastname = htmlspecialchars($_POST["lastname"]);
    $screenname = htmlspecialchars($_POST["screenname"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $phone_number = htmlspecialchars($_POST["phone_number"]);
    $postalcode = htmlspecialchars($_POST["postalcode"]);
    $house_number = htmlspecialchars($_POST["house_number"]);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];

    if(isset($_POST["accept-phonenumber_input"])){
        $acceptPhonenumber = "true";
    } else{
        $acceptPhonenumber = "false";
    }
    
    if(isset($_POST["accept-email_input"])){
        $acceptEmail = "true";
    } else{
        $acceptEmail = "false";
    }

    

 if(!isset($firstname) || trim($firstname) == '' ||
    !isset($lastname) || trim($lastname) == ''||
    !isset($email) || trim($email) == ''||
    !isset($password) || trim($password) == ''||
    !isset($phone_number) || trim($phone_number) == ''||
    !isset($postalcode) || trim($postalcode) == ''||
    !isset($house_number) || trim($house_number) == '' ||
    !isset($screenname) || trim($screenname) == '')
{
   header("Location: signin.php"); 
   echo "You did not fill out the required fields.";
}

else {


    try {
            $sql = "INSERT INTO users (firstname, lastname, screenname, email, password, phone_number , postalcode , house_number, accept_phone, accept_email , lat , lon)
            VALUES ('$firstname', '$lastname', '$screenname', '$email', '$hash', '$phone_number' , '$postalcode' , '$house_number', '$acceptPhonenumber', '$acceptEmail' , '$lat' , '$lon')";
            echo $sql;
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "New record created successfully";
        }
    catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;

    header("Location: login.php");  
}
?>