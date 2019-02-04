<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>product toevoegen</title>
    <script type="text/javascript" src="js/photo.js"></script>
    <link rel="stylesheet" href="css/add-product.css">
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
        if(isset($_SESSION["user_id"])){
    ?>
   
<div class="formDiv">
<h1>voeg product toe</h1>
    <form action="uploadimage.php" id="addproduct-form" method="post" enctype="multipart/form-data">
        <section class="addproduct-form-group">
            <label for="input">Titel:</label>
            <input type="text" name="title_input" class="addproduct-input"/>
        </section>
        <section class="addproduct-form-group">
            <label for="textarea">Omschrijving:</label>
            <input type="text" name="description_input" id="addproduct">
        </section>
        <section class="addproduct-form-group">
            <label for="select">Categorie:</label>
            <select id="addproduct-categories" name="product_category">
                <option value="groenten">Groente</option>
                <option value="fruit">Fruit</option>
            </select>
        </section>
        <section class="addproduct-form-group">
            <label for="input">Upload een afbeelding:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </section>
        <section class="addproduct-form-group">
            <label for="date">Houdbaarheidsdatum:</label>
            <input type="date" name="expire-date_input" id="somedate" min=""/>
        </section>
        <section class='knopje'>
        <input class="knop" type="submit" value="plaats">
        </section>
    <br>
    </form>
</div>
    <?php
            } else {
                echo "please login";
            }
            ?>

<script>
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("somedate").setAttribute('min', today);
        </script>
</body>
</html>