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
    <title>Rekapitulasi Hasil Evaluasi Coach</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <script>
  function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
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
            <form action="coachindividu.php" method="post">
              <h2 style="color: rgb(34, 80, 90)">Rekapitulasi Hasil Evaluasi Coach</h2>
              <p><img src="kemnakerri.jpg" width="200px"></p><br>
              <p style="color: rgb(34, 80, 90)">Nama Coach :<select name="namapengajar">
                    <?php $query = mysqli_query($koneksi, "SELECT DISTINCT NamaCoach as NamaPengajar from coachdiklat where NamaCoach !='';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['NamaPengajar']; ?>"><?php echo $row['NamaPengajar'];}} ?></option>
                    </select></p>
              <p style="color: rgb(34, 80, 90)">Kelompok :<select name="kelompok">
                    <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Kelompok as tanggalwaktu from reratanilaicoach where Kelompok !='';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['tanggalwaktu']; ?>"><?php echo $row['tanggalwaktu'];}} ?></option>
                    </select></p>
              <p style="color: rgb(34, 80, 90)">Angkatan/Tahun :<select name="angkatantahun">
                    <?php $query = mysqli_query($koneksi, "SELECT DISTINCT angkatantahun from reratanilaicoach where angkatantahun !='';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['angkatantahun']; ?>"><?php echo $row['angkatantahun'];}} ?></option>
                    </select></p> <input type="submit" id="submit" name="submit" value="Submit">
              </form>  
            </nav>
          <article>
          <?php if (isset($_POST['submit'])){ ?>
          
              <ul>
                  <table id="coach" border="0">
                  <tr>
                    <Td></td>
                    <td>REKAPITULASI HASIL EVALUASI COACH</td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                    <td></td>
                    <td>Nama Coach : <?php echo $_POST['namapengajar']?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Kelompok : <?php echo $_POST['kelompok']?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Angkatan/Tahun : <?php echo $_POST['angkatantahun']?></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>No.</td>
                        <td>Butir Penilaian</td>
                        <td>Nilai</td>
                        <td>Predikat</td>
                    </tr>
                    <?php $sq = "SELECT id, butir_penilaian,NamaCoach,kelompok,angkatantahun,AVG(Nilai) as Nilai FROM coachnilai,butirnilaicoach,reratanilaicoach where id=id_butirnilai and transaksi = reratanilaicoach.prime and";
                    $sq = $sq . " NamaCoach = " . "'" . $_POST['namapengajar'] ."'";          
                    $sq = $sq . " and angkatantahun = " . "'" . $_POST['angkatantahun'] ."'";            
                    $sq = $sq . " and kelompok = " . "'" . $_POST['kelompok'] ."'";
                    $sq = $sq . " GROUP BY id, butir_penilaian,NamaCoach,kelompok,angkatantahun ORDER BY id ASC;";
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
                    <?php } $sq = "SELECT averages FROM reratanilaicoach where ";
                        $sq = $sq . " NamaCoach = " . "'" . $_POST['namapengajar'] ."'";          
                        $sq = $sq . " and angkatantahun = " . "'" . $_POST['angkatantahun'] ."'";            
                        $sq = $sq . " and kelompok = " . "'" . $_POST['kelompok'] ."'";
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
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                    <td></td>
                        <td>Komentar</td>
                    </tr>
                    <tr>
                    <td></td>
                        <td><?php
                        $sq = "SELECT Saran from sarancoach,reratanilaicoach where transaksi = reratanilaicoach.prime and ";
                        $sq = $sq . " NamaCoach = " . "'" . $_POST['namapengajar'] ."'";          
                        $sq = $sq . " and angkatantahun = " . "'" . $_POST['angkatantahun'] ."'";            
                        $sq = $sq . " and kelompok = " . "'" . $_POST['kelompok'] ."'";
                        $sq = $sq . " ;";
                        // echo $sq;
                        $query = mysqli_query($koneksi, $sq); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){if(($row['Saran'] != "-")&&($row['Saran'] != " ")&&($row['Saran'] != "")){echo "- ";echo $row['Saran']; echo "<br>";}} } ?></td>
                    </tr>
                    </table>
                  <br>
                  <button onclick="location.href='coachadmin.php'"type="button">Kembali</button> 
                  <button onclick="exportTableToExcel('coach', 'coach')">Download</button> 
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