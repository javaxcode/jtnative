<?php
require '../include/fungsi.php';

$id = $_GET["ip"];
$p = query("SELECT * FROM proposal WHERE id = '$id' ")[0];

$statuspro = 1;

//query edit data
$query = "UPDATE proposal SET
            status = '$statuspro'
    WHERE id = $id
";
mysqli_query($conn, $query);
$noinvoice = "";
$nproposal = $p['kodepro'] . $p['kodebulan'] . $p['kodetr'];
$namaklien = $p['namaklien'];
$outlet = $p['outlet'];
$tempat = $p['tempat'];
$pekerjaan = $p['pekerjaan'];
$nilaiproyek = $p['nilaiproyek'];
$keterangan = $p['keterangan'];
$status = 0;

date_default_timezone_set('Asia/Jakarta');
$date = new DateTime();
$tanggalpjt = $date->format('Y-m-d');
$butl = substr($date->format('Y-m-d'), 5, 2);
$thl = substr($date->format('Y-m-d'), 2, 2);
$kodeproyek = "PJT";
$t = substr($thl, 8, 2);
$kodebulan = $thl . $butl;

$kas = query("SELECT * FROM proyek WHERE month(tanggalpjt) ='$butl' ORDER BY id DESC LIMIT 1")[0];
if ($kas['kodebulan'] != $t . $kodebulan) {
    $newkodetr = "001";
} else {
    $lastkode = query("SELECT * FROM proyek WHERE kodeproyek ='PJT' AND month(tanggalpjt) ='$butl' ORDER BY id DESC LIMIT 1")[0];
    $lk = $lastkode['kodetr'];
    $noUrut = (int) $lastkode['kodetr'];
    $noUrut++;
    $newkodetr = sprintf("%03s", $noUrut);
}

//query insert data
$query = "INSERT INTO proyek 
            VALUES 
            ('','$tanggalpjt','$nproposal','$kodeproyek','$kodebulan','$newkodetr','$namaklien','$outlet','$tempat','$pekerjaan','$nilaiproyek','$keterangan','$status')
        ";
mysqli_query($conn, $query);


//cek apakh data berhasil di tambahkan
if (mysqli_affected_rows($conn) > 0) {
    echo "
        <script>
            alert('Input Proyek berhasil');
            document.location.href = '../office/proyek';                
        </script>
        ";
} else {
    echo "
        <script>
            alert('Input Proyek Gagal');                
            document.location.href = '../office/proposal';                
        </script>
        ";
}
