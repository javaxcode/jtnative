<?php
//fetch.php
//$conn = mysqli_connect('localhost', 'root','','u1976353_jt');
//$conn = mysqli_connect('localhost', 'root','','u8953447_jt');
require '../include/fungsi.php';

$query = "SELECT * FROM kodeakun JOIN akasbankkeluar ON akasbankkeluar.kodeakun = kodeakun.kodeakun3 WHERE month(tanggal) = '10'  AND year(tanggal) ='2021' ORDER BY akasbankkeluar.id ASC";
$result = mysqli_query($conn, $query);
$output = array();
while($row = mysqli_fetch_assoc($result))
{
 $output[] = $row;
}
echo json_encode($output);
