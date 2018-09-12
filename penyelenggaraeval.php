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
  $insertdiklat1 = $_POST['nilaidiklateval1'] + $_POST['nilaidiklateval2'];
  $insertdiklat2 = $_POST['nilaidiklateval3'] + $_POST['nilaidiklateval4'] ;
  $insertdiklat3 = $_POST['nilaidiklateval5'] + $_POST['nilaidiklateval6'] + $_POST['nilaidiklateval7']  ;
  $insertdiklat4 = $_POST['nilaidiklateval8'] + $_POST['nilaidiklateval9'] + $_POST['nilaidiklateval10'] + $_POST['nilaidiklateval11'] ;
  $insertdiklat5 = $_POST['nilaidiklateval12'] + $_POST['nilaidiklateval13'] + $_POST['nilaidiklateval14'] ;
  $insertdiklat6 = $_POST['nilaidiklateval15'] + $_POST['nilaidiklateval16'] + $_POST['nilaidiklateval17'] ;

  $insertdiklat1 = $insertdiklat1 * 1.00 / 2;
  $insertdiklat2 = $insertdiklat2 * 1.00 / 2;
  $insertdiklat3 = $insertdiklat3 * 1.00 / 3;
  $insertdiklat4 = $insertdiklat4 * 1.00 / 4;
  $insertdiklat5 = $insertdiklat5 * 1.00 / 3;
  $insertdiklat6 = $insertdiklat6 * 1.00 / 3;

  $rata_rata = $insertdiklat1 + $insertdiklat2 + $insertdiklat3 + $insertdiklat4 + $insertdiklat5 + $insertdiklat6;
  $rata_rata = $rata_rata / 6;
  // echo $rata_rata;
  $sql = "SELECT `AUTO_INCREMENT`  FROM  INFORMATION_SCHEMA.TABLES   WHERE TABLE_NAME   = 'reratanilaipenyelenggaraev';";
  $result = $koneksi->query($sql);
  $cods = 1;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
  }

  $sql = "INSERT INTO reratanilaipenyelenggaraev(averages, NamaDiklat, Tempat, Durasi) values(";
  $sql = $sql. $rata_rata . ",";
  $sql = $sql. "'" . $insertdiklat . "'" . ",";
  $sql = $sql. "'" . $inserttempat . "'" . ",";
  $sql = $sql. "'" . $insertdurasi . "'" . ");";
  
  $result = $koneksi->query($sql);
  if ($result != '1'){
    $sql = "ALTER TABLE reratanilaipenyelenggaraev AUTO_INCREMENT= ";
    $sql = $sql . $cods . ";";
    $result = $koneksi->query($sql);

    $sql = "SELECT AVG(nilai) as averages from reratanilaipenyelenggaraev,penyelenggaranilaiev";
    $sql = $sql . " " . "where transaksi = reratanilaipenyelenggaraev.prime and NamaDiklat = " . "'". $insertdiklat ."' AND Tempat = '" . $inserttempat . "' AND Durasi = '" .$insertdurasi ."';";
    // echo $sql;
    $result = $koneksi->query($sql);
    $rata_bfr = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $rata_bfr = $row['averages'];
      }
    }

    $sql = "SELECT COUNT(nilai) as averages from reratanilaipenyelenggaraev,penyelenggaranilaiev";
    $sql = $sql . " " . "where transaksi = reratanilaipenyelenggaraev.prime and NamaDiklat = " . "'". $insertdiklat ."' AND Tempat = '" . $inserttempat . "' AND Durasi = '" .$insertdurasi ."';";
    // echo $sql;
    $result = $koneksi->query($sql);
    $ngitung = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $ngitung = $row['averages'];
      }
    }

    $rata_rata = (($rata_rata*2) + ($rata_bfr * $ngitung) )/ (($ngitung + 4)*1.0);
    $sql = "UPDATE reratanilaipenyelenggaraev SET averages = " .$rata_rata ." ";
    $sql = $sql . " " . "where NamaDiklat = " . "'". $insertdiklat ."' AND Tempat = '" . $inserttempat . "' AND Durasi = '" .$insertdurasi ."';";
    $result = $koneksi->query($sql);

    $sql = "SELECT prime as AUTO_INCREMENT  FROM  reratanilaipenyelenggaraev";
    $sql = $sql . " " . "where NamaDiklat = " . "'". $insertdiklat ."' AND Tempat = '" . $inserttempat . "' AND Durasi = '" .$insertdurasi ."';";
    $result = $koneksi->query($sql);
   
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
    }
  }
  $sql = "INSERT INTO saranpenyelenggaraev(Saran,transaksi) values(";
  $sql = $sql. "'" . $_POST['pesanpenyelenggaraeval'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);


  $sql = "INSERT INTO penyelenggaranilaiev(id_butirnilai,nilai,transaksi) values(1,";
  $sql = $sql . $insertdiklat1 . "," ;
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penyelenggaranilaiev(id_butirnilai,nilai,transaksi) values(2,";
  $sql = $sql . $insertdiklat2 . "," ;
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penyelenggaranilaiev(id_butirnilai,nilai,transaksi) values(3,";
  $sql = $sql . $insertdiklat3 . "," ;
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penyelenggaranilaiev(id_butirnilai,nilai,transaksi) values(4,";
  $sql = $sql . $insertdiklat4 . "," ;
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penyelenggaranilaiev(id_butirnilai,nilai,transaksi) values(5,";
  $sql = $sql . $insertdiklat5 . "," ;
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penyelenggaranilaiev(id_butirnilai,nilai,transaksi) values(6,";
  $sql = $sql . $insertdiklat6 . "," ;
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
              <p><li style="color:blue">Evaluasi Penyelenggara</p></li>
            </nav>
          <article>
              <ul>
                <form action="penyelenggaraeval.php" method="post">
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
                            <td><h4 style="color: rgb(34, 80, 90)">a. Pengelola Diklat</h4>
                            <h4 style="color: rgb(34, 80, 90)">&nbsp;&nbsp;&nbsp;&nbsp;Perencanaan Program Diklat</h4>
                            </td>
                            </tr>
                    <tr>
                      <td><li>Kesesuaian Perencanaan Dengan Standar Program Diklat:</td>
                      <td><input type="number" name="nilaidiklateval1" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                          <td><li>Penyampaian Rencana Kepada Instansi Pembina:</td>
                          <td><input type="number" name="nilaidiklateval2" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                            <tr>
                            <td><h4 style="color: rgb(34, 80, 90)">b. Pengorganisasian Program Diklat</h4></td>
                            </tr>
                    <tr>
                      <td><li>Surat Keputusan Kepala Lembaga Diklat Pemerintah Terakreditasi Tentang Panitia Penyelenggara Diklat:</td>
                      <td><input type="number" name="nilaidiklateval3" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                          <td><li>Uraian Tugas Panitia Penyelenggara Diklat:</td>
                          <td><input type="number" name="nilaidiklateval4" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td><h4 style="color: rgb(34, 80, 90)">c. Pelaksanaan Program Diklat</h4></td>
                            </tr>
                    <tr>
                      <td><li>Kesesuaian Pelaksanaan Dengan Perencanaan:</td>
                      <td><input type="number" name="nilaidiklateval5" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                          <td><li>Pengkoordinasian Dengan Pihak-Pihak Terkait:</td>
                          <td><input type="number" name="nilaidiklateval6" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                          <td><li>Penyampaian Laporan Penyelenggaraan Diklat Kepada Kepala LAN/ Instansi Pembina:</td>
                          <td><input type="number" name="nilaidiklateval7" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                        <td><h4 style="color: rgb(34, 80, 90)">d. Penyelenggara Diklat</h4>
                            <h4 style="color: rgb(34, 80, 90)">&nbsp;&nbsp;&nbsp;&nbsp;Pelayanan Kepada Peserta</h4>
                            </td>
                            </tr>
                    <tr>
                      <td><li>Kelengkapan Informasi Pelatihan:</td>
                      <td><input type="number" name="nilaidiklateval8" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                          <td><li>Ketersediaan dan Kebersihan Asrama, Kelas, Ruang Makan, Toilet, dan Prasarana Lainnya:</td>
                          <td><input type="number" name="nilaidiklateval9" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td><li>Ketersediaan, Kebersihan dan Keberfungsian Fasilitas Olah Raga, Kesehatan, Tempat Ibadah dan Sarana Lainnya:</td>
                            <td><input type="number" name="nilaidiklateval10" min="0" max="100" required></td></li>
                          </tr>
                          <td><br></td>
                          <tr>
                              <td><li>Ketersediaan, Kelengkapan dan Keberfungsian Sarana, dan Bahan Pelatihan:</td>
                              <td><input type="number" name="nilaidiklateval11" min="0" max="100" required></td></li>
                            </tr>
                            <td><br></td>
                            <tr>
                            <td><h4 style="color: rgb(34, 80, 90)">e. Pelayanan Kepada Pengajar, Penceramah, dan Tenaga Kediklatan Lainnya</h4></td>
                            </tr>
                    <tr>
                      <td><li>Kelengkapan Informasi Diklat:</td>
                      <td><input type="number" name="nilaidiklateval12" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                          <td><li>Ketepatan Waktu Menghubungi Pengajar, Penceramah, dan Tenaga Kediklatan Lainnya:</td>
                          <td><input type="number" name="nilaidiklateval13" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td><li>Ketersediaan, Kelengkapan, dan Keberfungsian Sarana Pengajaran Dalam Kelas:</td>
                            <td><input type="number" name="nilaidiklateval14" min="0" max="100" required></td></li>
                          </tr>
                          <td><br></td>
                          <tr>
                            <td><h4 style="color: rgb(34, 80, 90)">f. Pengadministrasian Diklat</h4></td>
                            </tr>
                    <tr>
                      <td><li>Kelengkapan Surat Menyurat:</td>
                      <td><input type="number" name="nilaidiklateval15" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                          <td><li>Ketersediaan Instrumen-Instrumen Penilaian:</td>
                          <td><input type="number" name="nilaidiklateval16" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td><li>File Keseluruhan Dokumen Setelah Penyelenggaraan:</td>
                            <td><input type="number" name="nilaidiklateval17" min="0" max="100" required></td></li>
                          </tr>
                          <td><br></td>     
                      <tr>
                    <td><li>Catatan/Saran:</td>
                    <td><textarea name="pesanpenyelenggaraeval" rows="10" cols="30">Tulis saran anda disini(tidak harus diisi)</textarea></td></li>
                  </tr>
                  <td><br></td>         
                  </table>
              </ul>
              <br><input type="submit" id="submit" name="submit" value="Submit">
                  <input type="reset">  
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