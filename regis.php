<?php

	//session_start();

	$dbname="kyou";
	$dbuser="user";
	$dbhost="localhost";
	$dbpass="";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

?>

<!DOCTYPE html>

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
				<li><a href="#">Sign Up</a></li>
			</ul>

		</nav>
	</div>
	<div class="container">
		<h1>Pendaftaran Pembeli</h1> <br><br>
		<form method="GET" align="center">
			<b> Username 				 : <br><input type="text" name="username" placeholder="ex: achton"> <br><br>

			<b> Password 				 : <br><input type="Password" name="password" placeholder="********"> <br><br>

			<b> Masukkan kembali password: <br><input type="Password" name="password1" placeholder="********"> <br><br>			

			<b> Nama  	  				 : <br><input type="text" name="nama" placeholder="ex: Achmad kripton"> <br><br>

			<b> No. HP 	  				 : <br><input type="text" name="no_hp" placeholder="ex: 087823651211"> <br><br>

			<b><t> Alamat: <br><textarea rows="5" cols="50" name="alamat"></textarea> <br><br>

			<input type="submit" name="submit" value="Daftar" class="btn">
		</form>
	</div>

</body>
</html>

<?php

	if(isset($_GET['submit'])){
		$username = $_GET['username'];

		$dupe = mysqli_query($connection, "SELECT * FROM akun WHERE username = '$username'");
		if(mysqli_num_rows($dupe) != 0){
			echo "Username sudah ada! Mohon pilih username lain";
		} else {
			if($_GET['password'] != $_GET['password1']){
				echo "Passwords do not match!";
			}else {

				$sql = "INSERT INTO akun(username, password, jenis_akun) VALUES ('" . $_GET['username'] . "','" . $_GET['password'] . "','pembeli')";
				mysqli_query($connection, $sql);

				$sql1 = "INSERT INTO pembeli(username, nama, hp) VALUES ('" . $_GET['username'] . "','" . $_GET['nama'] . "','" . $_GET['no_hp'] . "')";
				mysqli_query($connection, $sql1);

				echo "registered";
				header("location: index.php");
			}
		}

	}


?>
