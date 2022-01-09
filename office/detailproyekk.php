<?php 
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require '../controllers/office/auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require '../controllers/office/detailproyekk.php';

?>
            
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">

                                    <div class="row">
                                    
                                        <div class="col-md-6">
                                            <h4 class="m-t-0 header-title"><b>Kode Proyek : <?= $detpro['noproyek'];  ?></b></h4>
                                            <h4 class="m-t-0 header-title"><b>Nama Klien : <?php echo ucwords($detpro['namaklien']) ; ?></b></h4>
                                            <h4 class="m-t-0 header-title"><b><a href="" data-toggle="modal" data-target="#bon-close-modal"> Nilai Proyek : Rp. <?php echo number_format($detpro['nilaiproyek']) ; ?></a></b></h4>
                                            <h4 class="m-t-0 header-title"><b>Outlet : <?php echo ucwords($detpro['outlet']) ; ?></b></h4>
                                             <h4 class="m-t-0 header-title"><b>Alamat : <?php echo ucwords($detpro['tempat']) ; ?></b></h4>
                                            <button type="submit" data-toggle="modal" data-target="#output-close-modal" class="btn btn-info waves-effect waves-light">Pembayaran</button>
                                            <button type="submit" data-toggle="modal" data-target="#con-close-modal" class="btn btn-danger waves-effect waves-light">Pengeluaran</button>
                                            <button type="submit" data-toggle="modal" data-target="#add-close-modal" class="btn btn-success waves-effect waves-light">Add Unit</button>
                                            <br><br>

                                            <form method="post" action="">
                                            <textarea type="text" class="form-control" id="ketproyek" name="ketproyek" ><?= $detpro['keterangan'] ?></textarea>
                                            <button type="submit" class="btn btn-purple waves-effect waves-light" name="updateproyek">Update Keterangan</button>
                                            </form>
                                            
                                        </div><!-- end col -->
                                    
                                        <div class="col-md-6">
                                            <!-- <h4 class="m-t-0 header-title"><b>Rekapan</b></h4> -->
                                            

                                            <form class="form-horizontal" role="form">
                                                <?php 
                                                    $persen = number_format((($totali/$detpro['nilaiproyek'])*100)) ;
                                                    $persenos = number_format(((($detpro['nilaiproyek']-$totali)/$detpro['nilaiproyek'])*100)) ;
                                                ?>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-5 control-label">Jumlah Pembayaran</label>
                                                    <div class="col-sm-7">
                                                      <input type="text" class="form-control" id="inputEmail3" readonly="" value="Rp. <?= number_format($totali) ;  ?> - <?= $persen  ?> %" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-5 control-label">OutStanding</label>
                                                    <div class="col-sm-7">
                                                      <input type="text" class="form-control" id="inputPassword3" readonly="" value="Rp. <?= number_format($detpro['nilaiproyek']-$totali) ;  ?> - <?= $persenos  ?> %">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword4" class="col-sm-5 control-label">Jumlah Pengeluaran</label>
                                                    <div class="col-sm-7">
                                                      <input type="text" class="form-control" id="inputPassword4" readonly="" value="Rp. <?= number_format($totalp) ;  ?>">
                                                    </div>
                                                </div>
                                                <!--<div class="form-group">-->
                                                <!--    <label for="inputPassword4" class="col-sm-5 control-label" >-->
                                                        <?php 
                                                            //if (($totali-$totalp)>0) {
                                                                //echo "Laba";
                                                            //}else{echo "Rugi";}
                                                         ?>
                                                        
                                          <!--          </label>-->
                                          <!--          <div class="col-sm-7">-->
                                          <!--            <input type="text" class="form-control" id="inputPassword4" readonly="" value="Rp. <?= number_format($totali-$totalp) ;  ?>">-->
                                          <!--          </div>-->
                                                <!--</div>-->
                                                
                                                <!-- <div class="form-group m-b-0">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                      <button type="submit" class="btn btn-info waves-effect waves-light">Sign in</button>
                                                    </div>
                                                </div> -->
                                            </form>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                    
                                </div>
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->

                        


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    
                                <h4 class="header-title m-t-0 m-b-30">Data Proyek Tahun <?= $year  ?></h4>
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>No Voucher</th>
                                                <th>Kode Akun</th>
                                                <th>Keterangan</th>
                                                <th>Rekening</th>
                                                <th>Input</th>
                                                <th>Output</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($dp as $row ) : ?>
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

                                                
                                                <?php if ($row["kodekas"] != "KBMP"): ?> 
                                                <td class="text-danger"><?= $row["kodekas"].$row["kodebulan"].$row["kodetr"] ?></td>    
                                                <?php else : ?>
                                                <td class="text-primary"><?= $row["kodekas"].$row["kodebulan"].$row["kodetr"] ?></td>
                                                <?php endif ; ?>
                                                <td>
                                                    
                                                </td>

                                                <td><?= $row["keterangan"] ?></td>
                                                <td><?= $row["payto"] ?></td>
                                                <td>Rp. <?= number_format($row["input"]) ?></td>
                                                <td>Rp. <?= number_format($row["output"]) ?></td>
                                                    <td>
                                                        <a class="on-default edit-row badge badge-info" data-toggle="modal" data-target="#modaleditfaktur<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> | 
                                                        <a href="../models/hapus.php?code=hapuspembayaran&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data proyek ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger" ><i class="fa fa-trash-o"></i></a>
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
                            <h2 class="modal-title">Proyek</h2>
                        </div>
                        <form >
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
                                        <label for="field-5" class="control-label">Nama Klien</label>
                                        <input type="text" class="form-control" id="field-5" placeholder="Nama Klien" name="namaklien">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Outlet</label>
                                        <input type="text" class="form-control" id="field-3" placeholder="Outlet" name="outlet">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Alamat Tempat</label>
                                        <input type="text" class="form-control" id="field-3" placeholder="Tempat" name="tempat">
                                    </div>
                                </div>
                               
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Nilai Proyek</label>
                                        <input type="text" class="form-control" id="nilaiproyek" name="nilaiproyek" placeholder="Rp.">
                                    </div>
                                </div>
                                
                            </div>        
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default waves-effect" id="btnsimpan">Input Data</button>
                            <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->

<?php 
require '../include/footer.php';
?>   