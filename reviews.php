<html>
<head>
	<title>review test</title>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script>

</script>
</head>
<body>
	<?php
require_once "db-connection.php";
$pid= $_SESSION['user_reviews']; //user id - die je wil raten
$uid= $_SESSION['user_id']; //ingelode id
$sql=$conn->prepare("SELECT * FROM fdlikes WHERE pid=? and user=?");
$sql->execute(array($pid, $uid));
if($sql->rowCount()==1){
 echo '<a href="#" class="like" id="'.$pid.'" title="Unlike">Unlike</a>';
}else{ 
 echo '<a href="#" class="like" id="'.$pid.'" title="Like">Like</a>';
}
?>

<script type="text/javascript">$(document).ready(function(){
 $(document).on('click', '.like', function(){if($(this).attr('title') == 'Like'){ $that = $(this);
   $.post('action.php', {pid:$(this).attr('id'), action:'like'},function(){  $that.text('Unlike');  $that.attr('title','Unlike'); });}else{ if($(this).attr('title') == 'Unlike'){  $that = $(this);
    $.post('action.php', {pid:$(this).attr('id'), action:'unlike'},function(){  $that.text('Like');  $that.attr('title','Like'); }); }} });});</script>
</body>
</html>