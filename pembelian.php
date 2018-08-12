<?php
	session_start();
	$dbname="kyou";
	$dbuser="user";
	$dbhost="localhost";
	$dbpass="";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	$barang = "SELECT * FROM barang";

	$result = $connection->query($barang);

?>
<!DOCTYPE html>
<head>
	<title> Kyou Hobby Shop</title>
	<link rel="stylesheet" type="text/css" href="style_pembelian.css">
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
		<form method="GET" align="center" action="">
		<h1>Pembelian Barang</h1>
		<br>
		<select name="list_barang">
			<option value="">--Silahkan Pilih--</option>

		<?php 
		while($row = $result->fetch_assoc()){
			if ($row['stok']>0){
			echo "<option value= " . $row['id_bar'] . ">" . $row['nama'] . "</option>";
			}
		}

		?>

		</select>
		<br><br>
		<b>Jumlah   : <br></b> <input type="text" name="jumlah_beli"><br><br>
		<b><t> Metode Bayar <br>
		<input type="radio" name="payment" value="Credit Card">Credit Card <br>
		<input type="radio" name="payment" value="Bank Transfer">Bank Transfer<br>
		<input type="radio" name="payment" value="Cash">Cash<br><br>
		<input type="submit" name="submit" value="Continue">
		</form>	
	</div>
</body>
</html>

<?php
	if(isset($_GET["submit"])){
		if (empty($_GET["jumlah_beli"]) || $_GET["list_barang"] =="--Silahkan Pilih--" || empty($_GET['payment'])) {
			$_SESSION["ngaco"] = '1';
			echo "Harap memilih data, dan memasukkan jumlah barangnya!";
		}
		else{
			//$'jumlahbeli'=$_GET['jumlah_beli'];
			$_SESSION['jumlahbeli']=(int)$_GET['jumlah_beli'];
			//$_SESSION['pembayaran']= $_GET['CreditCard'] ? "Credit Card" : ($_GET['BankTransfer']? "Bank Transfer" : "Cash");
			$_SESSION['pembayaran']=$_GET['payment'];

			//$bayar_credit = $_GET['CreditCard'];
			//$bayar_trf = $_GET['BankTransfer'];
			//$bayar_cash = $_GET['Cash'];

			// $dbname="kyou";
			// $dbuser="user";
			// $dbhost="localhost";
			// $dbpass="";
			// $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			// $barang = "SELECT * FROM barang";

			if(isset($_GET['list_barang'])) {
				$_SESSION['namabarang'] = $_GET['list_barang'];
				
				 $barang = $barang . " WHERE id_bar = " . $_GET['list_barang'];			
				$result = mysqli_query($connection, $barang);
				$row = $result->fetch_assoc();
				if( (mysqli_num_rows($result)==1) && ( $row['stok']>=(int)$_GET['jumlah_beli'] ) ){
				//	$berkurang_stok = "UPDATE barang set stok=stok - " . $_SESSION['jumlahbeli'];
				//	$berkurang_stok = $berkurang_stok . " where id_bar= " . $_GET['list_barang'];
				//	mysqli_query($connection,$berkurang_stok);				
					header("location: pengiriman_pembeli.php");
					$_SESSION['totalharga'] = $row['harga'] * $_GET['jumlah_beli'];
				}else {
				echo "Stok tidak cukup";	
				}
				$SESSION['ngaco'] = '0';
			}
			
		}
	}
?>
