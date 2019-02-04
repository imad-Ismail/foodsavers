//=============filteren============
function keyupFunction() {
  var x = document.getElementById("products-input").value;
  getFilteredsearch(x)
};

//=========delet-product===========
$(function(){
        $('.trash').on('click',function(){
            var del_id= $(this).attr('id');
            var $ele = $(this).parent().parent().parent().parent();
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
//HAMBURGER MENU

function openNav() {
    document.getElementById("myNav").style.width = "100%";
    document.getElementById('navblock').style.display = 'none'

};
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    document.getElementById('navblock').style.display = 'block';
};


// var acc = document.getElementsByClassName("filter-dropdown");
// var i;

// for (i = 0; i < acc.length; i++) {
//   acc[i].addEventListener("click", function() {
//     this.classList.toggle("active");
//     var panel = this.nextElementSibling;
//     if (panel.style.display === "block") {
//       panel.style.display = "none";
//     } else {
//       panel.style.display = "block";
//     }
//   });
// }

