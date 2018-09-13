<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","","login");

$sqlQuery = "SELECT NamaCoach as NamaPenceramah,AVG(averages) as average FROM reratanilaicoach GROUP BY NamaCoach ORDER BY average DESC";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

