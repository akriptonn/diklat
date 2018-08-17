<?php
	session_start();

	$dbname="diklat";
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
		 <h1 align="left"> Diklat E-Monev  </h1>
			<ul>
				<li><a href="index.php">Home</a></li>
			</ul>
		</nav>
	</div>


	<div class="container">
		<h1 align="center">Tabel</h1>
			<form action="showDiklat.php" method="get">
				<label>Filter: </label> <br>


				<label>Urutkan berdasarkan </label>
				<select name="sorts">
				  <option value="">None</option>
				  <option value="NIP">Nomor Induk Pegawai</option>
				  <option value="cname">Nama</option>
				  <option value="TanggalLahir">Tanggal Lahir</option>
				</select>

				<br>

				<label>Rows in a page:</label>

				<select  name="limit">
				  <option value="10" selected>10</option>
				  <option value="50">50</option>
				  <option value="100">100</option>
				</select>

				<br><br>

				<input type="submit" value="Show" class="btn">

			</form>

			<br><br>

		
	

<!/body>
<!/html>

<?php

	$sql = "SELECT * FROM mymember";

		if((isset($_GET['sorts']) && $_GET['sorts'] != ""))
		{

			 $sql = $sql . " ORDER BY " . $_GET['sorts'] ." ASC";

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
			<th>Nomor Induk Pegawai</th>
			<th>Nama Pegawai</th>
			<th>Tanggal Lahir</th>
		</tr>

<?php
		//$i = 1;
		while($row = $result->fetch_assoc()) {
			//echo "Nama: " . $row["nama"]. " - Telepon: " . $row["telepon"]. " - Alamat: " . $row["alamat"]. "<br>";
		if ((!($row["NIP"]==""))&&(!($row["NIP"]==" "))&&(!($row["NIP"]=="0"))){	
?>

		<tr>
			<td> <?php echo $row["NIP"]; ?> </td>
			<td><?php echo $row["cname"]; ?> </td>
			<td><?php echo $row["TanggalLahir"]; }?> </td>
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