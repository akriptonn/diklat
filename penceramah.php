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

?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Evaluasi Penceramah</title>
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
          <p><li style="color:blue">Evaluasi Penceramah</p></li>
          <p>Evaluasi Coach</p>
          <p>Evaluasi Penguji</p>
          <p>Evaluasi Mentor</p>
          <p>Evaluasi Penyelenggara</p>
        </nav>
      <article>
          <ul>
            <form action="penceramah.php" method="post">
              <table border="0">
                <tr>
                  <td><li>Program:</td>
                  <td><select name="program">
                  <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Program from penceramahdiklat;"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['Program'];?>"><?php echo $row['Program'];}} ?></option>
                    </select></td></li>
                </tr>
                <td><br></td>
                <tr>
                  <td><li>Nama Penceramah:</td>
                  <td><select name="namapenceramah">
                  <?php $query = mysqli_query($koneksi, "SELECT DISTINCT NamaPenceramah from penceramahdiklat;"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['NamaPenceramah']; ?>"><?php echo $row['NamaPenceramah'];}} ?></option>
                      </select></td></li>
                </tr>
                <td><br></td>
                <tr>
                    <td><li>Jenis Ceramah:</td>
                    <td><select name="jenisceramah">
                    <?php $query = mysqli_query($koneksi, "SELECT DISTINCT JenisCeramah from penceramahdiklat;"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['JenisCeramah']; ?>"><?php echo $row['JenisCeramah'];}} ?></option>
                        </select></td></li>
                  </tr>
                  <td><br></td>
                <tr>
                    <td><li>Tanggal:</td>
                    <td><input type="datetime-local" name="tanggalpengampu" required></td></li>
                  </tr>
                  <td><br></td>
                  <tr>
                        <td><li>Angkatan/Tahun:</td>
                        <td><input type="text" name="angkatan" value="22/2018" required></td></li>
                      </tr>
                      <td><br></td>
                  <tr>
                      <td><li>Penguasaan Materi:</td>
                      <td><input type="number" name="penguasaanpenceramah" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                  <tr>
                    <td><li>Cara Menyajikan:</td>
                    <td><input type="number" name="menyajikanpenceramah" min="0" max="100" required></td></li>
                    </tr>
                  <td><br></td>  
                  <tr>
                      <td><li>Cara Menjawab Pertanyaan dari Peserta:</td>
                      <td><input type="number" name="caramenjawabpenceramah" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                  <tr>
                      <td><li>Pemberian Motivasi Kepada Peserta:</td>
                      <td><input type="number" name="motivasipenceramah" min="0" max="100" required></td></li>
                    </tr>
                    <td><br></td>
                  <tr>
                    <td><li>Catatan/Saran:</td>
                    <td><textarea name="pesanpenceramah" rows="10" cols="30">Tulis saran anda disini(tidak harus diisi)</textarea></td></li>
                  </tr>
                  <td><br></td>       
              </table>
          </ul>
          <br><input type="submit" id="submit" name="submit" value="Submit">
              <input type="reset">
              <button onclick="location.href='coach.php'"type="button">Lanjut</button>
              <button onclick="location.href='pengampu.php'"type="button">Kembali</button>             
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

if (isset($_POST['submit'])){
  $rata_rata = $_POST['penguasaanpenceramah'] + $_POST['menyajikanpenceramah'] + $_POST['caramenjawabpenceramah'] + $_POST['motivasipenceramah'] ;
  $rata_rata = $rata_rata / 4;
  // echo $rata_rata;
  $sql = "SELECT `AUTO_INCREMENT`  FROM  INFORMATION_SCHEMA.TABLES   WHERE TABLE_NAME   = 'reratanilaiceramah';";
  $result = $koneksi->query($sql);
  $cods = 1;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
  }

  $sql = "INSERT INTO reratanilaiceramah(averages, NamaPenceramah, program, matpel, angkatantahun) values(";
  $sql = $sql. $rata_rata . ",";
  $sql = $sql. "'" . $_POST['namapenceramah'] . "'" . ",";
  $sql = $sql. "'" . $_POST['program'] . "'" . ",";
  $sql = $sql. "'" . $_POST['jenisceramah'] . "'" . ",";
  // $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. "'" . $_POST['angkatan'] . "'" . ");";
  
  $result = $koneksi->query($sql);
  if ($result != '1'){
    $sql = "ALTER TABLE reratanilaiceramah AUTO_INCREMENT= ";
    $sql = $sql . $cods . ";";
    $result = $koneksi->query($sql);

    $sql = "SELECT AVG(nilai) as averages from reratanilaiceramah,penceramahnilai";
    $sql = $sql . " " . "where transaksi = reratanilaiceramah.prime and NamaPenceramah = " . "'". $_POST['namapenceramah'] ."' AND program = '" . $_POST['program'] . "' AND matpel = '" .$_POST['jenisceramah'] ."' AND angkatantahun = '" .$_POST['angkatan']."' AND tanggalwaktu = '" .$_POST['tanggalpengampu'] ."';";
    // echo $sql;
    $result = $koneksi->query($sql);
    $rata_bfr = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $rata_bfr = $row['averages'];
      }
    }

    $sql = "SELECT COUNT(nilai) as averages from reratanilaiceramah,penceramahnilai";
    $sql = $sql . " " . "where transaksi = reratanilaiceramah.prime and NamaPenceramah = " . "'". $_POST['namapenceramah'] ."' AND program = '" . $_POST['program'] . "' AND matpel = '" .$_POST['jenisceramah'] ."' AND angkatantahun = '" .$_POST['angkatan']."' AND tanggalwaktu = '" .$_POST['tanggalpengampu'] ."';";
    // echo $sql;
    $result = $koneksi->query($sql);
    $ngitung = 0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $ngitung = $row['averages'];
      }
    }

    $rata_rata = (($rata_rata*4) + ($rata_bfr * $ngitung) )/ (($ngitung + 4)*1.0);
    $sql = "UPDATE reratanilaiceramah SET averages = " .$rata_rata ." ";
    $sql = $sql . " " . "where NamaPenceramah = " . "'". $_POST['namapenceramah'] ."' AND program = '" . $_POST['program'] . "' AND matpel = '" .$_POST['jenisceramah'] ."' AND angkatantahun = '" .$_POST['angkatan']. "' AND tanggalwaktu = '" .$_POST['tanggalpengampu'] ."';";
    $result = $koneksi->query($sql);

    $sql = "SELECT prime as AUTO_INCREMENT  FROM  reratanilaiceramah";
    $sql = $sql . " " . "where NamaPenceramah = " . "'". $_POST['namapenceramah'] ."' AND program = '" . $_POST['program'] . "' AND matpel = '" .$_POST['jenisceramah'] ."' AND angkatantahun = '" .$_POST['angkatan']. "' AND tanggalwaktu = '" .$_POST['tanggalpengampu'] ."';";
    $result = $koneksi->query($sql);
   
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
    }
  }
  // echo $sql;
  $sql = "INSERT INTO saranpenceramah(Saran,transaksi) values(";
  $sql = $sql. "'" . $_POST['pesanpenceramah'] . "'" . ",";

  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);


  $sql = "INSERT INTO penceramahnilai(id_butirnilai,nilai,transaksi) values(1,";
  $sql = $sql . $_POST['penguasaanpenceramah'] . "," ;

  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penceramahnilai(id_butirnilai,nilai,transaksi) values(2,";
  $sql = $sql . $_POST['menyajikanpenceramah'] . "," ;

  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penceramahnilai(id_butirnilai,nilai,transaksi) values(3,";
  $sql = $sql . $_POST['caramenjawabpenceramah'] . "," ;

  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO penceramahnilai(id_butirnilai,nilai,transaksi) values(4,";
  $sql = $sql . $_POST['motivasipenceramah'] . "," ;
 
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);
  // // $sql = $sql . "NULL"

  // $sql = $sql . "NULL"
  // mysqli_close($koneksi);
  // ob_end_flush();
  header("location: coach.php");
}

mysqli_close($koneksi);
ob_end_flush();
?>