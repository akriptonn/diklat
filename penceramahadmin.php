<?php
ob_start();
session_start();
if(!isset($_SESSION['akun_id'])) header("location: login.php");
elseif($_SESSION['akun_status']=="0"){
  header("location: option.php");
}
elseif($_SESSION['akun_status']=="2"){
  header("location: evaluator.php");
}

global $koneksi;
$nameserver = "localhost";
$username = "root";
$password = "";
$namedb = "login";

$koneksi = mysqli_connect($nameserver,$username,$password,$namedb);
if(!$koneksi) {
  die("Koneksi gagal".mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="kemnakerri.jpg">
  <title>Hasil Penceramah</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="jumbotron" style="background-color:rgb(34, 80, 90); color:white">
    <h1>Pusdiklat Pegawai Kemnaker RI</h1>      
    <h2>Hasil penceramah</h2>
    <button onclick="location.href='penceramahindividu.php'" type="button" class="btn btn-block btn-lg btn-block" style="color:rgb(34, 80, 90)">Individu</button>
    <button onclick="location.href='penceramahperingkat.php'"type="button" class="btn btn-block btn-lg btn-block" style="color:rgb(34, 80, 90)">Peringkat</button>
    <button onclick="location.href='penceramahgrafik.php'" type="button" class="btn btn-block btn-lg btn-block" style="color:rgb(34, 80, 90)">Grafik</button>
    <br>    
    <button onclick="location.href='lihatevaluasi.php'"type="button" class="btn btn-block btn-lg btn-block" style="color:rgb(34, 80, 90)">Kembali</button>
  </div>  
</div>

</body>
</html>
<?php
mysqli_close($koneksi);
ob_end_flush();
?>