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
            <form action="file:///C:/xampp/htdocs/diklat/coach.html">
              <table border="0">
                <tr>
                  <td><li>Program:</td>
                  <td><select name="program">
                      <option value="pelatdascpnsgol2">Pelatihan Dasar Calon PNS Golongan II</option>
                      </select></td></li>
                </tr>
                <td><br></td>
                <tr>
                  <td><li>Nama Penceramah:</td>
                  <td><select name="namapenceramah">
                      <option value="drx">Dr.X</option>
                      <option value="dry">Dr.Y</option>
                      </select></td></li>
                </tr>
                <td><br></td>
                <tr>
                    <td><li>Jenis Ceramah:</td>
                    <td><select name="jenisceramah">
                        <option value="fiqih">Fiqih</option>
                        </select></td></li>
                  </tr>
                  <td><br></td>
                <tr>
                    <td><li>Tanggal:</td>
                    <td><input type="date" name="tanggalceramah" required></td></li>
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
              </table
          </ul>
              <br><input type="submit" value="Submit">
              <input type="reset">           
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