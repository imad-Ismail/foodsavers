<?php
include("db-connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/products-page.css">
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
        if(isset($_GET["product_id"])){
        $product_id = $_GET["product_id"];
        $user_id = $_SESSION["user_id"];
        $sqlSelect = "SELECT * FROM product WHERE product_id = '$product_id' AND user_id = '$user_id'";
        $data = $conn->query($sqlSelect);
        foreach($data as $value){
    ?>
<div class="formDiv">
    <form method="post" action="">
    <section class="edit-product-form-group">
        <label for="input">Titel</label>
        <input type="text" name="title_input" value="<?php echo $value['title']; ?>"/>
    </section>
    <section class="edit-product-form-group">
        <label for="textarea">Omschrijving</label>
        <textarea name="description_input"><?php echo $value['description']; ?></textarea>
    </section>
    <section class="edit-product-form-group">
        <label for="input">Houdbaarsheidsdatum</label>
        <input type="date" name="expire_input" value="<?php echo $value['expire_date']; ?>">
    </section>
    <section class="edit-product-form-group">
        <input type="submit" name="save_submit" value="opslaan">
    </section>
    </form>
</div>
    <?php
        }

        
    if(isset($_POST["save_submit"])){
        $title = htmlspecialchars($_POST["title_input"]);
        $description = htmlspecialchars($_POST["description_input"]);
        $expire_date = htmlspecialchars($_POST["expire_input"]);

        $sqlUpdate = "UPDATE product 
        SET title = '$title', description = '$description', expire_date='$expire_date'
        WHERE product_id = '$product_id' AND user_id = '$user_id'";

        $conn->query($sqlUpdate);
        header("Location: delete-product.php");
    }
    } else{

        echo "Selecteer een product";
    }
    } else{
        echo "Log in om deze pagina te kunnen gebruiken";
    }
    ?>
</body>
</html>