<?php
$connect = mysqli_connect("localhost", "root", "", "u1976353_jt");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM marketing WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>