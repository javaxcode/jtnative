<?php 
	include '../../include/fungsi.php';

	$item = $_POST['menu'];
	$tampil=mysqli_query($conn, "SELECT * FROM user_sub_menu WHERE menu_id='$item'");
	$jml=mysqli_num_rows($tampil);
	if($jml > 0){
	    echo"
	     <option selected>- Keterangan -</option>";
	     while($r=mysqli_fetch_array($tampil)){
	         echo "<option value='$r[id]'>$r[title]</option>";
			 
	     }
	}else{
	    echo "
	     <option selected>- Tidak ada data SubItem -</option>";
	}
?>