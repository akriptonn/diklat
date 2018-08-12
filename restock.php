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
				<li> <b>Welcome <?php session_start(); echo $_SESSION['login_user']; ?></li>
			</ul>
		</nav>
	</div>
	<div class="container">
		<h1 align="center">RESTOCK:</h1>
		<form method="POST" align="center" action="">
			<b>ID Barang: </b> <br><input type="text" name="id_barang">
			<br>
			<b>Nama Barang: </b> <br><input type="text" name="nama_barang">
			<br>
			<b>Jumlah Barang: </b> <br><input type="text" name="jumlah_barang">
			<br>
			<b>Harga Barang: </b> <br><input type="text" name="harga_barang">
			<br><br>
			<input type="submit" name="submit" value="Masukkan">
		</form>

		
	</div>
</body>
</html>

<?php
	//session_start();
	$salah='';
	if(isset($_POST["submit"])) {
		if (empty($_POST["id_barang"]) && (empty($_POST["jumlah_barang"])||empty($_POST['harga_barang']))) {
			$salah=  "ID dan Jumlah atau Harga barang harus terisi!"; 
		}else{
			$idbarang=$_POST['id_barang'];
			$jumlah=$_POST['jumlah_barang']? $_POST['jumlah_barang'] : NULL;
			$namabarang=$_POST['nama_barang'];
			$hargabarang=$_POST['harga_barang']? $_POST['harga_barang'] : NULL;

			$dbname="kyou";
			$dbuser="user";
			$dbhost="localhost";
			$dbpass="";

			$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			$barang = mysqli_query($connection, "SELECT * FROM barang where id_bar=$idbarang");

			$row_barang=mysqli_num_rows($barang);
			$ket = "";

			if($row_barang == 1){
				if($jumlah != NULL){
					$bertambah_stok = mysqli_query($connection, "UPDATE barang set stok=stok+$jumlah where id_bar=$idbarang");
					$ket = $ket . "-> Restock ID $idbarang: $jumlah unit";
					if($hargabarang != NULL){
						$ket = $ket . "\n";
					}
				}
				if($hargabarang != NULL){
					$update_harga = mysqli_query($connection, "UPDATE barang set harga=$hargabarang where id_bar=$idbarang"); 
					$ket = $ket . "-> Update harga ID $idbarang: Rp $hargabarang";
				}
			}else{
				$newbarang=mysqli_query($connection, "INSERT INTO barang value ($idbarang,'$namabarang',$hargabarang, $jumlah)");

				$ket = "Barang baru:";
				$ket = $ket . "\n-> ID: '$idbarang'";
				$ket = $ket . "\n-> Nama: '$namabarang'";
				$ket = $ket . "\n-> Jumlah: '$jumlah' unit";
				$ket = $ket . "\n-> Harga: Rp '$hargabarang"; 

			}

			$user = $_SESSION['login_user'];
				
			$pegawai = mysqli_query($connection, "SELECT * FROM pegawai where username = '$user'");
			$id = $pegawai->fetch_assoc();
			$id_pegawai = $id['id_peg'];

			//echo $ket; echo "<br>";
			//echo $user; echo "<br>";
			//echo $id_pegawai; echo "<br>";
			mysqli_query($connection, "INSERT INTO restock VALUES ($idbarang, $id_pegawai, '$ket')");

		 echo "Data Berhasil Ditambahkan";
		 header("location: berhasil_restock.php");
		}
	} 
	if (isset($_POST["logout"])) {
		header("location: logout.php");
	}
?>
	