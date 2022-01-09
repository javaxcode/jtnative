<?php 

require '../include/fungsi.php';

$sql = "SELECT * FROM marketing ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result)>0) {
	while ($row = mysqli_fetch_assoc($result)){
		$link_delete = "<a class='hapusdata' href='ddelete.php?id=".$row['id']."'>Delete</a>";
		echo $row['kodemarketing']." - ".$row['marketing']." | ".$link_delete."<br/>";
	}
}