<!DOCTYPE html>
<html>
<head>
	<title> Kyou Hobby Shop </title>
	<link rel="stylesheet" type="text/css" href="style_restock.css">
</head>
<body>
	<div id="main">
		<nav>
		 <img src="logo.jpg" width="200" height="90" align="left">
		 <h1 align="left"> Kyou Hobby Shop  </h1>
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="#">Products</a></li>
				<li><a href="#">About Us </a></li>
				<li> <b>Welcome <?php session_start(); echo $_SESSION['login_user']; ?></li>
			</ul>
		</nav>
	</div>
	<div class="container">
		<form method="POST" align="center">
			<h1>Buat data penerima <?php echo $_SESSION['login_user'];?></h1>
			<b> Nama Penerima   : <br><input type="text" name="nama_penerima" placeholder="ex: Achmad kripton"> <br><br>
			<b>No.HP Penerima   : <br></b> <input type="text" name="hp_penerima" placeholder="ex:081234567890"><br><br>
			<b><t> Alamat Penerima: <br><textarea rows="10" cols="50" name="alamat"></textarea> <br>
			<input type="submit" name="submit" value="Tambahkan">
		</form>
	</div>
</body>
</html>
<?php
	//session_start();
	$salah="";
	if(isset($_POST["submit"])){
		if (empty($_POST["nama_penerima"]) || empty($_POST["hp_penerima"]) || empty($_POST["alamat"])) {
			$salah=  "Masukkan Input terlebih dahulu!";
		}
		else{
			$nama_penerima=$_POST['nama_penerima'];
			$hp=$_POST["hp_penerima"];
			$alamat=$_POST["alamat"];
			$dbname="kyou";
			$dbuser="user";
			$dbhost="localhost";
			$dbpass="";
			$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			echo $hp;
			$penerima = mysqli_query($connection, "INSERT INTO penerima values ('$hp','$nama_penerima')");
			$penerima2 = mysqli_query($connection, "INSERT INTO tujuan values ('$hp','$alamat')");
		
		if ($penerima || $penerima2){	
			$bod = $_SESSION['login_user'];
			$penerima = mysqli_query($connection, "INSERT INTO punya values ('$bod','$hp');");
			
			header("location: pengiriman_pembeli.php");	
			echo "Data Berhasil Ditambahkan";
		}
		
		}
	}
	/*
	else if (isset($_POST["logout"])) {
		$_SESSION['login_user']=$username; 
		header("location: index.php");	
		}	
	*/
?>
