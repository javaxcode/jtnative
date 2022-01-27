<?php
require '../../include/fungsi.php';

if (isset($_POST["inputmarketing"])) {
    $kodemarketing = query("SELECT * FROM marketing ORDER BY id DESC LIMIT 1")[0];
    $kodem = substr($kodemarketing['kodemarketing'], 1);
    $noUrut = (int) $kodem;
    $noUrut++;
    $newkodetr = sprintf("%03s", $noUrut);

    $kode = "M";
    $km = $kode . $newkodetr;

    $nmarketing = htmlspecialchars($_POST["marketing"]);
    $alamat = "0";
    $nohp = "0";
    $bank = "0";
    $norek = "0";

    //query insert data
    $query = "INSERT INTO marketing 
                VALUES 
                ('','$km','$nmarketing','$alamat','$nohp','$bank','$norek')
            ";
    mysqli_query($conn, $query);


    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Input marketing berhasil');
                document.location.href = '../proposal';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Input marketing gagal');                
                document.location.href = '../proposal';                
            </script>
            ";
    }
} elseif (isset($_POST["inputproposal"])) {
    $tl = htmlspecialchars($_POST["tanggal"]);
    $ttl = $tl;
    $tatl = substr($ttl, 3, 2);
    $bul = substr($ttl, 0, 2);
    $tahtl = substr($ttl, 6, 4);
    $tang = $tahtl . '-' . $bul . '-' . $tatl;
    $tanggal = date('Y-m-d', strtotime($tang));


    $t = substr($ttl, 8, 2);
    $kodeproyek = "PRO" . $t . $bul . "0" . $tatl;
    $kodebulan = $t . $bul;

    $kas = query("SELECT * FROM proyekjt WHERE month(tanggalpro) ='$bul' ORDER BY id DESC LIMIT 1")[0];
    if ($kas['tanggalpro'] != $kodebulan) {
        // $newkodetr = "001";
    } else {
        $lastkode = query("SELECT * FROM proyekjt WHERE noproposal ='$kodeproyek' AND month(tanggalpro) ='$tang' ORDER BY id DESC LIMIT 1")[0];
        $lk = $lastkode['kodetr'];
        $noUrut = (int) $lastkode['kodetr'];
        $noUrut++;
        // $newkodetr = sprintf("%03s", $noUrut);
        $newkodetr = "PJT" . $t . $bul . "0" . $tatl;
    }

    $namaklien = htmlspecialchars($_POST["namaklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $keterangan = "";
    $status = 0;


    //query insert data
    $query = "INSERT INTO proyekjt 
                VALUES 
                ('','$tanggal','$tanggal','$kodeproyek','$newkodetr','$namaklien','$outlet','$tempat','$pekerjaan','$nilaiproyek','$keterangan','$status','')
            ";
    mysqli_query($conn, $query);


    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Input Proyek berhasil');
                document.location.href = '../proposal';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Input Proyek Gagal');                
                document.location.href = '../proposal';                
            </script>
            ";
    }
} elseif (isset($_POST["inputkas"])) {

    $tl = htmlspecialchars($_POST["tanggal"]);
    $ttl = $tl;
    $tatl = substr($ttl, 3, 2);
    $butli = substr($ttl, 0, 2);
    $tahtl = substr($ttl, 6, 4);
    $tang = $tahtl . '-' . $butli . '-' . $tatl;
    $tanggal = date('Y-m-d', strtotime($tang));

    date_default_timezone_set('Asia/Jakarta');
    $date = new DateTime();
    $butl = substr($date->format('Y-m-d'), 5, 2);
    $thl = substr($date->format('Y-m-d'), 2, 2);
    $kodekas = "KM";
    $kodebulan = $thl . $butl;

    if ($butli != $butl) {
        echo "
            <script>
                alert('Input Tanggal tidak sesuai dengan bulan ini');
                document.location.href = '../kaskecil';                    
            </script>
            ";
        return false;
    }

    $kas = query("SELECT * FROM kas WHERE kodekas ='KM' ORDER BY id DESC LIMIT 1")[0];

    if ($kas['kodekas'] . $kas['kodebulan'] != $kodekas . $thl . $butl) {
        $newkodetr = "0001";
    } else {
        $lastkode = query("SELECT * FROM kas WHERE kodekas ='KM' ORDER BY id DESC LIMIT 1")[0];
        $lk = $lastkode['kodetr'];
        $noUrut = (int) $lastkode['kodetr'];
        $noUrut++;
        $newkodetr = sprintf("%04s", $noUrut);
    }

    $skas = query("SELECT * FROM kas ORDER BY id DESC LIMIT 1")[0];
    $saldokas = $skas["saldo"];

    //$novoucher = htmlspecialchars($_POST["nv"]);
    $payto = htmlspecialchars($_POST["payto"]);
    $keterangan = htmlspecialchars($_POST["keterangan"]);
    $input = htmlspecialchars($_POST["jumlahinput"]);
    $output = 0;
    $saldo = $saldokas + $input;
    $kodeakun = htmlspecialchars($_POST["kodeakun"]);

    //query insert data
    $query = "INSERT INTO kas 
                VALUES 
                ('','$tanggal','$kodekas','$a','$newkodetr','$payto','$keterangan','$input','$output','$saldo','$kodeakun')
            ";
    mysqli_query($conn, $query);


    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Input Pemasukan Kas berhasil');
                document.location.href = '../kaskecil';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Input Pemasukan Kas Gagal');                
                document.location.href = '../kaskecil';                
            </script>
            ";
    }
} elseif (isset($_POST["outputkas"])) {

    $tl = htmlspecialchars($_POST["tanggal"]);
    $ttl = $tl;
    $tatl = substr($ttl, 3, 2);
    $butli = substr($ttl, 0, 2);
    $tahtl = substr($ttl, 6, 4);
    $tang = $tahtl . '-' . $butli . '-' . $tatl;
    $tanggal = date('Y-m-d', strtotime($tang));

    date_default_timezone_set('Asia/Jakarta');
    $date = new DateTime();
    $butl = substr($date->format('Y-m-d'), 5, 2);
    $thl = substr($date->format('Y-m-d'), 2, 2);
    $kodekas = "KK";
    $a = $thl . $butl;

    if ($butli != $butl) {
        echo "
            <script>
                alert('Input Tanggal tidak sesuai dengan bulan ini');
                document.location.href = '../kaskecil';                    
            </script>
            ";
        return false;
    }


    $kas = query("SELECT * FROM kas WHERE kodekas ='KK' ORDER BY id DESC LIMIT 1")[0];
    if ($kas['kodekas'] . $kas['kodebulan'] != $kodekas . $thl . $butl) {
        $newkodetr = "0001";
    } else {
        $lastkode = query("SELECT * FROM kas WHERE kodekas ='KK' ORDER BY id DESC LIMIT 1")[0];
        $lk = $lastkode['kodetr'];
        $noUrut = (int) $lastkode['kodetr'];
        $noUrut++;
        $newkodetr = sprintf("%04s", $noUrut);
    }
    $skas = query("SELECT * FROM kas ORDER BY id DESC LIMIT 1")[0];
    $saldokas = $skas["saldo"];

    //$kodetr = htmlspecialchars($_POST["nv"]);
    $payto = htmlspecialchars($_POST["payto"]);
    $keterangan = htmlspecialchars($_POST["keterangan"]);
    $input = 0;
    $output = htmlspecialchars($_POST["jumlahoutput"]);
    $saldo = $saldokas - $output;
    $kodeakun = htmlspecialchars($_POST["kodeakun"]);

    //query insert data
    $query = "INSERT INTO kas 
                VALUES 
                ('','$tanggal','$kodekas','$kodebulan','$newkodetr','$payto','$keterangan','$input','$output','$saldo','$kodeakun')
            ";
    mysqli_query($conn, $query);


    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Input Pengeluaran Kas berhasil');
                document.location.href = '../kaskecil';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Input Pengeluaran Kas Gagal');                
                document.location.href = '../kaskecil';                
            </script>
            ";
    }
}
