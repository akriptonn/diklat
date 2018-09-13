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
$query = mysqli_query($koneksi,"SELECT * FROM alumni ORDER BY alumni.id ASC");
?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Alumni</title>
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
          <h3>Alumni</h3>
        </header>
        <section>
          <article>
              <ul>
                <form action="">
                  <table id="alumni" border="1">
                    <tr>
                        <td>No.</td>
                        <td>NIP</td>
                        <td>Nama</td>
                        <td>Tanggal Lahir</td>
                        <td>Pangkat</td>
                        <td>Jenis Kelamin</td>
                        <td>Jabatan</td>
                        <td>Unit Kerja</td>
                        <td>Pusat/Provinsi</td>
                        <td>Diklat/Angkatan</td>
                        <td>Tahun</td>
                        <td>No. Hp</td>
                        <td>Email   </td>
                    </tr>
                    <?php if(mysqli_num_rows($query)) {?>
                    <?php while($row = mysqli_fetch_array($query)) {?>
                    <tr>
                        <td><?php $rans = $rans + 1; echo $rans?></td>
                        <td><?php echo $row['nip']?></td>
                        <td><?php echo $row['nama']?></td>
                        <td><?php echo $row['ttl']?></td>
                        <td><?php echo $row['pangkat']?></td>
                        <td><?php echo $row['jenis kelamin']?></td>
                        <td><?php echo $row['jabatan']?></td>
                        <td><?php echo $row['unit kerja']?></td>
                        <td><?php echo $row['pusat provinsi']?></td>
                        <td><?php echo $row['diklat angkatan']?></td>
                        <td><?php echo $row['tahun']?></td>
                        <td><?php echo $row['no hp']?></td>
                        <td><?php echo $row['email']?></td>
                    </tr>   
                    <?php } ?>
                    <?php } ?>          
                  </table>
                  <br>
                  <button onclick="location.href='admin.php'"type="button">Kembali</button>    
                  <button onclick="exportTableToExcel('alumni', 'Daftar Alumni')">Download</button>         
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