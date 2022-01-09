<?php 
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require '../controllers/office/auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require '../controllers/office/proyek.php';

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
                                      
                                      <!--  <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalproyek">Input Proyek</button> -->
                                    </div>
                                    <div class="dropdown pull-centre">
                                       <button class="btn btn-primary waves-effect waves-light" >Total Proyek : Rp. <?= format_rupiah($totali)  ?></button>
                                       <button class="btn btn-danger waves-effect waves-light" name="outstanding"> Total OutStanding : Rp. Rp. <?= format_rupiah($totalot)  ?></button>
                                       
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
                                                    <option >Bulan</option>
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

                        


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    
                                <h4 class="header-title m-t-0 m-b-30">Data Proyek Tahun <?= $year  ?></h4>
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>No Proyek</th>
                                                <th>Nama Klien</th>
                                                <th>Outlet</th>
                                                <th>Tempat</th>
                                                <th>Pekerjaan</th>
                                                <th>Nilai Proyek</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($proyek as $row ) : ?>
                                                <tr>
                                                    <td width="5%"><?= $i ?></td> 
                                                    <td>
                                                        <?php 
                                                        $t = $row['tanggalpjt'];
                                                        $ta = substr($t,8,2);
                                                        $bu = "/".substr($t,5,2)."/";
                                                        $tah = substr($t,0,4);
                                                        
                                                        echo $ta.$bu.$tah ;
                                                    ?>
                                                    </td>

                                                    
                                                    <td class="text-success" ><a href="detailproyek.php?kp=<?= $row['noproyek']?>"><?= $row['noproyek']?></a></td> 
                                                    
                                                    <td width="10%"; >
                                                        <?= $row['namaklien'] ?>
                                                    </td>
                                                    <td><?= $row['outlet'] ?></td>
                                                    <td><?= $row['tempat'] ?></td>
                                                    <td>
                                                        <?php if ($row['pekerjaan']!=""): ?>
                                                        <?php 
                                                            if ($row['pekerjaan']=='1') {
                                                                echo "FULL" ;
                                                            }elseif ($row['pekerjaan']=='2') {
                                                                echo "KITCHEN";
                                                            }elseif ($row['pekerjaan']=='3') {
                                                                echo "INSTALASI GAS";
                                                            }elseif ($row['pekerjaan']=='4') {
                                                                echo "DUCTING";
                                                            }else{
                                                                echo "AC";
                                                            }
                                                        ?>
                                                        <?php endif ; ?>
                                                    </td>
                                                    <td align="right"><?= number_format($row['nilaiproyek']) ?></td>
                                                    <td>
                                                        <a class="on-default edit-row badge badge-info" data-toggle="modal" data-target="#modaleditfaktur<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> | 
                                                        <a href="../models/hapus.php?code=hapusproyek&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data proyek ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger" ><i class="fa fa-trash-o"></i></a>
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