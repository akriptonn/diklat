<?php
	header('Refresh: 5;URL = dash_karyawan.php',true,302);
?>

<!DOCTYPE html>
<html>
<head>
	<title> Kyou Hobby Shop</title>
	<link rel="stylesheet" type="text/css" href="style_restock.css">
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
				<li> <b>Welcome <?php session_start(); echo $_SESSION['login_user']; ?> </li>
			</ul>
		</nav>
	</div>
	<div class="container">
		<h1 align="center">Data Berhasil Dimasukkan!</h1>	
	</div>
</body>
</html>