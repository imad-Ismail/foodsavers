<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="css/products-page.css"> -->
    <link rel="stylesheet" type="text/css" href="css/contact.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
        include "contact-script.php";
        ?>
        <?php
    include "hamburger-menu.php";
?>  
    <!--NAVBAR-->
             <!--NAVBAR-->
    <div class="landingspage-navbar-container navbar-fixed">
    <div class="navbar-logo animated bounceInUp">
        <img src="images/logo-foodsavers.png" alt="logo">
    </div>
    <div class="navbar-hamburger-menu animated bounceInUp">
        <span onclick="openNav()">&#9776;</span>
    </div>
</div>
            <!-- <div class="flexwrapper-contact"> -->
<div class="contact-container">
<h1>contact</h1>
    <form name="contactform" method="post" action="send_form_email.php">
        <table width="350px">
        <tr>
         <td valign="top">
          <label for="first_name"></label>
         </td>
         <td valign="top">
          <input  type="text" name="first_name" maxlength="50" size="30" placeholder="voornaam">
         </td>
        </tr>
        <tr>
         <td valign="top">
          <label for="last_name"></label>
         </td>
         <td valign="top">
          <input  type="text" name="last_name" maxlength="50" size="30" placeholder="achternaam">
         </td>
        </tr>
        <tr>
         <td valign="top">
          <label for="email"></label>
         </td>
         <td valign="top">
          <input  type="text" name="email" maxlength="80" size="30" placeholder="email">
         </td>
        </tr>
        <tr>
         <td valign="top">
          <label for="telephone"></label>
         </td>
         <td valign="top">
          <input  type="text" name="telephone" maxlength="30" size="30" placeholder="telefoonnummer">
         </td>
        </tr>
        <tr>
         <td valign="top">
          <label for="comments"></label>
         </td>
         <td valign="top">
          <textarea  name="comments" maxlength="1000" cols="25" rows="6" placeholder="bericht"></textarea>
         </td>
        </tr>
        <tr>
         <td colspan="2" style="text-align:center">
          <input class="knop" type="submit" value="verzenden"></a>
         </td>
        </tr>
        </table>
        </form>
</div>
<!-- </div> -->
</body>
</html>