<?php
	session_start();

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
	<link rel="stylesheet" type="text/css" href="style_send.css">
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
		<h1 align="center">Status Pemesanan</h1>
			<form action="cek_status.php" method="get">


				<label>Filter: </label> <br>


				<label>Status Pembayaran: </label>
				<select name="status_bayar">
				  <option value="">None</option>
				  <option value="BELUM LUNAS">Belum Lunas</option>
				  <option value="LUNAS">Lunas</option>
				</select>

				<br>

				<label>Status Pengiriman: </label>
				<select name="status_kirim">
				  <option value="">None</option>
				  <option value="1">Belum Dikirim</option>
				  <option value="2">Belum Diterima</option>
				  <option value="3">Sudah Diterima</option>
				</select>

				<br><br>

				<label>Rows in a page:</label>

				<select  name="limit">
				  <option value="10" selected>10</option>
				  <option value="50">50</option>
				  <option value="100">100</option>
				</select>

				<br><br>

				<input type="submit" value="Show" class="btn">

			</form>

			<form action="dash_karyawan.php" method="post">

				<input type="submit" value="Kembali ke dashboard" class="btn">

			</form>

			<br><br>

		
	

<!/body>
<!/html>

<?php

	$sql = "SELECT * FROM status";

		if((isset($_GET['search']) && $_GET['search'] != "") || (isset($_GET['status_bayar']) && $_GET['status_bayar'] != "") || (isset($_GET['status_kirim']) && $_GET['status_kirim'] != ""))
		{

			 $sql = $sql . " WHERE";

			// if(isset($_GET['search']) && $_GET['search'] != ""){
			// 	$find = $_GET['search'];
			// 	//$sql = $sql . " WHERE name LIKE '%" . $find . "%'";
			// 	$sql = $sql . " UPPER(pembeli) LIKE UPPER('%" . $find . "%') OR UPPER(nama_barang) LIKE UPPER('%" . $find . "%') OR UPPER(pengirim) LIKE UPPER('%" . $find . "%') OR telp_penerima LIKE '%" . $find . "%' OR UPPER(alamat) LIKE UPPER('%" . $find . "%') OR waktu_kirim LIKE '%" . $find . "%' OR waktu_terima LIKE '%" . $find . "%'";
			// 	if(isset($_GET['status_bayar']) && $_GET['status_bayar'] != "") || (isset($_GET['status_kirim']) && $_GET['status_kirim'] != ""){
			// 		$sql = $sql . " AND";
			// 	}
			// }

			

			if(isset($_GET['status_bayar']) && $_GET['status_bayar'] != "") {
				$sql = $sql . " ket_status = '" . $_GET['status_bayar'] . "'";
				if(isset($_GET['status_kirim']) && $_GET['status_kirim'] != ""){
					$sql = $sql . " AND";
				}
			}
			

			if(isset($_GET['status_kirim']) && $_GET['status_kirim'] != "") {
				if($_GET['status_kirim'] == '1'){
					$sql = $sql . " waktu_kirim IS NULL AND waktu_terima IS NULL";
				} else if ($_GET['status_kirim'] == '2'){
					$sql = $sql . " waktu_kirim IS NOT NULL AND waktu_terima IS NULL";
				} else if ($_GET['status_kirim'] == '3'){
					$sql = $sql . " waktu_kirim IS NOT NULL AND waktu_terima IS NOT NULL";
				}
			}

		}

		$sql = $sql . " ORDER BY invoice DESC";

		if(isset($_GET['limit'])){
			$sql = $sql . " LIMIT " . $_GET['limit'];	
		} else {
			$sql = $sql . " LIMIT 10";	
		}



	$result = $connection->query($sql);

	if ($result->num_rows > 0) {
?>

<table cellpadding ="5" cellspacing ="0" border ="7" style:"color:#0066cc;" align="center">
		<tr>
			<th>Invoice</th>
			<th>Pembeli</th>
			<th>Nama Barang</th>
			<th>Jml Beli</th>
			<th>Total</th>
			<th>Status Pembayaran</th>
			<th>Resi</th>
			<th>Waktu Kirim</th>
			<th>Waktu Terima</th>
			<th>Jasa Kurir</th>
			<th>Telp. Penerima</th>
			<th>Alamat Penerima</th>
			<th>Pengirim</th>
		</tr>

<?php
		//$i = 1;
		while($row = $result->fetch_assoc()) {
			//echo "Nama: " . $row["nama"]. " - Telepon: " . $row["telepon"]. " - Alamat: " . $row["alamat"]. "<br>";
?>

		<tr>
			<td> <?php echo $row["invoice"]; ?> </td>
			<td><?php echo $row["pembeli"]; ?> </td>
			<td><?php echo $row["nama_barang"]; ?> </td>
			<td><?php echo $row["jml_pembelian"]; ?> </td>
			<td><?php echo $row["total"]; ?> </td>
			<td><?php echo $row["ket_status"]; ?> </td>
			<td><?php echo $row["resi"]; ?></td>
			<td><?php echo $row["waktu_kirim"]; ?></td>
			<td><?php echo $row["waktu_terima"]; ?></td>
			<td><?php echo $row["kurir"]; ?></td>
			<td><?php echo $row["telp_penerima"]; ?></td>
			<td><?php echo $row["alamat"]; ?></td>
			<td><?php echo $row["pengirim"]; ?></td>
		</tr>
		
<?php
		//$i = $i + 1;
		}
?>

		</table>

<?php
	} else {
		echo "0 results";
	}
	
	 mysqli_close($connection);
     
?>

</div>
</body>
</html>