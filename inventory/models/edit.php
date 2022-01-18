<?php
require '../include/fungsi.php';

if (isset($_POST["editfaktur"])) {
    $id = htmlspecialchars($_POST["id"]);
    $t = htmlspecialchars($_POST["tanggal"]);
    $ta = substr($t, 3, 2);
    $bu = substr($t, 0, 2);
    $tah = substr($t, 6, 4);
    $tang = $tah . '-' . $bu . '-' . $ta;
    $tanggal = date('Y-m-d', strtotime($tang));
    $tjt = htmlspecialchars($_POST["jatuhtempo"]);
    $tajt = substr($tjt, 3, 2);
    $bujt = substr($tjt, 0, 2);
    $tahjt = substr($tjt, 6, 4);
    $tangjt = $tahjt . '-' . $bujt . '-' . $tajt;
    $tanggaljt = date('Y-m-d', strtotime($tangjt));
    $nofaktur = $_POST["nofaktur"];
    $supplier = $_POST["supplier"];

    $queryReport = "SELECT * FROM pembelianunit WHERE nofaktur = '$nofaktur' ";
    $sqlReport = mysqli_query($conn, $queryReport);

    while ($dtReport = mysqli_fetch_array($sqlReport)) {
        $idd = $dtReport["id"];
        $nof = $dtReport["nofaktur"];
        $t = htmlspecialchars($_POST["tanggal"]);
        $ta = substr($t, 3, 2);
        $bu = substr($t, 0, 2);
        $tah = substr($t, 6, 4);
        $tang = $tah . '-' . $bu . '-' . $ta;
        $tanggal = date('Y-m-d', strtotime($tang));
        $tjt = htmlspecialchars($_POST["jatuhtempo"]);
        $tajt = substr($tjt, 3, 2);
        $bujt = substr($tjt, 0, 2);
        $tahjt = substr($tjt, 6, 4);
        $tangjt = $tahjt . '-' . $bujt . '-' . $tajt;
        $tanggaljt = date('Y-m-d', strtotime($tangjt));
        $nofaktur = $_POST["nofaktur"];
        $supplier = $_POST["supplier"];

        //query edit data
        $query = "UPDATE pembelianunit SET
                    tanggal = '$tanggal',
                    jatuhtempo = '$tanggaljt',
                    supplier = '$supplier',
                    nofaktur = '$nofaktur'
            WHERE id = $idd
        ";
        mysqli_query($conn, $query);
    }


    //query edit data
    $query = "UPDATE beliunit SET
                tanggal = '$tanggal',
                jatuhtempo = '$tanggaljt',
                supplier = '$supplier',
                nofaktur = '$nofaktur'
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                
                document.location.href = '../inventory/unit';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Edit Unit Gagal');             
                document.location.href = '../inventory/unit';                
            </script>
            ";
    }
}
