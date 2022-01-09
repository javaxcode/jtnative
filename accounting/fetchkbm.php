<?php
//fetch.php

//$conn = mysqli_connect('localhost', 'root','','u8953447_jt');
//$conn = mysqli_connect('stasiuntrader.net', 'u1976353_javatechnic','212jt212','u1976353_jt');
require '../include/fungsi.php';

if (isset($_POST['tampilkan'])) {

	$bulan = $_POST['bulan'];
	//echo "$bulan";
	$query = "SELECT * FROM kodeakun JOIN akasbankmasuk ON akasbankmasuk.kodeakun = kodeakun.kodeakun3 WHERE month(tanggal) = '02' ORDER BY akasbankmasuk.id ASC";
	$result = mysqli_query($conn, $query);
	$output = array();
	while($row = mysqli_fetch_assoc($result))
	{
	 $output[] = $row;
	}
	
	echo json_encode($output);
	echo "
            <script>
                
                document.location.href = 'kasbankmasuk';                
            </script>
            ";
	
}else{
	$query = "SELECT * FROM kodeakun JOIN akasbankmasuk ON akasbankmasuk.kodeakun = kodeakun.kodeakun3 WHERE month(tanggal) = '12' AND year(tanggal) = '2021' ORDER BY akasbankmasuk.id ASC";
	$result = mysqli_query($conn, $query);
	$output = array();
	while($row = mysqli_fetch_assoc($result))
	{
	 $output[] = $row;
	}
	echo json_encode($output);
}
