<?php
require '../include/fungsi.php';

if ($_GET["code"] == "hapusunit") {
	$id = $_GET["id"];


	if (hapusunit($id) > 0) {
		echo "          
	            <script>
	                document.location.href = '../inventory/unit';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../inventory/unit';
	            </script>
	            ";
	}
}
