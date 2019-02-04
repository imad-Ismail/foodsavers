<?php
include("db-connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/edit-profile.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>profiel bewerken</title>
</head>
<body>
    <?php
    include "hamburger-menu.php";
?>  
     <!--NAVBAR--><!--NEW CODE-->
<div class="landingspage-navbar-container">
    <div class="navbar-logo animated bounceInUp">
        <img src="images/logo-foodsavers.png" alt="logo">
    </div>
    <div class="navbar-hamburger-menu animated bounceInUp">
        <span onclick="openNav()">&#9776;</span>
    </div>
</div>
    <?php
  
    if(isset($_SESSION["user_id"]))
    {
        $user_id = $_SESSION["user_id"];
        $sqlSelect = "SELECT * FROM users WHERE user_id = '$user_id'";
        $data = $conn->query($sqlSelect);
        foreach($data as $value){
    ?>
<div class="formDiv">
    <h1>profiel bewerken</h1>
    <form method="post" action="">
    <section class="edit-product-form-group">
        <label for="input">Voornaam</label>
        <br>
        <input type="text" name="firstname_input" value="<?php echo $value['firstname']; ?>">
    </section>
    <section class="edit-product-form-group">
        <label for="textarea">Achternaam</label>
        <br>
        <input type="text" name="lastname_input" value="<?php echo $value['lastname']; ?>">
    </section>
    <section class="edit-product-form-group">
        <label for="textarea">Schermnaam</label>
        <br>
        <input type="text" name="screenname_input" value="<?php echo $value['screenname']; ?>">
    </section>
    <section class="edit-product-form-group">
        <label for="input">Email</label>
        <br>
        <input type="text" name="email_input" value="<?php echo $value['email']; ?>">
    </section>
    <section class="edit-product-form-group">
        <label for="input">Telefoonnummer</label>
        <br>
        <input type="text" name="phonenumber_input" value="<?php echo $value['phone_number']; ?>">
    </section>
    <section class="edit-product-form-group">
        <label for="input">Huisnummer</label>
        <br>
        <input type="text" name="housenumber_input" value="<?php echo $value['house_number']; ?>">
    </section>
    <section class="border" class="edit-product-form-group">
        <input type="checkbox" name="accept-phonenumber_input" value="true" <?php $value['accept_phone'] == 'true' ? print 'checked' : 'false'  ?>>Accepteer telefoon
        <br>
        <input type="checkbox" name="accept-email_input" value="true" <?php $value['accept_email'] == 'true' ? print 'checked' : 'false'  ?>>Accepteer email
        <br>
        <input type="checkbox" name="accept-postalcode_input" value="true" <?php $value['accept_address'] == 'true' ? print 'checked' : 'false'  ?>>Accepteer postcode
    </section>
    <section class="edit-product-form-group">
        <input class="knop" type="submit" name="save_submit" value="opslaan">
    </section>
    </form>
</div>
    <?php
        }

        
    if(isset($_POST["save_submit"])){
        $firstname = htmlspecialchars($_POST["firstname_input"]);
        $lastname = htmlspecialchars($_POST["lastname_input"]);
        $email = htmlspecialchars($_POST["email_input"]);
        $screenname = htmlspecialchars($_POST["screenname_input"]);
        $phonenumber = htmlspecialchars($_POST["phonenumber_input"]);
        $housenumber = htmlspecialchars($_POST["housenumber_input"]);
        if(isset($_POST["accept-postalcode_input"])){
            $acceptPostalcode = "true";
        } else{
            $acceptPostalcode = "false";
        }

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

        $sqlUpdate = "UPDATE users 
        SET firstname = '$firstname', lastname = '$lastname', screenname = '$screenname', email='$email', phone_number = '$phonenumber', house_number = '$housenumber', accept_phone = '$acceptPhonenumber', accept_email = '$acceptEmail', accept_address = '$acceptPostalcode'
        WHERE user_id = '$user_id'";

        //echo $sqlUpdate;

        $conn->query($sqlUpdate);
        
       header("Location: profile.php");  
    }
    } else{
        echo "Log in om deze pagina te kunnen gebruiken";
    }
    ?>
</body>
</html>