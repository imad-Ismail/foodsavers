<?php
include("db-connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
    <title>profiel</title>
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
<h1>profiel</h1>
    <form method="post" action="">
    <section class="edit-product-form-group">
        <label for="input">Voornaam:</label>
        <br>
        <?php echo $value['firstname']; ?>
    </section>
    <section class="edit-product-form-group">
        <label for="textarea">Achternaam:</label>
        <br>
        <?php echo $value['lastname']; ?>
    </section>
    <section class="edit-product-form-group">
        <label for="textarea">Schermnaam:</label>
        <br>
        <?php echo $value['screenname']; ?>
    </section>
    <section class="edit-product-form-group">
        <label for="input">Email:</label>
        <br>
        <?php echo $value['email']; ?>
    </section>
    <section class="edit-product-form-group">
        <label for="input">Telefoonnummer:</label>
        <br>
        <?php echo $value['phone_number']; ?>
    </section>
    <section class="edit-product-form-group">
        <label class="label" for="input">Huisnummer:</label>
        <br>
        <?php echo $value['house_number']; ?>
    </section>
    <section class="edit-product-form-group">
        <input disabled type="checkbox" name="accept-phonenumber_input" value="true" <?php $value['accept_phone'] == 'true' ? print 'checked' : 'false'  ?>>Accepteer telefoon
        <br>
        <input disabled type="checkbox" name="accept-email_input" value="true" <?php $value['accept_email'] == 'true' ? print 'checked' : 'false'  ?>>Accepteer email
        <br>
        <input disabled type="checkbox" name="accept-postalcode_input" value="true" <?php $value['accept_address'] == 'true' ? print 'checked' : 'false'  ?>>Accepteer postcode
    </section>
    </form>
<div class="knop">
    <a href="edit-profile.php">profiel bewerken</a>
        </div>
    <?php
        }
    } else{
        echo "Log in om deze pagina te kunnen gebruiken";
    }
    ?>
    </div>
</body>
</html>