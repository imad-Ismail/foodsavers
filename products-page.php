<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/products-page.css">
    <link rel="stylesheet" type="text/css" href="css/style-landingspage.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/product-jq.js"></script>
    <title>Document</title>
</head>

<body>
<?php
include("db-connection.php");
?>

        <?php
    include "hamburger-menu.php";
?>  
    <!--NAVBAR-->
    <div class="landingspage-navbar-container navbar-fixed">
    <div class="navbar-logo animated bounceInUp">
        <img src="images/logo-foodsavers.png" alt="logo">
    </div>
    <div class="navbar-hamburger-menu animated bounceInUp">
        <span onclick="openNav()">&#9776;</span>
    </div>
</div>

    <h1>producten</h1>

<div id="navblock">
                <?php
            include "filter menu.php";
                 ?> 
                 </div>


    <div id="products-container">
            <?php
            if(!isset($_SESSION["autoLocation"])){
                        if(isset($_SESSION["user_id"])){
                        $userId = $_SESSION["user_id"];
                    $sql = "SELECT * FROM users WHERE user_id = '$userId'";
    
                        $data = $conn->query($sql);   

                        if($data->rowCount() > 0){
                         
                            foreach ($data as $row)
                            {   

                                $_SESSION['lat'] = $row['lat'];
                                $_SESSION['lon'] = $row['lon'];
                            }
                                        // }
                                    }}
                    }


            $sql = "SELECT * FROM product ";
            // $product_id = $_GET["product_id"];

            $data = $conn->query($sql); 

            foreach($data as $row)
            {
                $_SESSION['product_id'] = $row['product_id'];
                $afstand = distance($row['lat'], $row['lon'], $_SESSION['lat'], $_SESSION['lon'], 6371000);

                $htmlOutput  = "";
                $htmlOutput .= '<div class="card" afstand="'.round($afstand / 1000).'">';
                $htmlOutput .= '<div class="products-item">'; 
                $htmlOutput .= '<img class="products-item-image" src="uploads/' . $row['imagelist'] . '" alt="afbeelding niet beschikbaar">';
                $htmlOutput .= '<div class="products-title">'  . $row['title'];
                if(isset($_SESSION["lat"])){
                $htmlOutput .= '<b>'. '<div class"products-information-distance">' . 'afstand&nbsp;' . '</b>' . '<div class=distance-color>' . round($afstand / 1000) . 'KM' . '</div>';
                } else{
                    $htmlOutput .= '<b>'. '<div class"products-information-distance">' . 'afstand&nbsp;' . '</b>' . '<div class=distance-color> deel locatie om afstand te berekenen.</div>';
                }
                $htmlOutput .= '<button>' . '<a href="product-information.php?product_id=' . $_SESSION['product_id'] . '">Informatie</a>' . '</button>';
                $htmlOutput .= '</div>';
                $htmlOutput .= '</div>';
                $htmlOutput .= '</div>';
                $htmlOutput .= '</div>';
                echo $htmlOutput;
            }
            function distance(
              $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
            {
              $latFrom = deg2rad($latitudeFrom);
              $lonFrom = deg2rad($longitudeFrom);
              $latTo = deg2rad($latitudeTo);
              $lonTo = deg2rad($longitudeTo);

              $latDelta = $latTo - $latFrom;
              $lonDelta = $lonTo - $lonFrom;

              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
              return $angle * $earthRadius;
            };
            ?>

    </div>
    <script type="text/javascript">
    $(document).on('click', '.option-btn', function (){
    $(this).toggleClass('open');
    $('.control-center').toggleClass('open');
    });
    </script>

    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/product.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var cards = $("#products-container .card");
    var temp = cards.sort(function(a,b){
      return parseInt($(a).attr("afstand")) - parseInt($(b).attr("afstand"));
    });
    $("#products-container").html(temp);
        });
    </script>
</body>

</html>