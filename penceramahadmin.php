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
$query = mysqli_query($koneksi, "SELECT * FROM penceramah ORDER BY penceramah.id ASC");


?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Rekapitulasi Hasil Evaluasi Penceramah</title>
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
              <h2 style="color: rgb(34, 80, 90)">Rekapitulasi Hasil Evaluasi Penceramah</h2>
              <p><img src="kemnakerri.jpg" width="200px"></p><br>
              <p style="color: rgb(34, 80, 90)">Program : Pelatihan Dasar Calon PNS Golongan II </p>
              <p style="color: rgb(34, 80, 90)">Nama Penceramah : DR.X</p>
              <p style="color: rgb(34, 80, 90)">Jenis Ceramah : Akhlak</p>
              <p style="color: rgb(34, 80, 90)">Hari/Tanggal : Selasa/ 31 Juli 2018</p>
            </nav>
          <article>
              <ul>
                  <table border="1">
                    <tr>
                        <td>No.</td>
                        <td>Butir Penilaian</td>
                        <td>Nilai</td>
                        <td>Predikat</td>
                    </tr>
                    <?php if(mysqli_num_rows($query)) {?>
                    <?php while($row = mysqli_fetch_array($query)) {?>
                    <tr>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['butir penilaian']?></td>
                        <td><?php echo $row['nilai']?></td>
                        <td><?php echo $row['predikat']?></td>
                    </tr>
                    <?php }?>
                    <?php }?>
                    <tr>
                        <td></td>
                        <td>Rata-rata</td>
                        <td>100</td>
                        <td>Sangat Baik</td>
                    </tr>             
                  </table>
                  <br>
                  Komentar
                  <table border="1">
                    <tr>
                        <td>Komentar</td>
                    </tr>
                    </table>
                  <br>
                  <button onclick="location.href='individu.php'"type="button">Kembali</button>      
          </article>
       </section>  
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