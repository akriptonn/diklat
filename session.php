<?php
// Membangun Koneksi dengan Server dengan nama server, user_id dan password sebagai parameter
$username=$_POST["user_name"];
$connection = mysqli_connect("localhost", "user", "","kyou");
// Seleksi Database
//$db = mysql_select_db("tes_db", $connection);
session_start();// Memulai Session
// Menyimpan Session
$user_check=$_SESSION['login_user'];
// Ambil nama karyawan berdasarkan username karyawan dengan mysql_fetch_assoc
$ses_sql=mysqli_query($connection, "SELECT * from pembeli where username = '$username'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['username'];
if(!isset($login_session)){
mysqli_close($connection); // Menutup koneksi
//header('Location: index.php'); // Mengarahkan ke Home Page
}
?>