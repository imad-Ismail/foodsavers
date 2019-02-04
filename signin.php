<!DOCTYPE html>
<html>

<head>
    <title>registration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/signin.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
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
                
            </div>
    <div class="formDiv">
        <form action="signinform.php" method="post">
            <h1>registratie</h1>
            <div class="input">
                <input type="text" name="firstname" autofocus placeholder="voornaam" required>
                <br>
                <input type="text" name="lastname" placeholder="achternaam" required>
                <br>
                <input type="text" name="screenname" placeholder="schermnaam" required/>
                <br>
                <input type="email" name="email" placeholder="E-mail" required>
                <br>
                <input type="password" name="password" placeholder="paswoord" required>
                <br>
                <input type="password" name="password" placeholder="paswoord" required>
                <br>
                <input type="tel" name="phone_number" placeholder="telefoon nummer" required>
                <br>
                <input id="query" type="text" name="postalcode" onfocusout= "zoeknu('signin');" placeholder="postcode" autocomplete="nope" required>
                <br>
                <input type="text" name="house_number" placeholder="huisnummer" required>
                <br>
                <section class="input-wrapper">
                <input class="check" type="checkbox" name="accept-phonenumber_input" value="true">Accepteer telefoon
                </section>
                <section class="input-wrapper">
                <input class="check" type="checkbox" name="accept-email_input" value="true" checked>Accepteer email
                </section>
                <input id="lats" type="hidden" name="lat">
                <input id="lons" type="hidden" name="lon">


                <button type="submit" class="loginbtn">Aanmelden</button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="js/maps.js"></script>
</body>

</html>