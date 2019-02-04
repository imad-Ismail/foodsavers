<?php include("db-connection.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <!-- <link rel="stylesheet" href="css/products-page.css"> -->
    <link rel="stylesheet" href="css/delete-product.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
            <h1>mijn producten</h1>
<div class="formDiv">
    <!-- <table border="1"> -->
        <?php
        if (isset($_SESSION["user_id"])) {
          $user_id = $_SESSION["user_id"];
        
      $sql ="SELECT * FROM product WHERE user_id ='$user_id'";
      $data = $conn->query($sql);   

      foreach($data as $row){
    //   echo    '<tr><td>'.$row['product_id'].'</td><td>'.$row['title'].
    //           '</td><td>'.$row['description'].'</td><td><img style="max-width:100px;" src="uploads/' .$row['imagelist'].'"/></td><td>'.$row['expire_date'].'</td><td>'.
    //           '<button id="'.'" class="trash" > delete </button> ' . ' </td>
    //           <td><a href="edit-product.php?product_id=' . $row["product_id"] . '">Wijzigen</a></tr>';
    $htmlOutput  = "";
    $htmlOutput .= '<div  class="wrapper">';
    $htmlOutput .= '<div class="delete-container">';
    $htmlOutput .= '<div class="delete-card">';
    $htmlOutput .= '<img src="uploads/' .$row['imagelist'].'"/>';
    $htmlOutput .= '<div "class=title">' . $row['title']; 
    $htmlOutput .= '<br>';
    $htmlOutput .= '<br>';
    // $htmlOutput .= $row['description'];
    $htmlOutput .=  '<div "class=date">' . $row['expire_date'];
    $htmlOutput .= '<button id="'. $row['product_id'] .'" class="trash" > delete </button>' . '';
    $htmlOutput .= '<a href="edit-product.php?product_id=' . $row["product_id"] . '">Wijzigen</a>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '</div>';
    echo $htmlOutput;

      };
      } else {
        // echo "hallo";
      };
  ?>
    <!-- </table> -->
</div>
    <script type="text/javascript" src="js/product.js"></script>
</body>

</html>



