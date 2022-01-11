<?php
require '../include/fungsi.php';


if (isset($_POST["editproposal"])) {
    $id = htmlspecialchars($_POST["id"]);
    $namaklien = htmlspecialchars($_POST["namaklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $keterangan = "";

    //echo $id." - ".$namaklien." - ".$outlet." - ".$tempat." - ".$pekerjaan." - ".$nilaiproyek ;

    //query edit data
    $query = "UPDATE proposal SET
                namaklien = '$namaklien',
                outlet = '$outlet',
                tempat = '$tempat',
                nilaiproyek = '$nilaiproyek',
                pekerjaan = '$pekerjaan'
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                document.location.href = '../office/proposal';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Edit Proyek Gagal');             
                document.location.href = '../office/proposal';                
            </script>
            ";
    }
}
