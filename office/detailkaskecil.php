<?php 
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require '../controllers/office/auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require '../controllers/office/detailkaskecil.php';

?>
            
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card-box">
                                    

                                    <h4 class="header-title m-t-0">Rincian Bon No Voucher : <?php echo $kaskecil['kodekas'].$kaskecil['kodebulan'].$kaskecil['kodetr'] ; ?></h4>
                                    <h4 class="header-title m-t-0">Total Bon : Rp. <?php echo $kaskecil['output'] ; ?></h4>

                                    <form class="form-horizontal group-border-dashed" method="post" action="">
                                        <div class="form-group">
                                            <!-- <label class="col-sm-4 control-label">Jam</label> -->
                                            <div class="col-sm-6">
                                                <input type="hidden"  class="form-control" required name="jam" id="jam"
                                                       value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime();
                                                                echo $date->format('H:i:s'); ?>">
                                                </input>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" readonly="" name="tanggal" id="tanggal" value="<?= $kaskecil['tanggal'] ?>"></input>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Toko</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" required name="toko" id="toko" placeholder="Nama Toko"></input>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Keterangan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" required name="keterangan" id="keterangan" placeholder="Rincian Pembelian"></input>
                                            </div>
                                        </div>
                                                                                
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Jumlah (Rp)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="jumlah" id="jumlah"
                                                       required placeholder="0" />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6 m-t-15">
                                                <button type="submit" class="btn btn-success waves-effect waves-light" name="pembelian">
                                                    Input 
                                                </button>
                                                <!-- <button type="reset" class="btn btn-default waves-effect m-l-5">
                                                    Cancel
                                                </button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- end col -->

                            <div class="col-lg-8">
                                <div class="card-box table-responsive">
                                    <div class="dropdown pull-right">
                                        <h4 class="header-title m-t-0 m-b-30">Jumlah Rp. <?php echo number_format($totalrb); ?></h4>
                                    </div>

                                    <h4 class="header-title m-t-0 m-b-30">Transaksi Rincian Bon <?php echo $kaskecil['kodekas'].$kaskecil['kodebulan'].$kaskecil['kodetr'] ; ?></h4>

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                
                                                <th>Toko</th>
                                                <th>Keterangan</th>
                                                <th>Jumlah</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($dbon as $row ) : ?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                        $t = $row['tanggal'];
                                                        $ta = substr($t,8,2);
                                                        $bu = "/".substr($t,5,2)."/";
                                                        $tah = substr($t,0,4);
                                                        
                                                        echo $ta.$bu.$tah ;
                                                    ?>
                                                    
                                                </td>
                                                
                                                
                                                <td><?= $row["toko"] ?></td>
                                                <td><?= $row["keterangan"] ?></td>
                                                <td>Rp. <?= "<b>" . number_format($row["jumlah"]) . "</b>" ?></td>
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

                

<?php 
require '../include/footer.php';
?>   