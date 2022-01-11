<?php
require '../include/fungsi.php';

// if ($_GET["code"]=="hapususer") {
// 	$id = $_GET["id"];


// 	if ( hapususer ($id) > 0) {
// 		echo "          
// 	            <script>

// 	                document.location.href = '../admin/user';
// 	            </script>
// 	            ";
// 	    } else {
// 	        echo "
// 	            <script>
// 	                alert('data user dihapus');
// 	                document.location.href = '../admin/user';
// 	            </script>
// 	            ";
// 	}
// }elseif ($_GET["code"]=="hapusmenu") {
// 	$id = $_GET["id"];


// 	if ( hapusmenu ($id) > 0) {
// 		echo "          
// 	            <script>

// 	                document.location.href = '../admin/menu';
// 	            </script>
// 	            ";
// 	    } else {
// 	        echo "
// 	            <script>
// 	                alert('data user dihapus');
// 	                document.location.href = '../admin/menu';
// 	            </script>
// 	            ";
// 	}
// }elseif ($_GET["code"]=="hapusunit") {
// 	$id = $_GET["id"];


// 	if ( hapusunit ($id) > 0) {
// 		echo "          
// 	            <script>
// 	                document.location.href = '../inventory/unit';
// 	            </script>
// 	            ";
// 	    } else {
// 	        echo "
// 	            <script>
// 	                alert('data gagal dihapus');
// 	                document.location.href = '../inventory/unit';
// 	            </script>
// 	            ";
// 	}
// }elseif ($_GET["code"]=="hapusmarketing") {
// 	$id = $_GET["id"];
if ($_GET["code"] == "hapusmarketing") {
	$id = $_GET["id"];

	if (hapusmarketing($id) > 0) {
		echo "          
	            <script>
	                document.location.href = '../office/proposal';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../office/proposal';
	            </script>
	            ";
	}
} elseif ($_GET["code"] == "hapusproposal") {
	$id = $_GET["id"];


	if (hapusproposal($id) > 0) {
		echo "          
	            <script>
	                document.location.href = '../office/proposal';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../office/proposal';
	            </script>
	            ";
	}
} elseif ($_GET["code"] == "hapusproyek") {
	$id = $_GET["id"];


	if (hapusproyek($id) > 0) {
		echo "          
	            <script>
	                document.location.href = '../office/proyek';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../office/proyek';
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
	                document.location.href = '../office/detailproyek.php?kp=$kp';
	            </script>
	            ";
	} else {
		echo "
	            <script>
	                alert('data gagal dihapus');
	                document.location.href = '../office/detailproyek?kp=$kp';
	            </script>
	            ";
	}
}
