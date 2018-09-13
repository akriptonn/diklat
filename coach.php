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

if(isset($_POST['submit'])){

  $rata_rata = $_POST['kemampuanmembimbingcoach'] + $_POST['ketepatanwaktucoach'] + $_POST['penggunaanmetodecoach'] + $_POST['sikapcoach'] + $_POST['motivasicoach'] ;
  $rata_rata = $rata_rata / 5.00;
  // echo $rata_rata;
  $sql = "SELECT `AUTO_INCREMENT`  FROM  INFORMATION_SCHEMA.TABLES   WHERE TABLE_NAME   = 'reratanilaicoach';";
  $result = $koneksi->query($sql);
  $cods = 1;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
  }

  $sql = "INSERT INTO reratanilaicoach(averages, NamaCoach, Kelompok, angkatantahun) values(";
  $sql = $sql. $rata_rata . ",";
  $sql = $sql. "'" . $_POST['namacoach'] . "'" . ",";
  $sql = $sql. "'" . $_POST['kelompok'] . "'" . ",";
  // $sql = $sql. "'" . $_POST['jenisceramah'] . "'" . ",";
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. "'" . $_POST['angkatan'] . "'" . ");";
  
  $result = $koneksi->query($sql);
  if ($result != '1'){
    $sql = "ALTER TABLE reratanilaicoach AUTO_INCREMENT= ";
    $sql = $sql . $cods . ";";
    $result = $koneksi->query($sql);

    $sql = "SELECT AVG(nilai) as averages from reratanilaicoach,coachnilai";
    $sql = $sql . " " . "where transaksi = reratanilaicoach.prime and NamaCoach = " . "'". $_POST['namacoach'] ."' AND Kelompok = '" . $_POST['kelompok'] . "' AND angkatantahun = '" .$_POST['angkatan'] ."';";
    // echo $sql;
    $result = $koneksi->query($sql);
    $rata_bfr = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $rata_bfr = $row['averages'];
      }
    }

    $sql = "SELECT COUNT(nilai) as averages from reratanilaicoach,coachnilai";
    $sql = $sql . " " . "where transaksi = reratanilaicoach.prime and NamaCoach = " . "'". $_POST['namacoach'] ."' AND Kelompok = '" . $_POST['kelompok'] . "' AND angkatantahun = '" .$_POST['angkatan'] ."';";
    // echo $sql;
    $result = $koneksi->query($sql);
    $ngitung = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $ngitung = $row['averages'];
      }
    }

    $rata_rata = (($rata_rata*5) + ($rata_bfr * $ngitung) )/ (($ngitung + 5)*1.0);
    $sql = "UPDATE reratanilaicoach SET averages = " .$rata_rata ." ";
    $sql = $sql . " " . "where NamaCoach = " . "'". $_POST['namacoach'] ."' AND Kelompok = '" . $_POST['kelompok'] . "' AND angkatantahun = '" .$_POST['angkatan'] ."';";
    $result = $koneksi->query($sql);

    $sql = "SELECT prime as AUTO_INCREMENT  FROM  reratanilaicoach";
    $sql = $sql . " " . "where NamaCoach = " . "'". $_POST['namacoach'] ."' AND Kelompok = '" . $_POST['kelompok'] . "' AND angkatantahun = '" .$_POST['angkatan'] ."';";
    $result = $koneksi->query($sql);
   
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
    }
  }
  // echo $sql;
  $sql = "INSERT INTO sarancoach(Saran,transaksi) values(";
  $sql = $sql. "'" . $_POST['pesancoach'] . "'" . ",";

  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);


  $sql = "INSERT INTO coachnilai(id_butirnilai,nilai,transaksi) values(1,";
  $sql = $sql . $_POST['kemampuanmembimbingcoach'] . "," ;

  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO coachnilai(id_butirnilai,nilai,transaksi) values(2,";
  $sql = $sql . $_POST['ketepatanwaktucoach'] . "," ;

  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO coachnilai(id_butirnilai,nilai,transaksi) values(3,";
  $sql = $sql . $_POST['penggunaanmetodecoach'] . "," ;

  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO coachnilai(id_butirnilai,nilai,transaksi) values(4,";
  $sql = $sql . $_POST['sikapcoach'] . "," ;
 
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO coachnilai(id_butirnilai,nilai,transaksi) values(4,";
  $sql = $sql . $_POST['motivasicoach'] . "," ;
 
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  header("location: penguji.php");
}
?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Evaluasi Coach</title>
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
              <p><li style="color:blue">Evaluasi Coach</p></li>
              <p>Evaluasi Penguji</p>
              <p>Evaluasi Mentor</p>
              <p>Evaluasi Penyelenggara</p>
            </nav>
          <article>
              <ul>
                <form action="coach.php" method="post">
                  <table border="0">
                    <tr>
                      <td><li>Nama Coach:</td>
                      <td><select name="namacoach">
                          <?php $query = mysqli_query($koneksi, "SELECT DISTINCT NamaCoach as Program from coachdiklat;"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['Program'];?>"><?php echo $row['Program'];}} ?></option>
                    </select></td></li>
                    </tr>
                    <td><br></td>
                    <tr>
                      <td><li>Kelompok:</td>
                      <td><input type="number" name="kelompok" value="210" required></td></li>
                    </tr>
                    <td><br></td>
                    <tr>
                        <td><li>Angkatan/Tahun:</td>
                        <td><input type="text" name="angkatan" value="22/2018" required></td></li>
                      </tr>
                      <td><br></td>
                    <tr>
                      <td><li>Kemampuan Membimbing:</td>
                      <td><input type="number" name="kemampuanmembimbingcoach" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                      <tr>
                        <td><li>Ketepatan Waktu dan Kehadiran:</td>
                        <td><input type="number" name="ketepatanwaktucoach" min="0" max="100" required></td></li>
                        </tr>
                      <td><br></td>  
                      <tr>
                          <td><li>Penggunaan Metode dan Media Pembimbingan:</td>
                          <td><input type="number" name="penggunaanmetodecoach" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                      <tr>
                          <td><li>Sikap dan Perilaku:</td>
                          <td><input type="number" name="sikapcoach" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                      <tr>
                          <td><li>Pemberian Motivasi Kepada Peserta:</td>
                          <td><input type="number" name="motivasicoach" min="0" max="100" required></td></li>
                        </tr>
                        <td><br></td>
                      <tr>
                    <td><li>Catatan/Saran:</td>
                    <td><textarea name="pesancoach" rows="10" cols="30">Tulis saran anda disini(tidak harus diisi)</textarea></td></li>
                  </tr>
                  <td><br></td>         
                  </table>
              </ul>
              <br><input type="submit" id="submit" name="submit" value="Submit">
                  <input type="reset">  
                  <button onclick="location.href='penguji.php'"type="button">Lanjut</button>
                  <button onclick="location.href='penceramah.php'"type="button">Kembali</button>           
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