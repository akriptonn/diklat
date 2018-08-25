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
                <form action="file:///C:/xampp/htdocs/diklat/option.html">
                  <table border="0">
                      <tr>
                          <td><li>Nama Diklat:</td>
                          <td><select name="diklat">
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
                                  <option value="1minggu">1 Minggu</option>
                                  </select></td></li>
                            </tr>
                            <td><br></td>
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
                            <td><li>Ketersediaan, Kebersihan dan Keberfungsian Fasilitas Olah Raga, Kesehatan, Tempat Ibadah dan Sarana Lainnya:</td>
                            <td><input type="number" name="nilaidiklat3" min="0" max="100" required></td></li>
                          </tr>
                          <td><br></td>
                          <tr>
                              <td><li>Ketersediaan, kelengkapan dan keberfungsian sarana dan bahan Pelatihan:</td>
                              <td><input type="number" name="nilaidiklat4" min="0" max="100" required></td></li>
                            </tr>
                            <td><br></td>  
                      <tr>
                    <td><li>Catatan/Saran:</td>
                    <td><textarea name="pesanmentor" rows="10" cols="30">Tulis saran anda disini(tidak harus diisi)</textarea></td></li>
                  </tr>
                  <td><br></td>         
                  </table
              </ul>
                  <br><input type="submit" value="Submit">
                  <input type="reset">  
                  <button onclick="location.href='option.php'"type="button">Lanjut</button>
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