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

if (isset($_POST['submit'])){
  $sql = "INSERT INTO pengujidiklat(NamaPenguji) values(";
  $sql = $sql . "'" . $_POST['lecturer'] . "');";
  $result = $koneksi->query($sql);
  // echo $sql;
}
?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Update Penguji</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <style>
      * {box-sizing:border-box;}
      body{font-family: Arial,Arial, Helvetica, sans-serif;}
      header{ background-color:rgb(34, 80, 90);
              padding:30px;
              text-align: center;
              font-size: 35px;
              color:white;}
      section{display: -webkit-flex;
              display: flex}
      nav{    -webkit-flex:2;
              -ms-flex:2;
              flex:2;
              text-align: center;
              background:rgb(255, 255, 255);
              padding:10px}
      nav ul{ list-style-type: none;
              padding:0}
      article{-webkit-flex: 3;
              -ms-flex: 3;
              flex: 3;
              background-color: rgb(255, 255, 255);
              padding: 10px;}
      footer{ background-color: rgb(34, 80, 90);
              padding: 10px;
              text-align: center;
              color: white}
  </style>
  <body>
    <header>
      <h1>Pusdiklat Pegawai Kemnaker RI</h1>
    </header>
    <section>
      <nav>
        <h2 style="color: rgb(34, 80, 90)">Update Penguji</h2>
        <p><img src="kemnakerri.jpg" width="200px"></p><br>
      </nav>
    <article>
        <ul>
          <form action="pengujiupdate.php" method="post">
            <table border="0">
              <tr>
                <td><li>Nama Penguji:</td>
                <td><input type="text" name="lecturer">
                    </td></li>
              </tr>
              <td><br></td>    
            </table>
        </ul>
        <br><input type="submit" id="submit" name="submit" value="Submit">
            <input type="reset"> 
            <button onclick="location.href='updateform.php'"type="button">Kembali</button>                     
    </article>
 </section>
</form>    
  <footer>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  </footer>
    </section>  
</body>
</html>

<?php
mysqli_close($koneksi);
ob_end_flush();
?>