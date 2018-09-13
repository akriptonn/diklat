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
$query = mysqli_query($koneksi, "SELECT * FROM penyelenggara ORDER BY penyelenggara.id ASC");


?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Rekapitulasi Hasil Evaluasi Penyelenggara oleh Peserta</title>
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
<style type="text/css">
BODY {
    width: auto;
}

#chart-container {
    width: auto;
    height: auto;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
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
            <form action="penyelenggarapeserta.php" method="post">
              <h2 style="color: rgb(34, 80, 90)">Rekapitulasi Hasil Evaluasi Penyelenggara oleh Evaluator</h2>
              <p><img src="kemnakerri.jpg" width="200px"></p><br>
              <p style="color: rgb(34, 80, 90)">Nama Diklat : <select name="program">
                <?php $query = mysqli_query($koneksi, "SELECT DISTINCT NamaDiklat as Program from penyelenggaradiklat where NamaDiklat != '';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['Program'];?>"><?php echo $row['Program'];}} ?></option>
                    </select></p>
              <p style="color: rgb(34, 80, 90)">Tempat : <select name="tempat">
                <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Tempat as Program from penyelenggaradiklat where Tempat != '';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['Program'];?>"><?php echo $row['Program'];}} ?></option>
                    </select></p>
              <p style="color: rgb(34, 80, 90)">Durasi : <select name="durasi">
                <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Durasi as Program from penyelenggaradiklat where Durasi != '';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['Program'];?>"><?php echo $row['Program'];}} ?></option>
                    </select></p> 
              <input type="submit" id="submit" name="submit" value="Submit">
              </form>
            </nav>
            <article>
          <?php if (isset($_POST['submit'])){ ?>
              <ul>
              <table id="penyelenggarapeserta" border="0">
                    <tr>
                    <td></td>
                    <td>Nama Diklat : <?php echo $_POST['program']?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Tempat : <?php echo $_POST['tempat']?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Durasi : <?php echo $_POST['durasi']?></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>No.</td>
                        <td>Butir Penilaian</td>
                        <td>Nilai</td>
                        <td>Predikat</td>
                    </tr>
                    <?php 
                    $sq = "SELECT id, butir_penilaian,NamaDiklat,Tempat,Durasi,AVG(Nilai) as Nilai FROM penyelenggaranilai,butirnilaipenyelenggara,reratanilaipenyelenggara where id=id_butirnilai and transaksi = reratanilaipenyelenggara.prime and";
                    $sq = $sq . " NamaDiklat = " . "'" . $_POST['program'] ."'";
                    $sq = $sq . " and Tempat = " . "'" . $_POST['tempat'] ."'";
                    $sq = $sq . " and Durasi = " . "'" . $_POST['durasi'] ."'";
                    $sq = $sq . " GROUP BY id,butir_penilaian,NamaDiklat,Tempat,Durasi ORDER BY id ASC;";

                    $_SESSION['program'] = $_POST['program'];
                    $_SESSION['tempat'] = $_POST['tempat'];
                    $_SESSION['durasi'] = $_POST['durasi'];
                    // echo $sq;
                    $query = mysqli_query($koneksi, $sq);
                    if(mysqli_num_rows($query)>0) {?>
                    <?php while($row = mysqli_fetch_array($query)) {?>
                    <tr>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['butir_penilaian']?></td>
                        <td><?php echo number_format($row['Nilai'],2)?></td>
                        <td><?php $simpan = $row['Nilai']; if ($simpan >= 82.51){ echo "Sangat Baik";} else if ($simpan >= 72.5){echo "Baik";} else if ($simpan >= 62.51){echo "Cukup";} else {echo "Kurang";} ?></td>
                    </tr>
                    <?php }?>
                    <?php } $sq = "SELECT averages FROM reratanilaipenyelenggara where ";
                        $sq = $sq . " NamaDiklat = " . "'" . $_POST['program'] ."'";
                        $sq = $sq . " and Tempat = " . "'" . $_POST['tempat'] ."'";
                        $sq = $sq . " and Durasi = " . "'" . $_POST['durasi'] ."'";
                        $sq = $sq . " ;";
                        $query = mysqli_query($koneksi, $sq); if(mysqli_num_rows($query)>0){?>
                    <tr>
                        <td></td>
                        <td>Rata-rata</td>
                        <td><?php
                        while($row = mysqli_fetch_array($query)){$simpan = $row['averages']; echo number_format($row['averages'],2);}
                             ?></td>
                        <td><?php  if ($simpan >= 82.51){ echo "Sangat Baik";} else if ($simpan >= 72.5){echo "Baik";} else if ($simpan >= 62.51){echo "Cukup";} else {echo "Kurang";} ?></td>
                        
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
                        $sq = "SELECT Saran from saranpenyelenggara,reratanilaipenyelenggara where transaksi = reratanilaipenyelenggara.prime and ";
                        $sq = $sq . " NamaDiklat = " . "'" . $_POST['program'] ."'";
                        $sq = $sq . " and Tempat = " . "'" . $_POST['tempat'] ."'";
                        $sq = $sq . " and Durasi = " . "'" . $_POST['durasi'] ."'";
                        $sq = $sq . " ;";
                        // echo $sq;
                        $query = mysqli_query($koneksi, $sq); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){if(($row['Saran'] != "-")&&($row['Saran'] != " ")&&($row['Saran'] != "")){echo "- ";echo $row['Saran']; echo "<br>";}} } ?></td>
                    </tr>
                    </table>
                    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("daeta/data6.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].butir_penilaian);
                        marks.push(data[i].Nilai);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Nilai Rata-Rata',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>          
                  <br>
                  <button onclick="location.href='penyelenggaraadmin.php'"type="button">Kembali</button>   
                  <button onclick="exportTableToExcel('penyelenggarapeserta', 'penyelenggara peserta')">Download</button>
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