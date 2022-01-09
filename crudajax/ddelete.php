<?php 
require '../include/fungsi.php';

$sql = "DELETE FROM marketing WHERE id='".$_GET['id']."' ";
$result = mysqli_query($conn,$sql);