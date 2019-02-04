<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/product-information.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script type="text/javascript" src="js/jq.js"></script>
    <title>product-information</title>
</head>
<body>
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

    <div class=product-information-container>
        <?php
        include "db-connection.php";

            $product_id = $_GET["product_id"];
            $sql = "SELECT * FROM product WHERE product_id = '$product_id'";

            $data = $conn->query($sql);

            foreach($data as $row)
            {
                    $_SESSION['product_id'] = $row['product_id'];
                    $pid = $row['user_id'];

            
                if(isset($_SESSION["lat"])){
                    $afstand = distance($row['lat'], $row['lon'], $_SESSION['lat'], $_SESSION['lon'], 6371000);
                    } else{
                        $afstand = 10000;
                    }
                $htmlOutput  = "";
                $htmlOutput  = '<div class="product-information-card">';
                $htmlOutput .= '<img src="uploads/' . $row['imagelist'] . '" style="width:75%">';
                $htmlOutput .= '<h1>'. '<div class="products-information-title">' . $row['title'] . '</h1>';
                $htmlOutput .= '<b>'. '<div class="products-information-expire-date">' . 'houdsbaarheids datum&nbsp;'. '</b>' . '<div class=date-color>' . $row['expire_date'] . '</div>';
                $htmlOutput .= '<br>';
                if(isset($_SESSION["lat"])){
                            $htmlOutput .= '<b>'. '<div class"products-information-distance">' . 'afstand&nbsp;' . '</b>' . '<div class=distance-color>' . round($afstand / 1000) . 'KM' . '</div>';
                } else{
                    $htmlOutput .= '<b>'. '<div class"products-information-distance">' . 'afstand&nbsp;' . '</b>' . '<div class=distance-color> deel locatie om afstand te berekenen.</div>';
                }
                $htmlOutput .= '<br>';
                $htmlOutput .= '<div class="products-information-info">' . $row['description'];

                
                $htmlOutput .= '</div>'; 
                
                
                
                
                if (isset($_SESSION['user_id']) &&  $pid == $_SESSION['user_id']) {
                    
                }
                else {
                    if (!isset($_SESSION['user_id'])) {
                        
                    } else {
                        
                $sql = "SELECT * FROM users WHERE user_id = $pid";
                $data = $conn->query($sql);  
                if($data->rowCount() > 0){
                         
                            foreach ($data as $row)
                            {   
                                $u_like = $row['likes'];
                            }
                        }

                   if ($u_like > 0 ) {
                       $htmlOutput .='<div class="screemname">' . $row['screenname'] .
                       '<div id="likenumber">'. $u_like . '</div>';
                   } else {
                        $htmlOutput .='<div class="screemname">' . $row['screenname'] . '<div id="likenumber">' . '</div>';
                   }
                 //user id - die je wil raten
                $uid= $_SESSION['user_id']; //ingelode id
                $sql=$conn->prepare("SELECT * FROM fdlikes WHERE pid=? and user=?");
                $sql->execute(array($pid, $uid));
                if($sql->rowCount()==1){

                $htmlOutput .=  '<a href="#" class="like color" id="'.$pid.'" title="Unlike"><i class="far fa-thumbs-up color"></i></a>';
                                        }
                else{ 
                $htmlOutput .= '<a href="#" class="like uncolor" id="'.$pid.'" title="Like"><i class="far fa-thumbs-up uncolor"></i></a>';
                      } 
                  }
            }
                $htmlOutput .= '</div>';
                $htmlOutput .= '<br>';
                // $htmlOutput .= '<div class="products-information-info">' . $row['description'];
                $htmlOutput .= '</div>'; 
                $htmlOutput .= '<div class="product-information-button">';
                if(isset($_SESSION["user_id"])){
                $htmlOutput .= '<p>'. '<a href="message.php?screenname=' . $row['screenname'] . '"><button>'. '<img src="images/chat.png" height="40" width="40">' . '</button>' .  '</a>' . '</p>';
                if ($row['accept_phone'] === "true"){
                    $htmlOutput .= '<p>'. '<a href="tel:' . $row['phone_number'] . '"><button>'. '<img src="images/smartphone.png" height="40" width="40">' . '</button>' . '</a>' . '</p>';
                    }
                    if ($row['accept_email'] === "true"){
                    $htmlOutput .= '<p>'. '<a href="mailto:' . $row['email'] . '"><button>' . '<img src="images/email.png" height="40" width="40">' . '</button>' . '</p>';
                    }}
                // $htmlOutput .= '<p>'. '<button>'. '<img src="images/handshake.png" height="50" width="35">' . '</button>' . '</a>' . '</p>';
                $htmlOutput .= '</div>';
echo $htmlOutput;
}
function distance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
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
        $(document).ready(function(){
         $(document).on('click', '.like', function(){

            if($(this).attr('title') == 'Like'){ $that = $(this);
                $.post('action.php', {pid:$(this).attr('id'), action:'like'},function(){
                      $that.attr('title','Unlike');
                      $that.find("i").attr("class", "far fa-thumbs-up color");
                      $("#likenumber").load("likes_number.php?pid=" + <?php echo $pid; ?>, function() {});
            });}

            else{ if($(this).attr('title') == 'Unlike'){  $that = $(this);
                $.post('action.php', {pid:$(this).attr('id'), action:'unlike'},function(){ 
                $that.find("i").attr("class", "far fa-thumbs-up uncolor")
                $that.attr('title','Like');
                $("#likenumber").load("likes_number.php?pid=" + <?php echo $pid; ?>, function() {});

                 }); }} });});
             </script>

</body>
</html>