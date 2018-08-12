<!DOCTYPE html>
<html>
<head>
	<title> Kyou Hobby Shop</title>
	<link rel="stylesheet" type="text/css" href="pemesan.css">
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
		<h1 align="center">Pemesanan Berhasil!</h1>
		<form method="POST" align="center">
		<input type="submit" name="beliLagi" value="Beli Lagi">
		<input type="submit" name="out" value="Keluar">
		</form>
	</div>
</body>
</html>
<?php
	if (isset($_POST["beliLagi"])) {
		$_SESSION['login_user']=$username;
		header("location: pembelian.php");
	}
	elseif (isset($_POST["out"])) {
		$_SESSION['login_user']=$username;
		header("location: logout.php");
	}
?>