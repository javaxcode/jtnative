<?php
require '../include/fungsi.php';

if (isset($_POST["daftaruser"])) {
    $nama = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    //$username = strtolower(stripcslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $userlevel = htmlspecialchars($_POST["role"]);
    $foto = "default.jpg";
    $aktif = 1;
    $date_created = time();

    //cek  email sudah ada atau belum
    $cekemail = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
    if (mysqli_fetch_assoc($cekemail)) {
        echo "<script>
                alert('email sudah terdaftar');
                document.location.href = '../user';
            </script>";
        return false;
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query tambah member
    $query = "INSERT INTO user 
                VALUES 
                ('','$nama','$email','$foto','$password','$userlevel','$aktif','$date_created')
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
                alert('input user gagal');             
                document.location.href = '../user';                
            </script>
            ";
    }
} elseif (isset($_POST["inputmenu"])) {
    $menu = htmlspecialchars($_POST["menu"]);
    //query tambah member
    $query = "INSERT INTO user_menu 
                VALUES 
                ('','$menu')
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
                alert('input user gagal');             
                document.location.href = '../menu';                
            </script>
            ";
    }
} elseif (isset($_POST["inputaccessmenu"])) {
    $menu = htmlspecialchars($_POST["menu"]);
    $role = htmlspecialchars($_POST["role"]);
    $cekinput = mysqli_query($conn, "SELECT * FROM user_access_menu WHERE role_id ='$role' AND menu_id ='$menu' ");
    //cek password
    if (mysqli_num_rows($cekinput) === 1) {
        echo "
            <script>
                alert('Access Menu Sudah Ada');                
                document.location.href = '../menu';           
            </script>
            ";
        return FALSE;
    }

    //query tambah member
    $query = "INSERT INTO user_access_menu 
                VALUES 
                ('','$role','$menu')
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
                alert('input user gagal');             
                document.location.href = '../menu';                
            </script>
            ";
    }
} elseif (isset($_POST["inputsubmenu"])) {
    $menu = htmlspecialchars($_POST["menu"]);
    $submenu = htmlspecialchars($_POST["submenu"]);
    $icon = "zmdi zmdi-" . htmlspecialchars($_POST["icon"]);
    $aktif = htmlspecialchars($_POST["active"]);
    $modelmenu = htmlspecialchars($_POST["modelmenu"]);
    //query tambah member
    $query = "INSERT INTO user_sub_menu
                VALUES 
                ('','$menu','$submenu','$icon','$aktif','$modelmenu')
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
                alert('input gagal');             
                document.location.href = '../menu';                
            </script>
            ";
    }
} elseif (isset($_POST["inputsubmenu2"])) {
    $menu = htmlspecialchars($_POST["menu"]);
    $submenu = htmlspecialchars($_POST["submenu"]);
    $halaman = htmlspecialchars($_POST["submenu2"]);
    $url = htmlspecialchars($_POST["url"]);
    $aktif = htmlspecialchars($_POST["active"]);

    //query tambah member
    $query = "INSERT INTO user_sub_menu2
                VALUES 
                ('','$menu','$submenu','$halaman','$url','$aktif')
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
                alert('input gagal');             
                document.location.href = '../submenu';                
            </script>
            ";
    }
} elseif (isset($_POST["inputmarketing"])) {
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
                document.location.href = '../office/proposal';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Input marketing gagal');                
                document.location.href = '../office/proposal';                
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

    $kodeproyek = "PRO";
    $t = substr($ttl, 8, 2);
    $kodebulan = $t . $bul;

    $kas = query("SELECT * FROM proposal WHERE month(tanggalpro) ='$bul' ORDER BY id DESC LIMIT 1")[0];
    if ($kas['kodebulan'] != $kodebulan) {
        $newkodetr = "001";
    } else {
        $lastkode = query("SELECT * FROM proposal WHERE kodepro ='PRO' AND month(tanggalpro) ='$bul' ORDER BY id DESC LIMIT 1")[0];
        $lk = $lastkode['kodetr'];
        $noUrut = (int) $lastkode['kodetr'];
        $noUrut++;
        $newkodetr = sprintf("%03s", $noUrut);
    }

    $namaklien = htmlspecialchars($_POST["namaklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $keterangan = "";
    $status = 0;


    //query insert data
    $query = "INSERT INTO proposal 
                VALUES 
                ('','$tanggal','$kodeproyek','$kodebulan','$newkodetr','$namaklien','$outlet','$tempat','$pekerjaan','$nilaiproyek','$keterangan','$status')
            ";
    mysqli_query($conn, $query);


    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Input Proyek berhasil');
                document.location.href = '../office/proposal';                
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
} elseif (isset($_POST["listrikspeedy"])) {
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
                document.location.href = '../office/kaskecil';                    
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
                ('','$tanggal','$kodekas','$kodebulan','$newkodetr','$payto','$keterangan','$input','$output','$saldo','$kodeakun')
            ";
    mysqli_query($conn, $query);


    //cek apakh data berhasil di tambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Input Pemasukan Kas berhasil');
                document.location.href = '../office/kaskecil';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Input Pemasukan Kas Gagal');                
                document.location.href = '../office/kaskecil';                
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
    $kodebulan = $thl . $butl;

    if ($butli != $butl) {
        echo "
            <script>
                alert('Input Tanggal tidak sesuai dengan bulan ini');
                document.location.href = '../office/kaskecil';                    
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
                document.location.href = '../office/kaskecil';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Input Pengeluaran Kas Gagal');                
                document.location.href = '../office/kaskecil';                
            </script>
            ";
    }
}
