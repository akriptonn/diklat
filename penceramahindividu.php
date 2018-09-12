<?php
ob_start();
session_start();
if(!isset($_SESSION['akun_id'])) header("location: login.php");
elseif($_SESSION['akun_status']=="0"){
  header("location: option.php");
}
elseif($_SESSION['akun_status']=="2"){
  header("location: evaluator.php");
}

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
    <title>Rekapitulasi Hasil Evaluasi Penceramah</title>
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
              <form action="penceramahindividu.php" method="post">
              <h2 style="color: rgb(34, 80, 90)">Rekapitulasi Hasil Evaluasi Penceramah</h2>
              <p><img src="kemnakerri.jpg" width="200px"></p><br>
              <p style="color: rgb(34, 80, 90)">Program : <select name="program">
                <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Program from penceramahdiklat where Program != '';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['Program'];?>"><?php echo $row['Program'];}} ?></option>
                    </select> </p>
              <p style="color: rgb(34, 80, 90)">Nama Penceramah : <select name="namapengajar">
                    <?php $query = mysqli_query($koneksi, "SELECT DISTINCT NamaPenceramah as NamaPengajar from penceramahdiklat where NamaPenceramah !='';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['NamaPengajar']; ?>"><?php echo $row['NamaPengajar'];}} ?></option>
                    </select></p>
              <p style="color: rgb(34, 80, 90)">Jenis Ceramah : <select name="matapelatihan">
                  <?php $query = mysqli_query($koneksi, "SELECT DISTINCT JenisCeramah as MataDiklat from penceramahdiklat where JenisCeramah !='';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['MataDiklat']; ?>"><?php echo $row['MataDiklat'];}} ?></option>
                      </select></p>
              <p style="color: rgb(34, 80, 90)">Tanggal dan Waktu : <select name="tanggalwaktu">
                    <?php $query = mysqli_query($koneksi, "SELECT DISTINCT tanggalwaktu from reratanilaiceramah where tanggalwaktu !='';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['tanggalwaktu']; ?>"><?php echo $row['tanggalwaktu'];}} ?></option>
                    </select></p>
              <p style="color: rgb(34, 80, 90)">Angkatan/Tahun : <select name="angkatantahun">
                    <?php $query = mysqli_query($koneksi, "SELECT DISTINCT angkatantahun from reratanilaiceramah where angkatantahun !='';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['angkatantahun']; ?>"><?php echo $row['angkatantahun'];}} ?></option>
                    </select></p> <input type="submit" id="submit" name="submit" value="Submit">
                    </form>
            </nav>
          <article>
          <?php if (isset($_POST['submit'])){ ?>
              <ul>
                  <table border="1">
                    <tr>
                        <td>No.</td>
                        <td>Butir Penilaian</td>
                        <td>Nilai</td>
                        <td>Predikat</td>
                    </tr>
                    
                    <?php $sq = "SELECT id, butir_penilaian,tanggalwaktu,NamaPenceramah,program,matpel,angkatantahun,AVG(Nilai) as Nilai FROM penceramahnilai,butirnilaiceramah,reratanilaiceramah where id=id_butirnilai and transaksi = reratanilaiceramah.prime and";
                    $sq = $sq . " NamaPenceramah = " . "'" . $_POST['namapengajar'] ."'";
                    $sq = $sq . " and matpel = " . "'" . $_POST['matapelatihan'] ."'";
                    $sq = $sq . " and angkatantahun = " . "'" . $_POST['angkatantahun'] ."'";
                    $sq = $sq . " and tanggalwaktu = " . "'" . $_POST['tanggalwaktu'] ."'";
                    $sq = $sq . " and program = " . "'" . $_POST['program'] ."'";
                    $sq = $sq . " GROUP BY id, butir_penilaian,tanggalwaktu,NamaPenceramah,program,matpel,angkatantahun ORDER BY id ASC;";
                    // echo $sq;
                     $query = mysqli_query($koneksi, $sq);
 if(mysqli_num_rows($query)>0) {?>
                    <?php while($row = mysqli_fetch_array($query)) {?>
                    <tr>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['butir_penilaian']?></td>
                        <td><?php echo $row['Nilai']?></td>
                        <td><?php $simpan = $row['Nilai']; if ($simpan >= 82.51){ echo "Sangat Baik";} else if ($simpan >= 72.5){echo "Baik";} else if ($simpan >= 62.51){echo "Cukup";} else {echo "Kurang";} ?></td>
                    </tr>
                    <?php }?>
                    <?php } $sq = "SELECT averages FROM reratanilaiceramah where ";
                        $sq = $sq . " NamaPenceramah = " . "'" . $_POST['namapengajar'] ."'";
                        $sq = $sq . " and matpel = " . "'" . $_POST['matapelatihan'] ."'";
                        $sq = $sq . " and angkatantahun = " . "'" . $_POST['angkatantahun'] ."'";
                        $sq = $sq . " and tanggalwaktu = " . "'" . $_POST['tanggalwaktu'] ."'";
                        $sq = $sq . " and program = " . "'" . $_POST['program'] ."'";
                        $sq = $sq . " ;";
                        $query = mysqli_query($koneksi, $sq); if(mysqli_num_rows($query)>0){?>
                    <tr>
                        <td></td>
                        <td>Rata-rata</td>
                        <td><?php
                        while($row = mysqli_fetch_array($query)){echo $row['averages'];}
                             ?></td>
                        <td><?php $simpan = $row['averages']; if ($simpan >= 82.51){ echo "Sangat Baik";} else if ($simpan >= 72.5){echo "Baik";} else if ($simpan >= 62.51){echo "Cukup";} else {echo "Kurang";} ?></td>
                    </tr>   
                    <?php }?>          
                  </table>
                  <br>
                  Komentar
                  <table border="1">
                    <tr>
                        <td>Komentar</td>
                    </tr>
                    </table>
                  <br>
                  <button onclick="location.href='penceramahadmin.php'"type="button">Kembali</button>  
                  <?php } ?>             
          </article>
       </section>  
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