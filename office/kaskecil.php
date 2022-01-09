<?php 
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require '../controllers/office/auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require '../controllers/office/kaskecil.php';

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
                                      
                                       <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#modalproyek">Saldo : Rp. 
                                        <?php 
                                            if( isset($_POST["tampilkan"]) ) {
                                                echo "<b>" . number_format($jumlahsaldo) . " </b>";
                                            }else{
                                               echo "<b>" . number_format($saldokas) . " </b>"; 
                                            }
                                         ?></button>
                                    </div>
                                    <div class="dropdown pull-centre">
                                       <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalinputkas">Pemasukan : Rp </button>
                                       <button class="btn btn-danger waves-effect waves-light" name="outstanding" data-toggle="modal" data-target="#modaloutputkas">Pengeluaran : Rp.</button>
                                       
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
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-primary waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalmarketing">Input Marketing</button>
                                         <button class="btn btn-info waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalproposal">Input Proposal</button>
                                    </div>   
                                <h4 class="header-title m-t-0 m-b-30">Kas Kecil</h4>
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal / No Voucher</th>
                                                <!-- <th>No Voucher</th> -->
                                                <th>Kode Akun</th>
                                                <th>Pay To</th>
                                                <th>Keterangan</th>
                                                <th>Input</th>
                                                <th>Output</th>
                                                <th>Saldo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($kaskecil as $row ) : ?>
                                                <tr>
                                                    <td width="2%";><?= $i ?></td> 
                                                    <td width="5%">
                                                        <?php 
                                                            $t = $row['tanggal'];
                                                            $ta = substr($t,8,2);
                                                            $bu = "/".substr($t,5,2)."/";
                                                            $tah = substr($t,0,4);
                                                            
                                                            echo $ta.$bu.$tah ;
                                                        ?>
                                                        <br>
                                                         <?php if ($row["kodekas"] === "KK"): ?>
                                                            <small class="text-danger">
                                                            <?= $row["kodekas"].$row["kodebulan"].$row["kodetr"] ?>
                                                            </small>
                                                        <?php else : ?>
                                                            <small class="text-success">
                                                            <?= $row["kodekas"].$row["kodebulan"].$row["kodetr"] ?>
                                                            </small>
                                                        <?php endif ; ?> 
                                                    </td>
                                                   
                                                    <td width="10%">
                                                        <?php
                                                            $kodeakun = $row["kodeakun"];
                                                            $ka = "SELECT * FROM kodeakun WHERE kodeakun3 ='$kodeakun'"; //perintah untuk menjumlahkan
                                                            $hasilka = mysqli_query($conn, $ka) ;//melakukan query dengan varibel $jumlahkan
                                                            $tampil = mysqli_fetch_array($hasilka); //menyimpan hasil query ke variabel $t
                                                            $tampilkode = $tampil['ketkode3'];
                                                            
                                                        ?>
                                                        <?= ucwords($tampilkode);  ?>
                                                    </td>
                                                    <td width="10%"; ><?= $row["payto"] ?></td>
                                                    <td><?= $row["keterangan"] ?></td>
                                                    <td width="10%" align="right"><?= number_format($row["input"]) ?></td>
                                                    <td width="10%" align="right"><a href="detailkaskecil.php?id=<?= $row["id"] ?>" target="_blank"><?= number_format($row["output"]) ?></a></td>
                                                    <td width="10%" align="right"><?= number_format($row["saldo"]) ?></td>
                                                    <td>
                                                        
                                                        <a class="on-default edit-row badge badge-info" data-toggle="modal" data-target="#modaleditfaktur<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> | 
                                                        <a href="../models/hapus.php?code=hapusproposal&id=" onClick="if(confirm('Apakah anda yakin menghapus data unit ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger" ><i class="fa fa-trash-o"></i></a>
                                                    </td>
            <div id="modaleditfaktur<?= $row['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">Edit Proposal</h2>
                    </div>
                    <form method="post" action="../models/edit">
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="field-3" value="<?= $row['id']  ?>" name="id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Nama Marketing</label>
                                        <select class="form-control select2" name="namaklien">
                                            <option value=""></option>
                                            
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Outlet</label>
                                        <input type="text" class="form-control" id="field-3" value="" name="outlet">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Alamat Tempat</label>
                                        <input type="text" class="form-control" id="field-3" value="" name="tempat">
                                    </div>
                                </div>
                               
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Pekerjaan</label>
                                        <select class="form-control select2" name="pekerjaan">
                                                <option>
                                                        
                                                </option>
                                                <option value="1">FULL</option>
                                                <option value="2">KITCHEN</option>
                                                <option value="3">INSTALASI GAS</option>
                                                <option value="4">DUCTING</option>
                                                <option value="5">AC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Nilai Proyek</label>
                                        <input type="text" class="form-control" id="nilaiproyek" name="nilaiproyek" value="">
                                    </div>
                                </div>
                            </div>        
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default waves-effect" id="editproposal" name="editproposal">Edit Proposal</button>
                            <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal -->
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

                <div id="modaloutputkas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 class="modal-title">Pengeluaran Kas</h2>
                        </div>
                        <form method="post" action="../models/input">
                        <div class="modal-body">
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Pay to / Recieved</label>
                                        <input type="text" class="form-control" id="field-5" placeholder="Pay to / Recieved" name="payto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Tanggal</label>
                                        <input type="text" class="form-control" id="datepicker" placeholder="Date" name="tanggal">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Keterangan</label>
                                        <input type="text" class="form-control" id="field-3" placeholder="Keterangan Transaksi" name="keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Kode Transaksi</label>
                                    <select class="form-control select2" name="kodeakun">
                                        <option value="000" >Kode Akun</option>
                                        <?php foreach ($kodeakune as $row ) : ?>
                                            <option value="<?= $row['kodeakun3'] ?>"><?= ucwords($row["ketkode3"]) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Jumlah</label>
                                        <input type="text" class="form-control" id="jumlahoutput" name="jumlahoutput">
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default waves-effect" id="inputproposal" name="outputkas">Input</button>
                            <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->

            <div id="modalinputkas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 class="modal-title">Pemasukan Kas</h2>
                        </div>
                        <form method="post" action="../models/input">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Pay to / Recieved</label>
                                        <input type="text" class="form-control" id="field-5" placeholder="Pay to / Recieved" name="payto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Tanggal</label>
                                        <input type="text" class="form-control" id="datepicker-autoclose1" placeholder="Date" name="tanggal">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Keterangan</label>
                                        <input type="text" class="form-control" id="field-3" placeholder="Keterangan Transaksi" name="keterangan">
                                    </div>
                                </div>
                               
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Kode Transaksi</label>
                                        <select class="form-control select2" name="kodeakun">
                                            <option value="0" >Kode Akun</option>
                                            <?php foreach ($kodeakunp as $row ) : ?>
                                                <option value="<?= $row['kodeakun3'] ?>"><?= ucwords($row["ketkode3"]) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Jumlah</label>
                                        <input type="text" class="form-control" id="jumlahinput" name="jumlahinput" placeholder="Rp.">
                                    </div>
                                </div>
                                
                            </div>  
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default waves-effect" id="inputproposal" name="inputkas">Inputs</button>
                            <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->


<?php 
require '../include/footer.php';
?>   