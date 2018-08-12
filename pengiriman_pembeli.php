<?php
session_start();

$dbname="kyou";
$dbuser="user";
$dbhost="localhost";
$dbpass="";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$alamat = "SELECT nama, hp, alamat FROM (punya natural join penerima) natural join tujuan where username = '". $_SESSION['login_user'] . "'";

$result = $connection->query($alamat);
//sort($result);
?>



<!DOCTYPE html>
<html>
<head>
	<title> Kyou Hobby Shop</title>
	<?php
		//echo $_SESSION['login_user'];
	?>
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
			</ul>
		</nav>
	</div>
	<div class="container">
		<form method="GET" align="center">
			<h1>Pengiriman Barang</h1>

			<b> Nama dan No. HP Penerima   : <br><!input type="text" name="nama_penerima" placeholder="ex: Achmad kripton"> <br><br>
			<select name="list_penerima">
				<option value="">--Silahkan Pilih--</option>

		<?php
			while($row = $result->fetch_assoc()){
				echo "<option value= " . $row['hp'] . ">" . $row['nama'] .", " . $row['hp'] . "</option>";

			}
		?>
		</select>
		<br><br> 
			<b><t> Alamat Penerima:  <br><!textarea rows="10" cols="50" name="alamat"><!/textarea> <br>
				<select name="list_alamat">
				<option value="">--Silahkan Pilih--</option>

		<?php 

			$result = $connection->query($alamat);

			while($row = $result->fetch_assoc()){
				echo "<option value= '" . $row['alamat'] . "'>" . $row['alamat'] . "</option>";

			}

		?>
	</select><br><br>
			<input type="submit" name="submit" value="Kirimkan">
			<input type="submit" name="create" value="Buat Penerima baru">
		</form>
	</div>
</body>
</html>
<?php
	//echo $_SESSION['login_user'];
	$salah="";
	if(isset($_GET["submit"])){
		if (empty($_GET["list_penerima"]) || empty($_GET["list_alamat"])) {
			$salah=  "Masukkan Input terlebih dahulu!";
			echo $salah;
		}
		else{
			//$nama_penerima=$_GET['nama_penerima'];
			//$hp=$_GET["hp_penerima"];
			//$alamat=$_GET["alamat"];
			$nama_penerima = $_GET['list_penerima'];
			$alamat			= $_GET['list_alamat'];
			$total_harga = $_SESSION['totalharga'];
			$bod = $_SESSION['jumlahbeli'];
			$bod2 = $_SESSION['pembayaran'];
			$bod3 = $_SESSION['login_user'];
			$sql = "INSERT INTO pembelian(jml_pembelian, metode_bayar, ket_status, ongkir, total, username) VALUES ('$bod','". $bod2 ."','BELUM LUNAS',5000,'$total_harga','$bod3')";
			$test = $connection -> query($sql);
			$bod3 = mysqli_insert_id($connection);
			if (!$test){
				echo "Please chech your data!";
			}
			else{
				echo $bod3;
				$bod4 = $_SESSION['namabarang'] ;
				echo "Data Berhasil Ditambahkan";
				$sql2 = "INSERT INTO BERISI VALUES ( '$bod3' , '$bod4')";
				$test = mysqli_query($connection, $sql2);
				if (!$test){
				echo "error";}
				$sql2 = "INSERT INTO pengiriman(invoice,penerima,pengirim,alamat) VALUES ('$bod3' , '$nama_penerima', 1 ,'$alamat')";
				$test = mysqli_query($connection, $sql2);
				$berkurang_stok = "UPDATE barang set stok=stok - " . $_SESSION['jumlahbeli'];
				$berkurang_stok = $berkurang_stok . " where id_bar= " . $bod4;
				mysqli_query($connection,$berkurang_stok);	
				header("location: pemesanan_berhasil.php");
			}
		}
	}
	if(isset($_GET["create"])){
		header("location: create_penerima.php");	
	}
	/*
	else if (isset($_POST["logout"])) {
		$_SESSION['login_user']=$username; 
		header("location: index.php");	
		}	
	*/
?>
