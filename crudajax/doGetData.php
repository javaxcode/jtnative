<?php 
require '../include/fungsi.php';

$sql = "SELECT * FROM marketing ORDER BY id DESC";
$proyek = mysqli_query($conn,$sql);
//$queryResult = $conn->query("SELECT * FROM marketing ");
$result = array();
while ($row = mysqli_fetch_assoc($proyek)){
	$result[] = $row;
}

echo json_encode($result);
