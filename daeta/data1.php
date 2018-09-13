<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","login");

$sqlQuery = "SELECT matpel,NamaPengajar,AVG(average) as average FROM ratanilaipengampu GROUP BY matpel,NamaPengajar ORDER BY average DESC";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

