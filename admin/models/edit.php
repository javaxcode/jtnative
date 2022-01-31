<?php
require '../include/fungsi.php';

if (isset($_POST["edituser"])) {
    $id = htmlspecialchars($_POST["id"]);
    $nama = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $aktif = htmlspecialchars($_POST["active"]);
    $userlevel = htmlspecialchars($_POST["role"]);

    //query edit data
    $query = "UPDATE user SET
                name = '$nama',
                email = '$email',
                role_id = '$userlevel',
                is_active = '$aktif'
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                document.location.href = '../user';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Edit Proyek Gagal');             
                document.location.href = '../user';                
            </script>
            ";
    }
} elseif (isset($_POST["editmenu"])) {
    $id = htmlspecialchars($_POST["id"]);
    $menu_id = htmlspecialchars($_POST["menu"]);
    $title = htmlspecialchars($_POST["submenu"]);
    $icon = htmlspecialchars($_POST["icon"]);
    $is_active = htmlspecialchars($_POST["active"]);
    $model_menu = htmlspecialchars($_POST["modelmenu"]);

    //query edit data
    $query = "UPDATE user_sub_menu SET
                menu_id = '$menu_id',
                title = '$title',
                icon = '$icon',
                is_active = '$is_active',
                model_menu = '$model_menu'
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                document.location.href = '../menu';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Edit Proyek Gagal');             
                document.location.href = '../menu';                
            </script>
            ";
    }
} elseif (isset($_POST["editsubmenu2"])) {
    $id = htmlspecialchars($_POST["id"]);
    $menu_id = htmlspecialchars($_POST["menu"]);
    $submenu_id = htmlspecialchars($_POST["submenu"]);
    $halaman = htmlspecialchars($_POST["submenu2"]);
    $url = htmlspecialchars($_POST["url"]);
    $aktif = htmlspecialchars($_POST["active"]);

    //query edit data
    $query = "UPDATE user_sub_menu2 SET
                menu_id = '$menu_id',
                submenu_id = '$submenu_id',
                halaman = '$halaman',
                url = '$url',
                is_active = '$aktif'
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                document.location.href = '../submenu';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Edit Proyek Gagal');             
                document.location.href = '../submenu';                
            </script>
            ";
    }
} elseif (isset($_POST["editfaktur"])) {
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
} elseif (isset($_POST["editproposal"])) {
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
} elseif (isset($_POST["uploadnota"])) {
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
