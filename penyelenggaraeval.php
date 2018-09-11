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

if(isset($_POST['diklat'])){
  $insertdiklat = $_POST['namadiklat'];
  $inserttempat = $_POST['tempatdiklat'];
  $insertdurasi = $_POST['durasidiklat'];
  $insertdiklat1 = $_POST['nilaidiklat1'];
  $insertdiklat2 = $_POST['nilaidiklat2'];
  $insertdiklat3 = $_POST['nilaidiklat3'];
  $insertdiklat4 = $_POST['nilaidiklat4'];
  mysqli_query($koneksi, "INSERT INTO penyelenggara VALUES('','$insertdiklat','$inserttempat','$insertdurasi','Kelengkapan Informasi Pelatihan','$insertdiklat1','','1')");
  mysqli_query($koneksi, "INSERT INTO penyelenggara VALUES('','$insertdiklat','$inserttempat','$insertdurasi','Ketersediaan dan Kebersihan Asrama, Kelas, Ruang Makan, Toilet, dan Prasarana Lainnya','$insertdiklat2','','2')");
  mysqli_query($koneksi, "INSERT INTO penyelenggara VALUES('','$insertdiklat','$inserttempat','$insertdurasi','Ketersediaan, Kebersihan dan Keberfungsian Fasilitas Olah Raga, Kesehatan, Tempat Ibadah dan Sarana Lainnya','$insertdiklat3','','3')");
  mysqli_query($koneksi, "INSERT INTO penyelenggara VALUES('','$insertdiklat','$inserttempat','$insertdurasi','Ketersediaan, kelengkapan dan keberfungsian sarana dan bahan Pelatihan','$insertdiklat4','','4')");
  header("location: option.php");
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
                <form action="admin.php" method="post">
                  <table border="0">
                      <tr>
                          <td><li>Nama Diklat:</td>
                          <td><select name="namadiklat">
                              <option value="jakarta">Jakarta</option>
                              </select></td></li>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td><li>Tempat:</td>
                            <td><select name="tempatdiklat">
                                <option value="kalibata">Kalibata</option>
                                </select></td></li>
                          </tr>
                          <td><br></td>
                          <tr>
                              <td><li>Durasi:</td>
                              <td><select name="durasidiklat">
                                  <option value="1 minggu">1 Minggu</option>
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
                  <br><input type="submit" name="diklat">
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