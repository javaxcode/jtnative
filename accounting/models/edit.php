<?php
require '../../include/fungsi.php';

if (isset($_POST["uploadnota"])) {
    $id = $_POST["id"];

    // $gambar = $_FILES['gambar']['name'];

    // if ($gambar!="") {
    $gambar = uploadnota();
    if ($gambar == "") {
        return false;
    }
    // }

    $status = 1;
    //query edit data
    $query = "UPDATE listrikspeedy SET
                gambar = '$gambar',
                status = '$status'
        WHERE id = $id
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
                alert('upload Gagal');             
                document.location.href = '../accounting/listrikspeedy';                
            </script>
            ";
    }
} elseif (isset($_POST["editjumlahls"])) {
    $id = $_POST["id"];

    //$tanggal = $_POST["tanggal"];
    $jumlah = $_POST["jumlah"];
    //query edit data
    $query = "UPDATE listrikspeedy SET
                jumlah = '$jumlah'
        WHERE id = $id
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
                alert('upload Gagal');             
                document.location.href = '../accounting/listrikspeedy';                
            </script>
            ";
    }
}
