<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","login");

$sqlQuery = "SELECT NamaMentor as NamaPenceramah,AVG(averages) as average FROM reratanilaimentor GROUP BY NamaMentor ORDER BY average DESC";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

