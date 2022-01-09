<?php 

require '../include/fungsi.php';

$sql = "SELECT * FROM marketing ORDER BY id DESC";
$proyek = mysqli_query($conn,$sql);

if (mysqli_num_rows($proyek)>0) {
	$i = 1;
	while ($row = mysqli_fetch_assoc($proyek)){
		
		echo '
		<tr class="gradeX">
			<td>'.$i.'</td>
	        <td>'.$row['kodemarketing'].'</td>
	        <td>'.$row['marketing'].'</td>
	        <td class="actions">
	            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
	            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
	            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
	            <a class="hapusdata" href="delete.php?id='.$row['id'].'" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
	        </td>
	    </tr>
	    ';
	    $i++;
	}
	
}
//$proyek = query("SELECT * FROM proyekjt1 ");

	// echo '
	// <tr class="gradeX">
 //        <td>Trident</td>
 //        <td>Internet
 //            Explorer 4.0
 //        </td>
 //        <td>Win 95+</td>
 //        <td class="actions">
 //            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
 //            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
 //            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
 //            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
 //        </td>
 //    </tr>
 //    ';