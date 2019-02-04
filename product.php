  <?php include("db-connection.php"); ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<title>mijn producten</title>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/my-products.css">
      <link rel="stylesheet" type="text/css" href="css/style-landingspage.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  </head>
  <body>

<?php
    include "hamburger-menu.php";
?>  
    <!--NAVBAR-->
    <!--NAVBAR--><!--NEW CODE-->
   <!--NAVBAR-->
   <div class="landingspage-navbar-container navbar-fixed">
    <div class="navbar-logo animated bounceInUp">
        <img src="images/logo-foodsavers.png" alt="logo">
    </div>
    <div class="navbar-hamburger-menu animated bounceInUp">
        <span onclick="openNav()">&#9776;</span>
    </div>
</div>
                
           
  
    <table border="1">
    <?php
$sql ="SELECT * FROM product";
$data = $conn->query($sql);   

foreach($data as $row){
    echo '<tr><td>'.$row['product_id'].'</td><td>'.$row['cat_id'].'</td><td>'.$row['user_id'].'</td><td>'.$row['title']. '</td><td>'.$row['description'].'</td><td>'.$row['imagelist'].'</td><td>'.$row['expire_date'].'</td><td>'.'

    <button id="'.$row['product_id'].'" class="trash" >
    delete
    </button>

    '.'</td></tr>';
    }


?>
  </table>

  <script type="text/javascript">
  	
  	    $(function(){
        $('.trash').on('click',function(){
            var del_id= $(this).attr('id');
            var $ele = $(this).parent().parent();
            $.ajax({
                type:'POST',
                url:'delete.php',
                data:{'del_id':del_id},
                success: function(data){
                    if(data=="YES"){
                        $ele.fadeOut().remove();
                        }else{
                            alert("can't delete the row")
                        }
                    }
                })
            })
    });
  </script>
    </body>
  </html>
