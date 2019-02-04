<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div id="products-container">

    <?php
session_start();
include("db-connection.php");

    $x = $_GET['title'];

if ($x == '') {
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

    $data = $conn->query($sql); 

    foreach($data as $row)
            {
                
                if(isset($_SESSION["lat"])){
                $afstand = distance($row['lat'], $row['lon'], $_SESSION['lat'], $_SESSION['lon'], 6371000);
                } else{
                    $afstand = 10000;
                }

                $_SESSION['product_id'] = $row['product_id'];
                $htmlOutput  = "";
                $htmlOutput .= '<div class="card" afstand="'.round($afstand / 1000).'">';
                $htmlOutput .= '<div class="products-item">'; 
                $htmlOutput .= '<img class="products-item-image" src="uploads/' . $row['imagelist'] . '" alt="afbeelding niet beschikbaar">';
                $htmlOutput .= '<div class="products-title">'  . $row['title'];
                if(isset($_SESSION["lat"])){
                    $afstand = distance($row['lat'], $row['lon'], $_SESSION['lat'], $_SESSION['lon'], 6371000);
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
}else {

        $sql = "SELECT * FROM product WHERE title LIKE '$x%'";

    $data = $conn->query($sql); 

    foreach($data as $row)
            {
                $_SESSION['product_id'] = $row['product_id'];
                if(isset($_SESSION["lat"])){
                $afstand = distance($row['lat'], $row['lon'], $_SESSION['lat'], $_SESSION['lon'], 6371000);
                } else{
                    $afstand = 10000;
                }
                $_SESSION['product_id'] = $row['product_id'];
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
        $(document).ready(function filter(){
            var cards = $("#products-container .card");
    var temp = cards.sort(function(a,b){
      return parseInt($(a).attr("afstand")) - parseInt($(b).attr("afstand"));
    });
    $("#products-container").html(temp);
        });
    </script>
    <script type="text/javascript" src="js/product.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
</body>
</html>

