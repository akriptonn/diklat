<!DOCTYPE html>

<?php
include('login.php'); // Memasuk-kan skrip Login 
?>

<html>
<head>
	<title> Kyou Hobby Shop</title>
	<link rel="stylesheet" type="text/css" href="style_index.css">
</head>
<body>
	<div id="main">
		<nav>
		 <img src="logo.jpg" width="200" height="90" align="left">
		 <h1 align="left"> Kyou Hobby Shop  </h1>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Products</a></li>
				<li><a href="#">About Us </a></li>
				<li><a href="regis.php">Sign Up</a></li>
				<li><form method="POST" action="">
				<b> Username     : <input type="text" name="user_name" placeholder="ex: Goldy123"> 
				<b> Password	: <input type="Password" name="pass_word" placeholder="********"> 
				<input type="submit" name="login" value="LOGIN" >
			</form>	</li>
			</ul>

		</nav>
	</div>
	<div class="container">
		<h1>Temukan Figure Idaman Anda</h1>
		<h2>di Kyou.id</h2><br>
		<a href="#" class="btn">Mulai</a>
	</div>

</body>
</html>
