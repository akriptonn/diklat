<?php
session_start(); 
$error='';
if (isset($_POST['login'])) {
	if (empty($_POST['user_name']) ) {
		$error = "Masukkan username/password yang benar";
	}
	else{
		$username=$_POST['user_name'];
		$password=$_POST['pass_word'];
		$dbname="kyou";
		$dbuser="user";
		$dbhost="localhost";
		$dbpass="";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		$user = mysqli_query($connection, "SELECT * FROM akun where username = '$username' and password = '$password'");
		$rows = mysqli_num_rows($user);
		$tup = $user->fetch_assoc();

		if($rows != 0){
			$_SESSION['login_user']=$username; 
			if ($tup['jenis_akun'] == 'pembeli') {
				header("location: pembelian.php"); 
				 }
			else if ($tup['jenis_akun'] == 'karyawan' || $tup['jenis_akun'] == 'pemilik') {
				header("location: dash_karyawan.php"); 
				}
		} else {
			$error = "Username belum terdaftar";
		}
	mysqli_close($connection); 
	}
}
?>