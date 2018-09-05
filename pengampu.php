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
    <title>Evaluasi Pengampu Materi</title>
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
        <p><li style="color:blue">Evaluasi Pengampu/Widyaiswara</p></li>
        <p>Evaluasi Penceramah</p>
        <p>Evaluasi Coach</p>
        <p>Evaluasi Penguji</p>
        <p>Evaluasi Mentor</p>
        <p>Evaluasi Penyelenggara</p>
      </nav>
    <article>
        <ul>
          <form action="pengampu.php" method="post">
            <table border="0">
              <tr>
                <td><li>Program:</td>
                <td><select name="program">
                    <option value="Pelatihan Dasar Calon PNS Golongan II">Pelatihan Dasar Calon PNS Golongan II</option>
                    </select></td></li>
              </tr>
              <td><br></td>
              <tr>
                <td><li>Nama Pengajar:</td>
                <td><select name="namapengajar">
                    <option value="Dr.X">Dr.X</option>
                    </select></td></li>
              </tr>
              <td><br></td>
              <tr>
                  <td><li>Mata Pelatihan:</td>
                  <td><select name="matapelatihan">
                      <option value="Matematika">Matematika</option>
                      </select></td></li>
                </tr>
                <td><br></td>
              <tr>
                  <td><li>Tanggal dan Waktu:</td>
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
                    <td><input type="number" name="penguasaanpengampu" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td>
                <tr>
                  <td><li>Sistematika Penyajian dan Menyajikan:</td>
                  <td><input type="number" name="caramenyajikanpengampu" min="0" max="100" required></td></li>
                  </tr>
                <td><br></td>  
                <tr>
                    <td><li>Ketepatan Waktu dan Kehadiran:</td>
                    <td><input type="number" name="ketepatanwaktupengampu" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>Penggunaan Metode dan Sarana Pelatihan:</td>
                    <td><input type="number" name="penggunaanmetodepengampu" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td>
                <tr>
                    <td><li>Sikap dan Perilaku:</td>
                    <td><input type="number" name="sikappengampu" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td>    
                <tr>
                    <td><li>Kerapihan Berpakaian:</td>
                    <td><input type="number" name="kerapihanberpakaian" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>Cara Menjawab Pertanyaan dari Peserta:</td>
                    <td><input type="number" name="caramenjawabpengampu" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>Penggunaan Bahasa:</td>
                    <td><input type="number" name="bahasa" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td>
                <tr>
                    <td><li>Pemberian Motivasi Kepada Peserta:</td>
                    <td><input type="number" name="motivasipengampu" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td>
                <tr>
                    <td><li>Kerjasama antar Widyaiswara (dalam tim):</td>
                    <td><input type="number" name="kerjasama" min="0" max="100" required></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>Catatan/Saran:</td>
                    <td><textarea name="pesanpengampu" rows="10" cols="30">Tulis saran anda disini(tidak harus diisi)</textarea></td></li>
                  </tr>
                  <td><br></td>           
            </table>
        </ul>
            <br><input type="submit" id="submit" name="submit" value="Submit">
            <input type="reset">
            <button onclick="location.href='penceramah.php'"type="button">Lanjut</button>
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
if (isset($_POST['submit'])){
  $rata_rata = $_POST['penguasaanpengampu'] + $_POST['caramenyajikanpengampu'] + $_POST['ketepatanwaktupengampu'] + $_POST['penggunaanmetodepengampu'] + $_POST['sikappengampu'] + $_POST['kerapihanberpakaian'] + $_POST['caramenjawabpengampu'] + $_POST['bahasa'] + $_POST['motivasipengampu'] + $_POST['kerjasama'];
  $rata_rata = $rata_rata / 10;
  // echo $rata_rata;
  $sql = "SELECT `AUTO_INCREMENT`  FROM  INFORMATION_SCHEMA.TABLES   WHERE TABLE_NAME   = 'reratanilai';";
  $result = $koneksi->query($sql);
  $cods = 1;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cods = $row['AUTO_INCREMENT'];  
    }
  }

  $sql = "INSERT INTO reratanilai(averages, NamaPengajar, program, matpel, tanggalwaktu, angkatantahun) values(";
  $sql = $sql. $rata_rata . ",";
  $sql = $sql. "'" . $_POST['namapengajar'] . "'" . ",";
  $sql = $sql. "'" . $_POST['program'] . "'" . ",";
  $sql = $sql. "'" . $_POST['matapelatihan'] . "'" . ",";
  $sql = $sql. "'" . $_POST['tanggalpengampu'] . "'" . ",";
  $sql = $sql. "'" . $_POST['angkatan'] . "'" . ");";
  echo $sql;
  $result = $koneksi->query($sql);
  // echo $sql;
  $sql = "INSERT INTO saranpengampu(Saran,transaksi) values(";
  $sql = $sql. "'" . $_POST['pesanpengampu'] . "'" . ",";
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(1,";
  $sql = $sql . $_POST['penguasaanpengampu'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(2,";
  $sql = $sql . $_POST['caramenyajikanpengampu'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(3,";
  $sql = $sql . $_POST['ketepatanwaktupengampu'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(4,";
  $sql = $sql . $_POST['penggunaanmetodepengampu'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(5,";
  $sql = $sql . $_POST['sikappengampu'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(6,";
  $sql = $sql . $_POST['kerapihanberpakaian'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(7,";
  $sql = $sql . $_POST['caramenjawabpengampu'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(8,";
  $sql = $sql . $_POST['bahasa'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(9,";
  $sql = $sql . $_POST['motivasipengampu'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);

  $sql = "INSERT INTO pengampunilai(id_butirnilai,nilai,transaksi) values(10,";
  $sql = $sql . $_POST['kerjasama'] . "," ;
  $sql = $sql. $cods . ");";
  $result = $koneksi->query($sql);
  // $sql = $sql . "NULL"

  // $sql = $sql . "NULL"
 

}
mysqli_close($koneksi);
ob_end_flush();
?>