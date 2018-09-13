<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","login");

$sqlQuery = "SELECT matpel,NamaPenceramah,AVG(average) as average FROM ratanilaipenceramah GROUP BY matpel,NamaPenceramah ORDER BY average DESC";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

