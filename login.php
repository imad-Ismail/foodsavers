<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
 <?php
    include "hamburger-menu.php";
?>  
    <!--NAVBAR-->
<div class="landingspage-navbar-container">
    <div class="navbar-logo animated bounceInUp">
        <img src="images/logo-foodsavers.png" alt="logo">
    </div>
    <div class="navbar-hamburger-menu animated bounceInUp">
        <span onclick="openNav()">&#9776;</span>
    </div>
</div>
	<div class="formDiv">
				<form action="loginform.php" method="post"> 
				<h1>Login</h1>
			<div class="input">
				<input type="text" name="email" autofocus placeholder="E-mail">
					<br>
						<?php 
					if(isset($_GET['errorCode'])){
						echo $_GET['errorCode'];
					}
				 ?>
				<br>
				<input type="password" name="password" placeholder="paswoord">
				<br>
				<button type="submit" class="loginbtn">Login</button>
				<a href="password-forgotten.php">paswoord vergeten</a>
			</div>
		</form>
	</div>		
</body>
</html>