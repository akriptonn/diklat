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

if(isset($_POST['opsi1'])){
  if($_SESSION["akun_status"]=="1") {
    header("location: admin.php");
  }
  elseif($_SESSION["akun_status"]=="2") {
    header("location: evaluator.php");
  }
  else {
  header("location: option.php");
  }
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
          <form method="post">
            <table border="0">
              <tr>
                <td><li>NIP:</td>
                <td><input type="text" name="nip" value="131000911" required></td></li>
              </tr>
              <td><br></td>
              <tr>
                <td><li>Nama:</td>
                <td><input type="text" name="nama" value="Zulkarnain, Drs" required></td></li>
              </tr>
              <td><br></td>
              <tr>
                  <td><li>Tanggal lahir:</td>
                  <td><input type="date" name="tanggallahir" required></td></li>
                </tr>
                <td><br></td>
              <tr>
                  <td><li>Pangkat:</td>
                  <td>
                      <select name="pangkat" required>
                          <option value="1a">I/a</option>
                          <option value="1b">I/b</option>
                          <option value="1c">I/c</option>
                          <option value="1d">I/d</option>
                          <option value="2a">II/a</option>
                          <option value="2b">II/b</option>
                          <option value="2c">II/c</option>
                          <option value="2d">II/d</option>
                          <option value="3a">III/a</option>
                          <option value="3b">III/b</option>
                          <option value="3c">III/c</option>
                          <option value="3d">III/d</option>
                          <option value="4a">IV/a</option>
                          <option value="4b">IV/b</option>
                          <option value="4c">IV/c</option>
                          <option value="4d">IV/d</option>
                          <option value="4e">IV/e</option>
                          </select>
                  </td></li>
                </tr>
                <tr>
                    <td><li>Jenis Kelamin:</td>
                    <td>
                        <br><input type="radio" name="jeniskelamin" value="male" checked> Laki-laki
                        <br><input type="radio" name="jeniskelamin" value="female"> Perempuan
                    </td></li>
                  </tr>
                  <td><br></td>
                <tr>
                  <td><li>Jabatan:</td>
                  <td><input type="text" name="jabatan" value="Ka.Bid. Pengemb.Pegawai " required></td></li>
                </tr>
                <td><br></td>  
                <tr>
                    <td><li>Unit Kerja:</td>
                    <td><input type="text" name="unitkerja" value="BKD Kab. Batanghari" required></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>Pusat/Provinsi:</td>
                    <td><input type="text" name="pusatprovinsi" value="Jambi" required></td></li>
                  </tr>
                  <td><br></td>
                <tr>
                    <td><li>Diklat/Angkatan:</td>
                    <td><input type="text" name="diklatangkatan" value="Lokakarya Prog.Diklat Nakertrs I" required></td></li>
                  </tr>
                  <td><br></td>    
                <tr>
                    <td><li>Tahun:</td>
                    <td><input type="number" name="tahun" value="2006" required></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>No. Hp:</td>
                    <td><input type="tel" name="nohp" value="08XXX" required></td></li>
                  </tr>
                  <td><br></td> 
                <tr>
                    <td><li>Email:</td>
                    <td><input type="email" name="email" value="user@domain.com" required></td></li>
                  </tr>
                  <td><br></td>      
            </table>
        </ul>
            <br><input type="submit" value="Submit">
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