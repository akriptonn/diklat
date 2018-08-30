<?php
ob_start();
session_start();
if(isset($_SESSION['akun_username'])) header("location: option.php");

$koneksi;
$nameserver = "localhost";
$username = "root";
$password = "";
$namedb = "login";

$koneksi = mysqli_connect($nameserver,$username,$password,$namedb);
if(!$koneksi) {
  die("Koneksi gagal".mysqli_connect_error());  
}

/*Proses Login*/
if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql_login = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$username' AND password ='$password' ");

  if(mysqli_num_rows($sql_login)>0) {
    $row_akun = mysqli_fetch_array($sql_login);
    $_SESSION['akun_id'] = $row_akun['id'];
    $_SESSION['akun_username'] = $row_akun['username'];
    $_SESSION['akun_status'] = $row_akun['status'];

    if($_SESSION["akun_status"]=="1") {
      header("location: admin.php");
    }
    elseif($_SESSION["akun_status"]=="2") {
      header("location: evaluator.php");
    }
    else {
    header("location: option.php");
    }
  }else {
    header("location: login.php?login-gagal");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="kemnakerri.jpg">
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>
<body>

<div class="container">
  <div class="jumbotron" style="background-color:rgb(34, 80, 90); color:white">
    <h1>Pusdiklat Pegawai Kemnaker RI</h1>      
    <form method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" placeholder="Enter username" name="username" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" placeholder="Enter password" name="password" required>
        </div>
        <?php
        if(isset($_GET['login-gagal'])) {?>
        <div class="alert">
        <span class="closebtn">&times;</span>  
        <strong> Username/password yang anda masukkan salah.</strong>
        </div>
        <?php }?>
        <?php
        if(isset($_GET['logout'])) {?>
        <div class="alert success">
        <span class="closebtn">&times;</span>  
        <strong>Anda telah berhasil logout.</strong>
        </div>
        <?php }?>  
        <button type="submit" class="btn btn-default" name="login">Submit</button>
      </form>
  </div>  
</div>
<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>

</body>
</html>

<?php
mysqli_close($koneksi);
ob_end_flush();
?>