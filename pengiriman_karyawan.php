<?php
	session_start();

	$dbname="kyou";
	$dbuser="user";
	$dbhost="localhost";
	$dbpass="";

	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$barang = "SELECT * FROM pengiriman where waktu_kirim is NULL";

	$result = $connection->query($barang);
?>

<!DOCTYPE html>
<html>
<head>
	<title> Kyou Hobby Shop</title>
	<link rel="stylesheet" type="text/css" href="sending.css">
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
				</form>
				</li>
			</ul>
		</nav>
	</div>
	<div class="container">
		<h1 align="center">Informasi Pengiriman:</h1>
		<form method="POST" align="center" action="">
			<b>Nomor Invoice:</b><br>
			<!input type="text" name="invoice"><br>
			<select name="invoice">
			<option value="">--Silahkan Pilih--</option>

			<?php 
			while($row = $result->fetch_assoc()){
				//if ($row['stok']>0){
				echo "<option value= " . $row['invoice'] . ">" . $row['invoice'] . "</option>";
				//}
			}

			?>

		</select><br><br>
			
			<b>Jenis pengiriman: </b><br>
			<select name="jenis_kirim">
				<option value="">--Pilih--</option>
				<option value="Go-Send">Go-Send</option>
				<option value="JNE">JNE</option>
			</select><br>
			<input type="submit" name="input" value="MASUKKAN" class="btn">
		</form>
	</div>
</body>
</html>

<?php
	if (isset($_POST["input"])) {
		if (empty($_POST["invoice"]) || $_POST["jenis_kirim"] == "") {
			$_SESSION["wrong"]='1';	
		}
		else{
			$invoice=$_POST["invoice"];
			//$time_sent=$_POST["waktu_kirim"];
			//$time_received=$_POST["waktu_terima"];

			$jenis_pengiriman= "UPDATE pengiriman set kurir = '" .  $_POST['jenis_kirim'] . "' where invoice = $invoice";
			$waktu_pengiriman= "UPDATE pengiriman set waktu_pengiriman = current_timestamp  where invoice = $invoice";

			//if (isset($_POST["jenis_kirim"])) {
				//$isi_pengiriman = $isi_pengiriman . $_POST["jenis_kirim"] . ")";
				$hasil = mysqli_query($connection, $jenis_pengiriman);
				$hasil2 = mysqli_query($connection, $waktu_pengiriman);

				$SESSION['wrong']='0';
				//$_SESSION['login_user']=$username;
				header("location: berhasil.php");
			//}	
		}
	}
	if (isset($_POST["logout"])) {
		header("location: logout.php");
	}
?>
