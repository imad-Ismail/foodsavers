$(function(){
    var a = document.getElementsByClassName('phid');
    
            $('#query').keypress(function(event){
                if (event.keyCode == 13){
        if (a[0].innerText > 3 ) {
        
        var lat = document.getElementById("lat").innerHTML;
        // console.log(lat);
        var lon = document.getElementById("lon").innerHTML;
        // console.log(lon);
            $.ajax({
                type:'POST',
                url:'setsession.php',
                data:{lat:lat, lon:lon},
                success: function(data){
                    if(data=="YES"){
                        console.log(data);
                        console.log("fghj");

                        // console.log('YESaass')
                        window.location.href = "products-page.php";
                        // setTimeout(function(){location.href="products-page.php"} , 2000);   
                        }else{
                            console.log('NOoooo')
                        }
                   // console.log(data); 
               }
                })
                  } }});
    });
 



$(document).ready(function() {
    $('li').click( function(e) {                    

         var type = $(this).attr('id');

        console.log(type);


        var dataString = 'product_type=' + type;

        $.ajax({

            type: "GET",
            url: "filter.php",
            data: dataString,
            dataType: 'html',
            cache: false,
            success: function(response) {
                    // console.log(response);
                    // alert(response);
                    document.getElementById("products-container").innerHTML = response;
                                var cards = $("#products-container .card");
    var temp = cards.sort(function(a,b){
      return parseInt($(a).attr("afstand")) - parseInt($(b).attr("afstand"));
    });
    $("#products-container").html(temp);


                }
        });

        return false;

    });

});


$(document).on('click', '.option-btn', function (){
    $(this).toggleClass('open');
    $('.control-center').toggleClass('open');
});