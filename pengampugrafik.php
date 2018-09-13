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
$query = mysqli_query($koneksi, "SELECT * FROM coach ORDER BY coach.id ASC");
if (isset($_GET['submit'])){
    $_SESSION['temp'] = $_GET['program'];
    
}

?>

<!DOCTYPE html>
<HTML>
  <head>
    <link rel="shortcut icon" href="kemnakerri.jpg">
    <title>Grafik Widyaiswara</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
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
            <form action="pengampugrafik.php" method="get">
              <h2 style="color: rgb(34, 80, 90)">Grafik Widyaiswara</h2>
              <p><img src="kemnakerri.jpg" width="200px"></p><br>
              <p style="color: rgb(34, 80, 90)">Program : <select name="program">
                <?php $query = mysqli_query($koneksi, "SELECT DISTINCT Program from pengampudiklat where Program != '';"); if(mysqli_num_rows($query)>0){while($row = mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['Program'];?>"><?php echo $row['Program'];}} ?></option>
                    </select> </p>
                    <input type="submit" id="submit" name="submit" value="Submit">
              </form>
            </nav>
          <article>
          <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>
    <?php if(isset($_GET['submit'])){ ?>
    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("daeta/data1.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].NamaPengajar+" : "+data[i].matpel);
                        marks.push(data[i].average);
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
                  <button onclick="location.href='pengampuadmin.php'"type="button">Kembali</button> 
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