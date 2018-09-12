<?php
ob_start();
session_start();
if(!isset($_SESSION['akun_id'])) header("location: login.php");

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
  $insertdiklat = $_POST['namadiklat'];
  $inserttempat = $_POST['tempatdiklat'];
  $insertdurasi = $_POST['durasidiklat'];
  $insertdiklat1 = $_POST['nilaidiklat1'] + $_POST['nilaidiklat2'] + $_POST['nilaidiklat3'] + $_POST['nilaidiklat4'] ;
  $insertdiklat2 = $_POST['nilaidiklat5'] + $_POST['nilaidiklat6'] + $_POST['nilaidiklat7'];
  $insertdiklat1 = $insertdiklat1 * 1.00 / 4;
  $insertdiklat2 = $insertdiklat2 * 1.00 / 3;

  $rata_rata = $insertdiklat1 + $insertdiklat2;
  $rata_rata = $rata_rata / 2;
  // echo $rata_rata;
  $sql = "SELECT `AUTO_INCREMENT`  FROM  INFORMATION_SCHEMA.TABLES   WHERE TABLE_NAME   = 'reratanilaipenyelenggara';";
  $result = $koneksi->query($sql);
  $cods = 1;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
  }

  $sql = "INSERT INTO reratanilaipenyelenggara(averages, NamaDiklat, Tempat, Durasi) values(";
  $sql = $sql. $rata_rata . ",";
  $sql = $sql. "'" . $insertdiklat . "'" . ",";
  $sql = $sql. "'" . $inserttempat . "'" . ",";
  $sql = $sql. "'" . $insertdurasi . "'" . ");";
  
  $result = $koneksi->query($sql);
  if ($result != '1'){
    $sql = "ALTER TABLE reratanilaipenyelenggara AUTO_INCREMENT= ";
    $sql = $sql . $cods . ";";
    $result = $koneksi->query($sql);

    $sql = "SELECT AVG(nilai) as averages from reratanilaipenyelenggara,penyelenggaranilai";
    $sql = $sql . " " . "where transaksi = reratanilaipenyelenggara.prime and NamaDiklat = " . "'". $insertdiklat ."' AND Tempat = '" . $inserttempat . "' AND Durasi = '" .$insertdurasi ."';";
    // echo $sql;
    $result = $koneksi->query($sql);
    $rata_bfr = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $rata_bfr = $row['averages'];
      }
    }

    $sql = "SELECT COUNT(nilai) as averages from reratanilaipenyelenggara,penyelenggaranilai";
    $sql = $sql . " " . "where transaksi = reratanilaipenyelenggara.prime and NamaDiklat = " . "'". $insertdiklat ."' AND Tempat = '" . $inserttempat . "' AND Durasi = '" .$insertdurasi ."';";
    // echo $sql;
    $result = $koneksi->query($sql);
    $ngitung = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $ngitung = $row['averages'];
      }
    }

    $rata_rata = (($rata_rata*2) + ($rata_bfr * $ngitung) )/ (($ngitung + 4)*1.0);
    $sql = "UPDATE reratanilaipenyelenggara SET averages = " .$rata_rata ." ";
    $sql = $sql . " " . "where NamaDiklat = " . "'". $insertdiklat ."' AND Tempat = '" . $inserttempat . "' AND Durasi = '" .$insertdurasi ."';";
    $result = $koneksi->query($sql);

    $sql = "SELECT prime as AUTO_INCREMENT  FROM  reratanilaipenyelenggara";
    $sql = $sql . " " . "where NamaDiklat = " . "'". $insertdiklat ."' AND Tempat = '" . $inserttempat . "' AND Durasi = '" .$insertdurasi ."';";
    $result = $koneksi->query($sql);
   
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
    }
  }
  $sql = "INSERT INTO saranpenyelenggara(Saran,transaksi) values(";
  $sql = $sql. "'" . $_POST['pesanpenyelenggara'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);


  $sql = "INSERT INTO penyelenggaranilai(id_butirnilai,nilai,transaksi) values(1,";
  $sql = $sql . $insertdiklat1 . "," ;
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penyelenggaranilai(id_butirnilai,nilai,transaksi) values(2,";
  $sql = $sql . $insertdiklat2 . "," ;
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  mysqli_close($koneksi);
  ob_end_flush();
  header("location: admin.php");
}

