<?php
header('Content-Type: application/json');
session_start();
$conn = mysqli_connect("localhost","root","","login");

$sqlQuery = "SELECT matpel,NamaPenceramah,(average) FROM ratanilaipenceramah where program = '";
$sqlQuery = $sqlQuery . $_SESSION['temp'] . "' ";
$sqlQuery = $sqlQuery . "ORDER BY average DESC";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

