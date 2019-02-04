<?php
session_start();
error_reporting(0);
@ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>
<head>
	<title>hamburger-menu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/style-landingspage.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
</head>
<body>



<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <div class="style-logo">
            <a href="index.php">
            <img src="images/logo-foodsavers.png" width="350px" height="auto" alt="logo"></a>
        </div>

            <a href="products-page.php">Producten</a>
            <!-- <a href="about-us.php">Over ons</a> -->
            <a href="contact.php">Contact</a>
                            <?php 
                    if(!isset($_SESSION["user_id"])){

                echo '
                <a href="signin.php">Registreren</a>
                <a href="login.php">Inloggen</a>';
             }else {
                echo '
                <a href="delete-product.php">Mijn producten</a>
                <a href="messages.php">Mijn berichten</a>
                <a href="addproduct.php">Voeg product toe</a>
                <a href="profile.php">Mijn profiel</a>
                <a href="logout.php">Uitloggen</a>';

             };

             ?>
    </div>
</div>


    <script src="js/product.js"></script>
</body>
</html>

