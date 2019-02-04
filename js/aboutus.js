
// ===========about-us===========
window.onload = function () {

  var slideIndex = 0;

  var next = document.getElementById("next");
  var prev = document.getElementById("prev");

  next.addEventListener("click", plusSlides);
  prev.addEventListener("click", minusSlides);


  showSlides(slideIndex);

  function plusSlides() {
    slideIndex++;

    if(slideIndex >= 4){
      slideIndex = 0;
   }

    showSlides(slideIndex);
  }

  function minusSlides() {
    slideIndex--;

    if(slideIndex < 0){
      slideIndex = 4 - 1
    }

    showSlides(slideIndex);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    // console.log(n);
    var i;
    var slides = document.getElementsByClassName("mySlides");

   console.log(n);

    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }

    slides[n].style.display = "block";

    
  }

};