 function getFilteredsearch(name){
    var data_file2 = "filtersearch.php?title="+ name;
    console.log(data_file2)

    var http_request = new XMLHttpRequest();
    try{
       // Opera 8.0+, Firefox, Chrome, Safari
       http_request = new XMLHttpRequest();
    }catch (e){
       // Internet Explorer Browsers
       try{
          http_request = new ActiveXObject("Msxml2.XMLHTTP");
            
       }catch (e) {
        
          try{
             http_request = new ActiveXObject("Microsoft.XMLHTTP");
          }catch (e){
             // Something went wrong
             alert("Your browser broke!");
             return false;
          }
            
       }
    }
    
    http_request.onreadystatechange = function(){
    
       if (http_request.readyState == 4){

          var dbinfo = http_request.responseText;          
          console.log(dbinfo);
          document.getElementById("products-container").innerHTML = this.responseText;
          var cards = $("#products-container .card");
    var temp = cards.sort(function(a,b){
      return parseInt($(a).attr("afstand")) - parseInt($(b).attr("afstand"));
    });
    $("#products-container").html(temp);
          //show info on page..
         

       }else{
           //console.log(http_request.readyState);
       }
    }
    
    http_request.open("GET", data_file2, true);
    http_request.send();
    // console.log(http_request)
 }