<?php
session_start();
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
				<li> <b>Welcome <?php echo $_SESSION['login_user']; ?></li>
				<li>
				<form method="POST">
					<input type="submit" name="logout" value="LOGOUT">
				</form> </li>
			</ul>
		</nav>
	</div>
	<div class="container">
		<h1 align="center">Pilih:</h1>
		<form method="POST" align="center" action="">
			<input type="submit" name="restock" value="RESTOCK" class="btn">
			<input type="submit" name="kirim" value="SEND" class="btn">
			<input type="submit" name="cek" value="CEK PEMESANAN" class="btn">
		</form>
	</div>
</body>
</html>
<?php
//session_start();
//echo $_SESSION['login_user'];
	if (isset($_POST["restock"])) {
		//$_SESSION['login_user']=$username; 
		header("location: restock.php");	
	}
	else if(isset($_POST["kirim"])){
		//$_SESSION['login_user']=$username; 
		header("location: pengiriman_karyawan.php");		
	} else if(isset($_POST["cek"])){
		header("location: cek_status.php");
	}
	else if(isset($_POST["logout"])){
		header("location: logout.php");
	}
?>