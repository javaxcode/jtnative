<?php
require '../include/fungsi.php';

if ($_POST['tambahan'] != "tambahan") {
	$tanggalsaja = $_POST['tanggalsaja']; // Ambil data nis dan masukkan ke variabel nis
	$tanggaljtsaja = $_POST["tanggaljtsaja"];
	$suppliersaja = $_POST["suppliersaja"];
	$nofaktursaja = $_POST["nofaktursaja"];
	$statussaja = 1;

	//query insert data
	$query = "INSERT INTO beliunit
	            VALUES 
	            ('','$tanggalsaja','$tanggaljtsaja','$suppliersaja','$nofaktursaja','$statussaja')
	        ";
	mysqli_query($conn, $query);
}


// Ambil data yang dikirim dari form
$tanggal = $_POST['tanggal']; // Ambil data nis dan masukkan ke variabel nis
$tanggaljt = $_POST["tanggaljt"];
$supplier = $_POST["supplier"];
$nofaktur = $_POST["nofaktur"];
$unit = $_POST["namaunit"];
$jumlah = $_POST["qty"];
$merk = $_POST["merk"];
$harga = $_POST["harga"];
$diskon = $_POST["diskon"];
$ppn = $_POST["ppn"];
$status = 1;

// Proses simpan ke Database
$query = "INSERT INTO pembelianunit VALUES";

$index = 0; // Set index array awal dengan 0
foreach ($tanggal as $tanggalnis) { // Kita buat perulangan berdasarkan nis sampai data terakhir
	$hb = $harga[$index] - (($harga[$index] * $diskon[$index]) / 100);
	$hargabeli = $hb + ($hb * $ppn[$index]) / 100;
	$totalharga = $jumlah[$index] * $hargabeli;
	$query .= "('','" . $tanggalnis . "','" . $supplier[$index] . "','" . $tanggaljt[$index] . "','" . $nofaktur[$index] . "','" . $unit[$index] . "','" . $merk[$index] . "','" . $harga[$index] . "','" . $diskon[$index] . "','" . $ppn[$index] . "','" . $hargabeli . "','" . $jumlah[$index] . "','" . $totalharga . "','" . $status . "'),";
	$index++;
}

// Kita hilangkan tanda koma di akhir query
// sehingga kalau di echo $query nya akan sepert ini : (contoh ada 2 data siswa)
// INSERT INTO siswa VALUES('1011001','Rizaldi','Laki-laki','089288277372','Bandung'),('1011002','Siska','Perempuan','085266255121','Jakarta');
$query = substr($query, 0, strlen($query) - 1) . ";";

// Eksekusi $query
mysqli_query($conn, $query);



// Buat sebuah alert sukses, dan redirect ke halaman awal (index.php)
//echo "<script>alert('Data berhasil disimpan');window.location = 'unit.php';</script>";

header("location:unit");
