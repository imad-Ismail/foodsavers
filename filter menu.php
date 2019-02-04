<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>1</title>
<link rel="stylesheet" type="text/css" href="css/filter menu.css">
<script type="text/javascript" src="js/jq.js"></script> 

</head>

<body>


<div class="control-center">
    <ul class="right-sidebar">

         <input id="products-input" class="inputfilter" type="text" placeholder="zoek u product" onkeyup="keyupFunction()">

    </ul>
<div class="option-btn"></div>
    <ul id="menu" class="left-sidebar">
        <li id="groenten"></li>
        <li id="fruit"></li>
        <li id="alles"></li>
    </ul>
</div>
<script type="text/javascript">
    $(document).on('click', '.option-btn', function (){
    $(this).toggleClass('open');
    $('.control-center').toggleClass('open');
});
</script>
</body>
</html>