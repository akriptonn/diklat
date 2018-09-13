<?php
header('Content-Type: application/json');
session_start();
$conn = mysqli_connect("localhost","root","","login");

$sq = "SELECT id, butir_penilaian,NamaDiklat,Tempat,Durasi,AVG(Nilai) as Nilai FROM penyelenggaranilaiev,butirnilaipenyelenggaraev,reratanilaipenyelenggaraev where id=id_butirnilai and transaksi = reratanilaipenyelenggaraev.prime and";
                    $sq = $sq . " NamaDiklat = " . "'" . $_SESSION['program'] ."'";
                    $sq = $sq . " and Tempat = " . "'" . $_SESSION['tempat'] ."'";
                    $sq = $sq . " and Durasi = " . "'" . $_SESSION['durasi'] ."'";
                    $sq = $sq . " GROUP BY id,butir_penilaian,NamaDiklat,Tempat,Durasi ORDER BY id ASC;";

$result = mysqli_query($conn,$sq);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

