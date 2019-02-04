<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ef8829"/>
    <link rel="manifest" href="manifest.json" />
    <script src="js/register.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- startup-screen iphone -->
    <link rel="apple-touch-startup-image" href="startup-screen.png">
    <!-- icon app iphone -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png">
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!--FONT-->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!--CSS STYLE-->
    <link rel="stylesheet" type="text/css" href="css/style-landingspage.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>FoodSavers</title>
    <script type="text/javascript" src="js/product-jq.js"></script>
    <script type="text/javascript" src="js/animatescroll.js"></script>

<script type="text/javascript" src="js/maps.js"></script>
</head>
<body onload="init()">
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
<!--HEADER SEARCHFIELD-->
<div class="landingspage-header-container">
    <img name="canvas">
    <div class="landingspage-header-searchfield">
        <h2>Stel uw postcode in:</h2>   
        <!-- <input id="query" type="text" name="postalcode" onkeydown= "zoeknu('index');" placeholder="Search.." autocomplete="off"> -->
    <div class="landingspage-inputWithIcon">
        <input id="query" type="text" name="postalcode" onkeydown= "zoeknu('index');" placeholder="voer u postcode in.." autocomplete="off">
        <p class="phid" id="lat">aa</p>
                    <p class="phid" id="lon">sas</p> 
        <i class="fas fa-map-marker-alt" aria-hidden="true"></i> <!--Aria-hidden = verbergt icon-->
    </div>
    </div>  
    <div class="landingspage-header-scroll-to animated bounce delay-3s">
    <a onclick="$('#landingspage-info-section-container').animatescroll({scrollSpeed:2000,easing:'easeOutBounce'});"><span style="font-size: 3rem; color: white;"><i class="fas fa-arrow-circle-down"></i></span></a>
    </div>   
</div>    
<!--INFO SECTION-->  
<div id="landingspage-info-section-container">
    <div class="landingspage-info-section-title">
        <h1>Wie zijn wij?</h1>
    </div>  
    <div class="landingspage-info-section-menu">
        <a onclick="$('#textAreaSection1').animatescroll({scrollSpeed:2000,easing:'easeInOutBack'});">Over ons</a> -
        <a onclick="$('#textAreaSection2').animatescroll({scrollSpeed:2000,easing:'easeInOutBack'});">Voor wie?</a> -
        <a onclick="$('#textAreaSection3').animatescroll({scrollSpeed:2000,easing:'easeInOutBack'});">Waarom</a> -
        <a onclick="$('#textAreaSection4').animatescroll({scrollSpeed:2000,easing:'easeInOutBack'});">Vriendjes worden?</a>
    </div>
    <div class="landingspage-info-section-text-area1" id="textAreaSection1">
        <h3>Over ons</h3>
        <p>Wij zijn FoodSavers. Een organisatie die zich sterkt maakt tegen voedselverspilling.</p>
        <img src="images/img-landingspage/landingspage-img1.png" width="200px" height="200px" alt="">
    </div>
    <div class="landingspage-info-section-text-area2" id="textAreaSection2">
        <h3>Voor wie?</h3>
        <p>FoodSavers is er voor iedereen die zich graag bezighoud met voedselverspilling. Niet alleen particulieren kunnen zich aanmelden, maar ook bedrijven, winkeliers of (sport)verenigingen</p>
    </div>
    <div class="landingspage-info-section-text-area3" id="textAreaSection3">
        <h3>Waarom?</h3>
        <p>Per jaar wordt er gemiddeld per persoon 41 kilo eetbaar voedsel weggegooid <a href="https://www.voedingscentrum.nl/Assets/Uploads/voedingscentrum/Documents/Professionals/Pers/Persmappen/Verspilling%202017/Factsheet%20Voedselverspilling%20huishoudens%20mei%202017%20(MC%20en%20VC).pdf" target="_blank">bron</a>. Niet alleen slecht voor het millieu, maar ook zeer onnodig omdat het meeste nog prima te gebruiken is. </p>
        <img src="images/img-landingspage/landingspage-img2.png" width="200px" height="200px" alt="">
    </div>
    <div class="landingspage-info-section-text-area4" id="textAreaSection4">
        <h3>Vriendjes worden?</h3>
        <p>Enthousiast geworden door bovenstaand verhaal? Meld je dan snel aan en begin! Toch nog twijfels? Laat het ons dan weten via ons <a href="contact.php">contactformulier</a>. We nemen dan zo spoedig mogelijk contact met je op.<br><br><a href="signin.php">Meld je hier aan!</a></p>
    </div>
    <a onclick="$('.landingspage-navbar-container').animatescroll({scrollSpeed:2000,easing:'easeInOutBack'});" id="top-button" ><i class="fas fa-arrow-circle-up"></i></a>
</div>


<!--SCRIPT FOR RANDOM IMAGE'S ON INDEX PAGE-->
<script src="js/js-index-page.js"></script>

<script>
function watchLocation(successCallback, errorCallback) {
  successCallback = successCallback || function(){};
  errorCallback = errorCallback || function(){};

  // Try HTML5-spec geolocation.
  var geolocation = navigator.geolocation;

  if (geolocation) {
    // We have a real geolocation service.
    try {
      function handleSuccess(position) {
        // successCallback(position.coords);
        
        $.ajax({
                type:'POST',
                url:'setsession.php',
                data:{lat:position.coords.latitude, lon:position.coords.longitude},
                success: function(data){
                    if(data=="YES"){
                         console.log('YESaass')
                        }else{
                            console.log('NOoooo')
                        }
                    console.log(data); 
               }
                })
      }

      geolocation.watchPosition(handleSuccess, errorCallback, {
        enableHighAccuracy: true,
        maximumAge: 5000 // 5 sec.
      });
    } catch (err) {
      errorCallback();
    }
  } else {
    errorCallback();
  }
}

function init() {
  watchLocation(function(coords) {
    alert('coords: ' + coords.latitude + ',' + coords.longitude);
    console.log("hi");
  }, function() {
    // alert('error');
  });
}

</script>
</body>
</html>