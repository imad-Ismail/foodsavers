// Random background image's on index.php page

//Array met alle achtergrond afbeeldigen
var imageArray = ["images/img-landingspage/landingspage-header-bg-image1.jpg","images/img-landingspage/landingspage-header-bg-image2.jpg","images/img-landingspage/landingspage-header-bg-image3.jpg","images/img-landingspage/landingspage-header-bg-image4.jpg","images/img-landingspage/landingspage-header-bg-image5.jpg"];

// Functie die kiest uit de afbeeldingen uit de variabele imageArray
window.onload = function showImages() {

    var number = Math.floor(Math.random() * 5);
    document.canvas.src = imageArray[number];
}

// JAVASCRIPT FOR GO TO TOP BUTTON

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
    document.getElementById("top-button").style.display = "block";
  } else {
    document.getElementById("top-button").style.display = "none";
  }
}