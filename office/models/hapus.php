<?php
require '../../include/fungsi.php';

if ($_GET["code"] == "hapusmarketing") {
	$id = $_GET["id"];

	if (hapusmarketing($id) > 0) {
		echo "          
	            <script>
	                document.location.href = '../proposal';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../proposal';
	            </script>
	            ";
	}
} elseif ($_GET["code"] == "hapusproposal") {
	$id = $_GET["id"];


	if (hapusproposal($id) > 0) {
		echo "          
	            <script>
	                document.location.href = '../proposal';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../proposal';
	            </script>
	            ";
	}
} elseif ($_GET["code"] == "hapusproyek") {
	$id = $_GET["id"];


	if (hapusproyek($id) > 0) {
		echo "          
	            <script>
	                document.location.href = '../proyek';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../proyek';
	            </script>
	            ";
	}
} elseif ($_GET["code"] == "hapuspembayaran") {
	$id = $_GET["id"];
	$detpro = query("SELECT * FROM pembayaranpmr WHERE id = '$id' ")[0];
	$kp = $detpro['kodeproyek'];


	if (hapuspembayaran($id) > 0) {
		echo "          
	            <script>
	                document.location.href = '../detailproyek.php?kp=$kp';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../detailproyek?kp=$kp';
	            </script>
	            ";
	}
}
