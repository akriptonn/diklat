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
$rans = 0;
// $query = mysqli_query($koneksi, "SELECT matpel,NamaPengajar,average FROM ratanilaipengampu where program='Pelatihan Dasar Calon PNS Golongan II' ORDER BY average DESC");


?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Peringkat Widyaiswara</title>
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
          <h3>Peringkat</h3>
          <h5>Rekapitulasi Evaluasi Widyaiswara</h5>
          <form action="pengampuperingkat.php" method="post">
          <h5>Program <select name="program">
                <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Program from pengampudiklat where Program != '';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['Program'];?>"><?php echo $row['Program'];}} ?></option>
                    </select></h5>

          <input type="submit" id="submit" name="submit" value="Submit">
          </form>
        </header>
        <section>
          <article>
          <?php if (isset($_POST['submit'])){ ?>
              <ul>
                <form action="">
                  <table id="pengampuperingkat" border="0">
                  <tr>
                  <td></td>
                  <td>DAFTAR PERINGKAT</td>
                  </tr>
                  <tr>
                    <Td></td>
                    <td>REKAPITULASI EVALUASI WIDYAISWARA</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td><?php echo $_POST['program']?></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>Peringkat</td>
                        <td>Mata Diklat</td>
                        <td>Nama Widyaiswara</td>
                        <td>Nilai Rata-Rata</td>
                        <td>Predikat</td>
                    </tr>       
                    <?php
                    $sq = "SELECT matpel,NamaPengajar,average FROM ratanilaipengampu where ";
                    $sq = $sq . "program = " . "'" . $_POST['program'] . "' ";
                    $sq = $sq ."ORDER BY average DESC";
                    // echo $sq;
                    $query = mysqli_query($koneksi, $sq);
                    if(mysqli_num_rows($query)>0) {?>
                    <?php while($row = mysqli_fetch_array($query)) {?>
                    <tr>
                        <td><?php $rans = $rans + 1; echo $rans?></td>
                        <td><?php echo $row['matpel']?></td>
                        <td><?php echo $row['NamaPengajar']?></td>
                        <td><?php echo number_format($row['average'],2)?></td>
                        <td><?php $simpan = $row['average']; if ($simpan >= 82.51){ echo "Sangat Baik";} else if ($simpan >= 72.5){echo "Baik";} else if ($simpan >= 62.51){echo "Cukup";} else {echo "Kurang";} ?></td>
                    </tr>
                    <?php }}?>    
                  </table>
                  <br>
                  <button onclick="location.href='pengampuadmin.php'"type="button">Kembali</button>     
                  <button onclick="exportTableToExcel('pengampuperingkat', 'pengampu peringkat')">Download</button>

                  <?php } ?>        
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