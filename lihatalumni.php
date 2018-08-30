<?php
ob_start();
session_start();
if(!isset($_SESSION['akun_id'])) header("location: login.php");
elseif($_SESSION['akun_status']!="1"){
  header("location: option.php");
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
$query = mysqli_query($koneksi, "SELECT * FROM coach ORDER BY coach.id ASC");


?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Alumni</title>
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
          <h3>Alumni</h3>
        </header>
        <section>
          <article>
              <ul>
                <form action="">
                  <table border="1">
                    <tr>
                        <td>No.</td>
                        <td>NIP</td>
                        <td>Nama</td>
                        <td>Tanggal Lahir</td>
                        <td>Pangkat</td>
                        <td>Jenis Kelamin</td>
                        <td>Jabatan</td>
                        <td>Unit Kerja</td>
                        <td>Pusat/Provinsi</td>
                        <td>Diklat/Angkatan</td>
                        <td>Tahun</td>
                        <td>No. Hp</td>
                        <td>Email   </td>
                    </tr>             
                  </table>
                  <br>
                  <button onclick="location.href='admin.php'"type="button">Kembali</button>             
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