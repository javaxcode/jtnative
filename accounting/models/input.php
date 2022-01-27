<?php
require '../../include/fungsi.php';

if (isset($_POST["listrikspeedy"])) {
    $tl = htmlspecialchars($_POST["tanggal"]);
    $ttl = $tl;
    $tatl = substr($ttl, 3, 2);
    $bul = substr($ttl, 0, 2);
    $tahtl = substr($ttl, 6, 4);
    $tang = $tahtl . '-' . $bul . '-' . $tatl;
    $tanggal = date('Y-m-d', strtotime($tang));
    $kategori = htmlspecialchars($_POST["kategori"]);
    $nomer = htmlspecialchars($_POST["nomer"]);
    $keterangan = "";
    $jumlah = htmlspecialchars($_POST["jumlah"]);
    $gambar = "";
    $status = 0;
    //query tambah member
    $query = "INSERT INTO listrikspeedy 
                VALUES 
                ('','$tanggal','$kategori','$nomer','$keterangan','$jumlah','$gambar','$status')
            ";
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>                
                document.location.href = '../accounting/listrikspeedy';           
            </script>
            ";
    } else {
        echo "
            <script>   
                alert('input gagal');             
                document.location.href = '../accounting/listrikspeedy';                
            </script>
            ";
    }
}