?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Evaluasi Diklat</title>
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
              <h2 style="color: rgb(34, 80, 90)">Form Evaluasi Oleh Peserta</h2>
              <p><img src="kemnakerri.jpg" width="200px"></p><br>
              <p style="color: blue">Evaluasi Pengampu/Widyaiswara</p>
              <p style="color: blue">Evaluasi Penceramah</p>
              <p style="color: blue">Evaluasi Coach</p>
              <p style="color: blue">Evaluasi Penguji</p>
              <p style="color: blue">Evaluasi Mentor</p>
              <p><li style="color:blue">Evaluasi Penyelenggara</p></li>
            </nav>
          <article>
              <ul>
                <form action="penyelenggara.php" method="post">
                  <table border="0">
                      <tr>
                          <td><li>Nama Diklat:</td>
                          <td><select name="namadiklat">
                             <?php $query = mysqli_query($koneksi, "SELECT DISTINCT namaDiklat from penyelenggaradiklat;"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                              <option value="<?php echo $row['namaDiklat'];?>"><?php echo $row['namaDiklat'];}} ?></option>
                              </select></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td><li>Tempat:</td>
                            <td><select name="tempatdiklat">
                            <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Tempat from penyelenggaradiklat;"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                            <option value="<?php echo $row['Tempat'];?>"><?php echo $row['Tempat'];}} ?></option>
                            </select></td></li>
                          </tr>
                          <td><br></td>
                          <tr>
                              <td><li>Durasi:</td>
                              <td><select name="durasidiklat">
                              <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Durasi from penyelenggaradiklat;"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                              <option value="<?php echo $row['Durasi'];?>"><?php echo $row['Durasi'];}} ?></option>
                              </select></td></li>
                            </tr>
                            <td><br></td>
                            <tr>
                            <td><h4 style="color: rgb(34, 80, 90)">a. Penyelenggara Diklat</h4>
                            <h4 style="color: rgb(34, 80, 90)">&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan Kepada Peserta</h4>
                            </td>
                            </tr>
                    <tr>
                      <td><li>Kelengkapan Informasi Pelatihan:</td>
                      <td><input type="number" name="nilaidiklat1" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                          <td><li>Ketersediaan dan Kebersihan Asrama, Kelas, Ruang Makan, Toilet, dan Prasarana Lainnya:</td>
                          <td><input type="number" name="nilaidiklat2" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td><li>Ketersediaan, Kebersihan, dan Keberfungsian Fasilitas Olah Raga, Kesehatan, Tempat Ibadah, dan Sarana Lainnya:</td>
                            <td><input type="number" name="nilaidiklat3" min="0" max="100" required></td></li>
                          </tr>
                          <td><br></td>
                          <tr>
                              <td><li>Ketersediaan, Kelengkapan dan Keberfungsian Sarana, dan Bahan Pelatihan:</td>
                              <td><input type="number" name="nilaidiklat4" min="0" max="100" required></td></li>
                            </tr>
                            <td><br></td>
                            <tr>
                            <td><h4 style="color: rgb(34, 80, 90)">b. Pelayanan Kepada Pengajar, Penceramah, dan Tenaga Kediklatan Lainnya</h4></td>
                            </tr>
                    <tr>
                      <td><li>Kelengkapan Informasi Diklat:</td>
                      <td><input type="number" name="nilaidiklat5" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                          <td><li>Ketepatan Waktu Menghubungi Pengajar, Penceramah, dan Tenaga Kediklatan Lainnya:</td>
                          <td><input type="number" name="nilaidiklat6" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td><li>Ketersediaan, Kelengkapan, dan Keberfungsian Sarana Pengajaran Dalam Kelas:</td>
                            <td><input type="number" name="nilaidiklat7" min="0" max="100" required></td></li>
                          </tr>
                          <td><br></td>     
                      <tr>
                    <td><li>Catatan/Saran:</td>
                    <td><textarea name="pesanpenyelenggara" rows="10" cols="30">Tulis saran anda disini(tidak harus diisi)</textarea></td></li>
                  </tr>
                  <td><br></td>         
                  </table>
              </ul>
              <br><input type="submit" id="submit" name="submit" value="Submit">
                  <input type="reset">  
                  <button onclick="location.href='admin.php'"type="button">Lanjut</button>
                  <button onclick="location.href='mentor.php'"type="button">Kembali</button>           
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