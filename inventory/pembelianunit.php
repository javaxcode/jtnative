<?php 
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require '../controllers/admin/auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require '../controllers/inventory/unit.php';

if (isset($_GET["nf"])) {
    $nofaktur = $_GET["nf"];
    $pu = query("SELECT * FROM pembelianunit WHERE nofaktur = '$nofaktur' ")[0];
    $tanggal = $pu['tanggal'] ;
    $tanggaljt = $pu['jatuhtempo'] ;
    $supplier = $pu['supplier'] ;
}else{

    $tangga = $_POST["tanggal"];
    $t = $tangga;
    $ta = substr($t,3,2);
    $bu = substr($t,0,2);
    $tah = substr($t,6,4);
    $tangg = $tah.'-'.$bu.'-'.$ta;
    $tanggal = date('Y-m-d',strtotime($tangg));

    $tanggajt = $_POST["jatuhtempo"];
    $tjt = $tanggajt;
    $tajt = substr($tjt,3,2);
    $bujt = substr($tjt,0,2);
    $tahjt = substr($tjt,6,4);
    $tanggjt = $tahjt.'-'.$bujt.'-'.$tajt;
    $tanggaljt = date('Y-m-d',strtotime($tangg));

    $nofaktur = $_POST["nofaktur"];
    $supplier = $_POST["supplier"];
}
?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-primary waves-effect waves-light btn-xs m-b-5" id="btn-tambah-form">Tambah Baris</button>
                                        <button class="btn btn-info waves-effect waves-light btn-xs m-b-5" id="btn-reset-form">Reset</button>
                                        <!-- <button class="btn btn-purple waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalaccess">Access</button> -->
                                    </div>
                                   
                                    <h4 class="header-title m-t-0 m-b-30">Faktur No : <?= $nofaktur ?> | Tanggal <?= $tanggal  ?></h4>
                                    <form method="post" action="prosesunit">
                                    <?php if (isset($_GET["nf"])) : ?>
                                    <input type="hidden" value="tambahan" id="tambahan" name="tambahan" readonly > 
                                    <?php else : ?>
                                    <input type="hidden" value="bukantambahan" id="tambahan" name="tambahan" readonly >   
                                    <?php endif; ?>
                                    <input type="hidden" class="form-control" value="<?= $tanggal ;  ?>" id="tanggalsaja" name="tanggalsaja" readonly >
                                    <input type="hidden" class="form-control" value="<?= $tanggaljt ;  ?>" id="tanggaljtsaja" name="tanggaljtsaja" readonly >
                                    <input type="hidden" class="form-control" value="<?= $supplier ;  ?>" id="suppliersaja" name="suppliersaja" readonly >
                                    <input type="hidden" class="form-control" value="<?= $nofaktur ;  ?>" id="nofaktursaja" name="nofaktursaja" readonly >
                                    
                                    <input type="hidden" class="form-control" value="<?= $tanggal ;  ?>" id="tanggal" name="tanggal[]" readonly >
                                    <input type="hidden" class="form-control" value="<?= $tanggaljt ;  ?>" id="tanggaljt" name="tanggaljt[]" readonly >
                                    <input type="hidden" class="form-control" value="<?= $supplier ;  ?>" id="supplier" name="supplier[]" readonly >
                                    <input type="hidden" class="form-control" value="<?= $nofaktur ;  ?>" id="nofaktur" name="nofaktur[]" readonly >
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Merk</label>
                                            <select class="form-control select2" name="merk[]">
                                                <option >Pilih Merk</option>
                                                <?php foreach ($kodemerkk as $row ) : ?>
                                                    <option value="<?= $row['kodemerk'] ?>"><?= strtoupper($row["merk"]) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="field-1" class="control-label">Nama Unit</label>
                                            <select class="form-control select2" name="namaunit[]">
                                                <option >Pilih Nama Unit</option>
                                                <?php foreach ($kodeunitt as $row ) : ?>
                                                    <option value="<?= $row['kodeunit'] ?>"><?= ucwords($row["namaunit"]) ?> - (L)<?= $row['panjang'] ?> x (W)<?= $row['lebar'] ?> x (H)<?= $row['tinggi'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Harga</label>
                                            <input type="text" class="form-control" id="field-5" placeholder="Harga Unit" name="harga[]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="field-1" class="control-label">Qty</label>
                                            <input type="text" class="form-control" id="qty" name="qty[]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="field-2" class="control-label">Discount</label>
                                            <select class="form-control select" name="diskon[]">
                                                <option value="0">0%</option>
                                                <option value="10">10%</option>
                                                <option value="20">20%</option>
                                                <option value="30">30%</option>
                                                <option value="35">35%</option>
                                                <option value="40">40%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="field-2" class="control-label">PPN</label>
                                            <select class="form-control select" name="ppn[]">
                                                
                                                <option value="10">10%</option>
                                                <option value="0">0%</option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                
                                <br><br>

                                <div id="insert-form"></div>
                                <br>
                                <input type="submit" value="Simpan">
                            </form>

                            <input type="hidden" id="jumlah-form" value="1">
                                </div>


                            </div>
                        </div>

                        <script>
                $(document).ready(function(){ // Ketika halaman sudah diload dan siap
                    $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
                        var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
                        var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
                        
                        // Kita akan menambahkan form dengan menggunakan append
                        // pada sebuah tag div yg kita beri id insert-form
                        $("#insert-form").append(`
                            <input type="hidden" class="form-control" value="<?= $tanggal ;  ?>" id="tanggal" name="tanggal[]" readonly >
                            <input type="hidden" class="form-control" value="<?= $tanggaljt ;  ?>" id="tanggaljt" name="tanggaljt[]" readonly >
                            <input type="hidden" class="form-control" value="<?= $supplier ;  ?>" id="supplier" name="supplier[]" readonly >
                            <input type="hidden" class="form-control" value="<?= $nofaktur ;  ?>" id="nofaktur" name="nofaktur[]" readonly >
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control select2" name="merk[]">
                                        <option >Pilih Merk</option>
                                        <?php 
                                            $kodemerkk = query("SELECT * FROM merk ORDER BY id DESC ");
                                            foreach ($kodemerkk as $row ){
                                                echo "<option value=".$row['kodemerk'].">".strtoupper($row['merk'])."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select class="form-control select2" name="namaunit[]">
                                        <option >Pilih Nama Unit</option>
                                        <?php 
                                            $kodeunitt = query("SELECT * FROM unit ORDER BY namaunit ASC ");
                                            foreach ($kodeunitt as $row ){
                                                echo "<option value=".$row['kodeunit'].">".ucwords($row['namaunit'])."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Rp." id="harga" name="harga[]" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    
                                    <input type="text" class="form-control" id="qty" name="qty[]" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    
                                    <select class="form-control select" name="diskon[]">
                                        <option value="0">0%</option>
                                        <option value="10">10%</option>
                                        <option value="20">20%</option>
                                        <option value="30">30%</option>
                                        <option value="35">35%</option>
                                        <option value="40">40%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    
                                    <select class="form-control select" name="ppn[]">
                                        
                                        <option value="10">10%</option>
                                        <option value="0">0%</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <hr>
                        `);
                        
                        $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
                    });
                    
                    // Buat fungsi untuk mereset form ke semula
                    $("#btn-reset-form").click(function(){
                        $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
                        $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
                    });
                });
                </script>

                    </div> <!-- container -->

                </div> <!-- content -->

              
                

<?php 
require '../include/footer.php';
?>                