<?php 
require '../include/fungsi.php';

if (isset($_POST["namamarketing"])) {
    $kodemarketing = query("SELECT * FROM marketing ORDER BY id DESC LIMIT 1")[0];
    $kodem = substr($kodemarketing['kodemarketing'],1);
    $noUrut = (int) $kodem;
    $noUrut++;    
    $newkodetr = sprintf("%03s", $noUrut);
        
    $kode = "M";
    $km = $kode.$newkodetr;

    $nmarketing = htmlspecialchars($_POST["namamarketing"]);
    $alamat = "0";
    $nohp = "0";
    $bank = "0";
    $norek = "0";
    //echo $nmarketing;
    
    //query insert data
    $query = "INSERT INTO marketing 
                VALUES 
                ('','$km','$nmarketing','$alamat','$nohp','$bank','$norek')
            ";
    

    
    //cek apakh data berhasil di tambahkan
    if( mysqli_query($conn, $query) ) {
        echo "Data berhasil di simpan";
    } else {
        echo "Error".mysqli_error($conn);
    }
}elseif (isset($_POST["proyek"])) {
    $kodemarketing = query("SELECT * FROM marketing ORDER BY id DESC LIMIT 1")[0];
    $kodem = substr($kodemarketing['kodemarketing'],1);
    $noUrut = (int) $kodem;
    $noUrut++;    
    $newkodetr = sprintf("%03s", $noUrut);
        
    $kode = "M";
    $km = $kode.$newkodetr;

    $nmarketing = htmlspecialchars($_POST["namamarketing"]);
    $alamat = "0";
    $nohp = "0";
    $bank = "0";
    $norek = "0";
    //echo $nmarketing;
    
    //query insert data
    $query = "INSERT INTO marketing 
                VALUES 
                ('','$km','$nmarketing','$alamat','$nohp','$bank','$norek')
            ";
    

    
    //cek apakh data berhasil di tambahkan
    if( mysqli_query($conn, $query) ) {
        echo "Data berhasil di simpan";
    } else {
        echo "Error".mysqli_error($conn);
    }
}