<?php 
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require '../controllers/accounting/auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require '../controllers/accounting/listrikspeedy.php';

if (isset($_POST["uploadnota"])) {
    $id = $_POST["id"];

    $gambar = $_FILES['gambar']['name'];

    var_dump($gambar);

    // if ($gambar!="") {
        // $gambar = uploadnota();
        // if ($gambar=="") {
        //     return false;
        // }
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
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "
            <script>
                alert('upload berhasil');
                document.location.href = 'listrikspeedy';                
            </script>
            ";
    } else {
        echo "
            <script>
                alert('upload Gagal');             
                document.location.href = 'listrikspeedy';                
            </script>
            ";
    }
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
                            <div class="col-lg-7">
                                <div class="card-box">

                                    <div class="dropdown pull-right">
                                      
                                       <!-- <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalproyek">Input Listrik / Speedy</button> -->
                                    </div>
                                    <div class="dropdown pull-centre">
                                       <button class="btn btn-primary waves-effect waves-light" >Total : Rp. <?= number_format($totali)  ?></button>
                                       <button class="btn btn-danger waves-effect waves-light" name="outstanding">Total OutStanding : Rp.</button>
                                       
                                    </div>

                             
                                    
                                </div>
                            </div><!-- end col -->

                            <div class="col-lg-5">
                                <div class="card-box">


                                    <!-- <h4 class="header-title m-t-0 m-b-30">Menu</h4> -->
                                    <form method="post" action="">
                                        
                                        <div class="dropdown pull-centre">
                                            <div class="col-md-4">
                                                <select class="form-control select2" name="bulan">
                                                    <option value="<?= $month  ?>"><?= $monthname  ?></option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Febuari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="dropdown pull-centre">
                                            <div class="col-md-4">
                                                <select class="form-control select2" name="tahun">
                                                    <option value="<?= $year ; ?>"><?= $year ; ?></option>
                                                    <option value="2019">2019</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2017">2017</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5" name="tp">Tampilkan Data</button></a>
                                    </form>
                                    
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                       
                        <?php if (isset($_POST["upload"])): ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <form action="../models/edit" role="form" method="POST" enctype="multipart/form-data">
                                    <h4 class="header-title m-t-0 m-b-30">
                                        <?php 
                                            if ($_POST["kategori"]=='1') {
                                                echo "LISTRIK" ;
                                            }elseif ($_POST['kategori']=='2') {
                                                echo "SPEEDY";
                                            }
                                        ?> : 
                                        <?php 
                                            if ($_POST['nomer']=='538732559589') {
                                                echo "Gudang Depan" ;
                                            }elseif ($_POST['nomer']=='538730198248') {
                                                echo "Rumah Baru (Hadijah)";
                                            }elseif ($_POST['nomer']=='538730908854') {
                                                echo "Gudang Belakang";
                                            }elseif ($_POST['nomer']=='538733225870') {
                                                echo "Rumah Tengah";
                                            }elseif ($_POST['nomer']=='538730170473') {
                                                echo "Rumah Ruko";
                                            }elseif ($_POST['nomer']=='538730988849') {
                                                echo "Perumahan";
                                            }elseif ($_POST['nomer']=='14022070826') {
                                                echo "Kantor Ruko";
                                            }elseif ($_POST['nomer']=='2174707727') {
                                                echo "Gudang";
                                            }elseif ($_POST['nomer']=='2174774005') {
                                                echo "Kantor Ruko";
                                            }elseif ($_POST['nomer']=='10687258') {
                                                echo "Perumahan";
                                            }elseif ($_POST['nomer']=='11614917') {
                                                echo "Perumahan";
                                            }
                                        ?> - Nomer : <?= $_POST['nomer']; ?> Rp : <?= number_format($_POST['jumlah']); ?>
                                    </h4>
                                    <input type="hidden" name="id" value="<?= $_POST['id'] ;  ?>" />
                                    <input type="file" name="gambar" class="dropify" data-height="300" />
                                    <br>
                                    <div class="form-group">
                                            <!-- <div class="col-sm-offset-4 col-sm-12"> -->
                                            <button type="submit" name="uploadnota" value="import" class="btn btn-primary waves-effect waves-light">
                                                Upload Nota
                                            </button>
                                            
                                        <!-- </div> -->
                                    </div>
                                    </form>
                                </div>
                            </div><!-- end col -->
                        </div>
                    <?php endif ; ?>

                        


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                <?php if (isset($_POST["tp"])): ?>
                                <h4 class="header-title m-t-0 m-b-30">Data Listrik Speddy <?= $tampilkanbulan.'-'.$tahun ;  ?></h4>
                                <?php else : ?>
                                <h4 class="header-title m-t-0 m-b-30">Data Listrik Speddy <?= date ('d').' '.$monthname.' '.$year ;  ?></h4>
                                <?php endif ; ?>
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Nomer</th>
                                                <th>Keterangan</th>
                                                <th>Jumlah</th>
                                                <th>Nota</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($ls as $row ) : ?>
                                                <tr>
                                                    <td width="5%"><?= $i ?></td> 
                                                    <td>
                                                        <?php 
                                                        $t = $row['tanggal'];
                                                        $ta = substr($t,8,2);
                                                        $bu = "/".substr($t,5,2)."/";
                                                        $tah = substr($t,0,4);
                                                        
                                                        echo $ta.$bu.$tah ;
                                                    ?>
                                                    </td>
                                                    
                                                    <td align="center">
                                                        <?php 
                                                            if ($row['kategori']=='1') {
                                                                echo "LISTRIK" ;
                                                            }elseif ($row['kategori']=='2') {
                                                                echo "SPEEDY";
                                                            }
                                                        ?>
                                                    </td> 
                                                    <td width="10%"; ><?= $row['nomer'] ?></td>
                                                    <td align="center">
                                                        <?php 
                                                            if ($row['nomer']=='538732559589') {
                                                                echo "Gudang Depan / M. YANTO" ;
                                                            }elseif ($row['nomer']=='538730198248') {
                                                echo "Rumah Baru (Hadijah)";
                                                            }elseif ($row['nomer']=='538730908854') {
                                                                echo "Gudang Belakang / SUBHAN SAHRUDIN";
                                                            }elseif ($row['nomer']=='538733225870') {
                                                                echo "Rumah Tengah";
                                                            }elseif ($row['nomer']=='538730170473') {
                                                                echo "Rumah Ruko / H. AMSAR";
                                                            }elseif ($row['nomer']=='538730988849') {
                                                                echo "Perumahan / MAIL";
                                                            }elseif ($row['nomer']=='14022070826') {
                                                                echo "Kantor Ruko";
                                                            }elseif ($row['nomer']=='2174707727') {
                                                                echo "Gudang / M. Yanto";
                                                            }elseif ($row['nomer']=='2174774005') {
                                                                echo "Kantor Ruko / M. Yanto";
                                                            }elseif ($row['nomer']=='10687258') {
                                                                echo "Perumahan / M. Yanto";
                                                            }elseif ($row['nomer']=='11614917') {
                                                                echo "Perumahan / M. Yanto";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php if ($row["jumlah"]!=0 ): ?>
                                                            <?= number_format($row['jumlah']) ?>
                                                        <?php else : ?>
                                                            <button type="button" class="btn btn-danger waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modaljumlahnota<?= $row['id']  ?>">Input Tagihan</button>
                                                        <?php endif ; ?>
                                                        
                                                        
        
                                                    </td>
            <div id="modaljumlahnota<?= $row['id']  ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 class="modal-title">Input Tagihan <?= $row['nomer']  ?></h2>
                        </div>
                        <form method="post" action="../models/edit">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $row['id']  ?>">
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Tanggal</label>
                                        <input type="text" class="form-control" id="datepicker-autoclose2" placeholder="Date" name="tanggal">
                                    </div>
                                </div> -->
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Jumlah</label>
                                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Rp.">
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default waves-effect" id="editjumlahls" name="editjumlahls">Input Data</button>
                            <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->
                                                    <td align="center">

                                                        <?php if ($row["status"]==1 ): ?>
                                                        <a href="../images/nota/<?= $row["gambar"]; ?>" class="image-popup" title="<?= $row["kategori"] ?>">
                                                            <img src="../images/nota/<?= $row["gambar"]; ?>"   width="25px" height="25px" >
                                                        <?php else : ?>

                                                        
                                                        <form method="post" >
                                                        <input type="hidden" name="jumlah" value="<?= $row["jumlah"]; ?>" />
                                                        <input type="hidden" name="kategori" value="<?= $row["kategori"]; ?>" />
                                                        <input type="hidden" name="nomer" value="<?= $row["nomer"]; ?>" />
                                                        <input type="hidden" name="id" value="<?= $row["id"]; ?>" />
                                                        <button type="submit" class="btn btn-danger waves-effect waves-light btn-xs m-b-5" name="upload"> Belum Bayar</button>
                                                        </form>
                                                        
                                                        <?php endif ; ?>
                                                    </td>
                                                </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->

                </div> <!-- content -->

                <div id="modalproyek" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 class="modal-title">Listrik Speedy</h2>
                        </div>
                        <form method="post" action="../models/input">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Tanggal</label>
                                        <input type="text" class="form-control" id="datepicker-autoclose" placeholder="Date" name="tanggal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Kategori</label>
                                        <select class="form-control select2" name="kategori">
                                            <option value="1">Listrik</option>
                                            <option value="2">Speedy</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Nomer</label>
                                        <select class="form-control select2" name="nomer">
                                                <option>538732559589</option>
                                                <option>538730908854</option>
                                                <option>538733225870</option>
                                                <option>538730170473</option>
                                                <option>538730988849</option>
                                                <option>14022070826</option>
                                                <option>2174707727</option>
                                                <option>2174774005</option>
                                                <option>10687258</option>
                                            </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Rp.">
                                    </div>
                                </div> -->
                               
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Jumlah</label>
                                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Rp.">
                                    </div>
                                </div>
                                
                            </div>        
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default waves-effect" id="listrikspeedy" name="listrikspeedy">Input Data</button>
                            <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->

<?php 
require '../include/footer.php';
?>   