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
  $insertnip = $_POST['nip'];
  $insertnama = $_POST['nama'];
  $insertttl = $_POST['tanggallahir'];
  $insertpangkat = $_POST['pangkat'];
  $insertjeniskelamin = $_POST['jeniskelamin'];
  $insertjabatan = $_POST['jabatan'];
  $insertunitkerja = $_POST['unitkerja'];
  $insertpusatprovinsi = $_POST['pusatprovinsi'];
  $insertdiklatangkatan = $_POST['diklatangkatan'];
  $inserttahun = $_POST['tahun'];
  $insertnohp = $_POST['nohp'];
  $insertemail = $_POST['email'];
  mysqli_query($koneksi,"INSERT INTO alumni VALUES('','$insertnip','$insertnama','$insertttl','$insertpangkat','$insertjeniskelamin','$insertjabatan','$insertunitkerja','$insertpusatprovinsi','$insertdiklatangkatan','$inserttahun','$insertnohp','$insertemail')");
  header("location: admin.php");
}

?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Form Alumni Peserta Diklat Ketenagakerjaan</title>
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
        <h2>Form Alumni Peserta Diklat Ketenagakerjaan</h2>
        <img src="kemnakerri.jpg">
    </nav>

    <article>
        <ul>
          <form action="alumni.php" method="post">
            <table border="0">
              <tr>
                <td><li>NIP:</td>
                <td><input type="text" name="nip" value="131000911"></td></li>
              </tr>
              <td><br></td>
              <tr>
                <td><li>Nama:</td>
                <td><input type="text" name="nama" value="Zulkarnain, Drs"></td></li>
              </tr>
              <td><br></td>
              <tr>
                  <td><li>Tanggal lahir:</td>
                  <td><input type="date" name="tanggallahir"></td></li>
                </tr>
                <td><br></td>
              <tr>
                  <td><li>Pangkat:</td>
                  <td>
                      <select name="pangkat">
                          <option></option>
                          <option>I/a</option>
                          <option>I/b</option>
                          <option>I/c</option>
                          <option>I/d</option>
                          <option>II/a</option>
                          <option>II/b</option>
                          <option>II/c</option>
                          <option>II/d</option>
                          <option>III/a</option>
                          <option>III/b</option>
                          <option>III/c</option>
                          <option>III/d</option>
                          <option>IV/a</option>
                          <option>IV/b</option>
                          <option>IV/c</option>
                          <option>IV/d</option>
                          <option>IV/e</option>
                          </select>
                  </td></li>
                </tr>
                <tr>
                    <td><li>Jenis Kelamin:</td>
                    <td>
                        <br><input type="radio" name="jeniskelamin" value="Laki-L=laki" checked>Laki-laki
                        <br><input type="radio" name="jeniskelamin" value="Perempuan">Perempuan
                    </td></li>
                  </tr>
                  <td><br></td>
                <tr>
                  <td><li>Jabatan:</td>
                  <td><input type="text" name="jabatan" value="Ka.Bid. Pengemb.Pegawai "></td></li>
                </tr>
                <td><br></td>  
                <tr>
                    <td><li>Unit Kerja:</td>
                    <td><input type="text" name="unitkerja" value="BKD Kab. Batanghari"></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>Pusat/Provinsi:</td>
                    <td><input type="text" name="pusatprovinsi" value="Jambi"></td></li>
                  </tr>
                  <td><br></td>
                <tr>
                    <td><li>Diklat/Angkatan:</td>
                    <td><input type="text" name="diklatangkatan" value="Lokakarya Prog.Diklat Nakertrs I"></td></li>
                  </tr>
                  <td><br></td>    
                <tr>
                    <td><li>Tahun:</td>
                    <td><input type="number" name="tahun" value="2006"></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>No. Hp:</td>
                    <td><input type="tel" name="nohp" value="08XXX"></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>Email:</td>
                    <td><input type="email" name="email" value="user@domain.com"></td></li>
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
</body>
</html>

<?php
mysqli_close($koneksi);
ob_end_flush();
?>