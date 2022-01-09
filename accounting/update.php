<?php
//update.php
//$conn = mysqli_connect('localhost', 'root','','u1976353_jt');
//$conn = mysqli_connect('localhost', 'root','','u8953447_jt');
require '../include/fungsi.php';

$query = "
 UPDATE akasbankkeluar SET ".$_POST["name"]." = '".$_POST["value"]."' 
 WHERE id = '".$_POST["pk"]."'";
mysqli_query($conn, $query);
?>