<?php
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require 'controllers/c_auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require 'controllers/c_unit.php';
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
                            <button class="btn btn-primary waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalfaktur">Input Faktur</button>
                            <!-- <button class="btn btn-info waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalsubmenu">Input Sub Menu</button>
                                        <button class="btn btn-purple waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalaccess">Access</button> -->
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Data Pembelian Unit</h4>

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Qty</th>
                                    <th>Supplier</th>
                                    <th>No Faktur</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($beliunit as $row) : ?>
                                    <tr>
                                        <?php
                                        $nf = $row["nofaktur"];
                                        $t = $row['tanggal'];
                                        $jt = $row['jatuhtempo'];
                                        ?>
                                        <td width="5%"><?= $i ?></td>
                                        <td width="15%">
                                            <?php
                                            //$t = $row['tanggal'];
                                            $ta = substr($t, 8, 2);
                                            $bu = "/" . substr($t, 5, 2) . "/";
                                            $tah = substr($t, 0, 4);

                                            echo "Beli : " . $ta . $bu . $tah;
                                            ?>
                                            <br>
                                            <?php
                                            //$t = $row['jatuhtempo'];
                                            $ta = substr($jt, 8, 2);
                                            $bu = "/" . substr($jt, 5, 2) . "/";
                                            $tah = substr($jt, 0, 4);

                                            echo "JTempo : " . $ta . $bu . $tah;
                                            ?>
                                        </td>
                                        <td width="5%" align="center">
                                            <?php

                                            $ceklogin = mysqli_query($conn, "SELECT nofaktur FROM pembelianunit WHERE nofaktur ='$nf' ");
                                            $jumlah = mysqli_num_rows($ceklogin);
                                            ?>
                                            <?= $jumlah  ?>
                                        </td>
                                        <td>
                                            <?php
                                            $sp = $row["supplier"];
                                            $item = "SELECT * FROM supplier WHERE kodesupplier ='$sp'"; //perintah untuk menjumlahkan
                                            $hasili = mysqli_query($conn, $item); //melakukan query dengan varibel $jumlahkan
                                            $arrayi = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
                                            $namasupplier = $arrayi['namasupplier'];
                                            ?>
                                            <?= ucwords($namasupplier);  ?>
                                        </td>
                                        <td class="text-success"><a class="on-default badge badge-info" data-toggle="modal" data-target="#itemunit<?= $row["id"];  ?>"><?= $row["nofaktur"];  ?></a>

                                            <div id="itemunit<?= $row["id"];  ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="width:80%;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h2 class="modal-title">Faktur : <?= $row["nofaktur"];  ?> | Supplier : <?= ucwords($namasupplier);  ?></h2>
                                                        </div>
                                                        <?php

                                                        $itemfaktur = query("SELECT * FROM pembelianunit WHERE nofaktur = '$nf'  ");
                                                        ?>
                                                        <div class="modal-body">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Unit</th>
                                                                        <th>Merk</th>
                                                                        <th>Harga</th>
                                                                        <th>Disc</th>
                                                                        <th>PPN</th>
                                                                        <th>Harga Beli</th>
                                                                        <th>Qty</th>
                                                                        <th>Total Harga</th>
                                                                        <!-- <th>Action</th> -->
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <?php $a = 1; ?>
                                                                    <?php foreach ($itemfaktur as $roww) : ?>
                                                                        <tr>
                                                                            <td width="5%"><?= $a ?></td>

                                                                            <td>
                                                                                <?php
                                                                                $kodeunit = $roww["namaunit"];
                                                                                $item = "SELECT * FROM unit WHERE kodeunit ='$kodeunit'"; //perintah untuk menjumlahkan
                                                                                $hasili = mysqli_query($conn, $item); //melakukan query dengan varibel $jumlahkan
                                                                                $arrayi = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
                                                                                $namaunit = $arrayi['namaunit'];
                                                                                ?>
                                                                                <?= ucwords($namaunit); ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                $kodemerk = $roww["merk"];
                                                                                $item = "SELECT * FROM merk WHERE kodemerk ='$kodemerk'"; //perintah untuk menjumlahkan
                                                                                $hasili = mysqli_query($conn, $item); //melakukan query dengan varibel $jumlahkan
                                                                                $arrayi = mysqli_fetch_array($hasili); //menyimpan hasil query ke variabel $t
                                                                                $namamerk = $arrayi['merk'];
                                                                                ?>
                                                                                <?= strtoupper($namamerk) ?>
                                                                            </td>
                                                                            <td><?= number_format($roww["harga"]) ?></td>
                                                                            <td><?= $roww["diskon"] ?>%</td>
                                                                            <td><?= $roww["ppn"] ?>%</td>
                                                                            <td><?= number_format($roww["hargabeli"]) ?></td>
                                                                            <td><?= $roww["jumlah"] ?></td>
                                                                            <td><?= number_format($roww["totalharga"]) ?></td>

                                                                        </tr>
                                                                        <?php $a++; ?>
                                                                    <?php endforeach; ?>
                                                                    <tr>
                                                                        <td colspan="7"></td>
                                                                        <td>
                                                                            <h4>Total</h4>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            //$nof = $row["nofaktur"];
                                                                            $jumlaht = "SELECT SUM(totalharga) AS total_t FROM pembelianunit WHERE nofaktur ='$nf'"; //perintah untuk menjumlahkan
                                                                            $hasilt = mysqli_query($conn, $jumlaht); //melakukan query dengan varibel $jumlahkan
                                                                            $inpt = mysqli_fetch_array($hasilt); //menyimpan hasil query ke variabel $t
                                                                            $totalt = $inpt['total_t'];
                                                                            ?>
                                                                            <h4>Rp. <?= number_format($totalt)  ?></h4>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div><!-- /.modal -->

                                        </td>
                                        <td align="right">

                                            <?= number_format($totalt)  ?>
                                        </td>
                                        <td width="10%" align="center">
                                            <?php if ($row["status"] == 1) : ?>
                                                <a href="add/pelunasansparepart.php?id=<?= $row["id"] ?>"><span class="label label-danger">Belum Bayar</span></a>
                                            <?php else : ?>
                                                <span class="label label-success">Lunas</span>
                                            <?php endif; ?>
                                        </td>
                                        <td width="10%">
                                            <a href="pembelianunit.php?nf=<?= $nf ?>" class="on-default edit-row badge badge-success"><i class="fa fa-plus"></i></a> |
                                            <a class="on-default edit-row badge badge-warning" data-toggle="modal" data-target="#modaleditfaktur<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> |
                                            <a href="models/hapus.php?code=hapusunit&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data unit ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger"><i class="fa fa-trash-o"></i></a>


                                        </td>
                                        <div id="modaleditfaktur<?= $row['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h2 class="modal-title">Edit Faktur </h2>
                                                    </div>

                                                    <form method="post" action="models/edit">
                                                        <div class="modal-body">
                                                            <input type="hidden" class="form-control" id="field-5" value="<?= $row['id'] ?>" name="id">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="field-5" class="control-label">Tanggal </label>
                                                                        <input type="text" class="form-control" id="datepicker-autoclose2" value="<?php
                                                                                                                                                    $ta = substr($t, 8, 2);
                                                                                                                                                    $bul = substr($t, 5, 2);
                                                                                                                                                    $tah = substr($t, 0, 4);

                                                                                                                                                    echo $bul . '/' . $ta . '/' . $tah;
                                                                                                                                                    ?>" name="tanggal">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="field-5" class="control-label">Supplier </label>
                                                                        <select class="form-control select2" name="supplier">
                                                                            <option value="<?= $sp  ?>"><?= ucwords($namasupplier);  ?></option>
                                                                            <?php foreach ($kodesupplierr as $row) : ?>
                                                                                <option value="<?= $row['kodesupplier'] ?>"><?= ucwords($row["namasupplier"]) ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="field-5" class="control-label">Jatuh Tempo</label>
                                                                        <input type="text" class="form-control" id="datepicker-autoclose3" value="<?php
                                                                                                                                                    $ta = substr($jt, 8, 2);
                                                                                                                                                    $bul = substr($jt, 5, 2);
                                                                                                                                                    $tah = substr($jt, 0, 4);

                                                                                                                                                    echo $bul . '/' . $ta . '/' . $tah;
                                                                                                                                                    ?>" name="jatuhtempo">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="field-3" class="control-label">No Faktur</label>
                                                                        <input type="text" class="form-control" id="field-3" value="<?= $nf  ?>" name="nofaktur">
                                                                    </div>
                                                                </div>

                                                            </div>



                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-default waves-effect" id="editfaktur" name="editfaktur">Edit Faktur</button>
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

    <div id="modalfaktur" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title">Input Faktur</h2>
                </div>

                <form method="post" action="pembelianunit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Tanggal </label>
                                    <input type="text" class="form-control" id="datepicker-autoclose" placeholder="Pembelian" name="tanggal">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Supplier </label>
                                    <select class="form-control select2" name="supplier">
                                        <option> -- Pilih Supplier -- </option>
                                        <?php foreach ($kodesupplierr as $row) : ?>
                                            <option value="<?= $row['kodesupplier'] ?>"><?= ucwords($row["namasupplier"]) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Jatuh Tempo</label>
                                    <input type="text" class="form-control" id="datepicker-autoclose1" placeholder="Pembelian" name="jatuhtempo">
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">No Faktur</label>
                                    <input type="text" class="form-control" id="field-3" placeholder="No Faktur" name="nofaktur">
                                </div>
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default waves-effect" id="inputfaktur" name="inputfaktur">Input Faktur</button>
                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                    </div>
                </form>


            </div>
        </div>
    </div><!-- /.modal -->






    <?php
    require '../include/footer.php';
    ?>