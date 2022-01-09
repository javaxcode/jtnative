<?php
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require 'controllers/c_auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require 'controllers/c_proposal.php';

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

                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalproyek">Input Proyek</button>
                        </div>
                        <div class="dropdown pull-centre">
                            <button class="btn btn-primary waves-effect waves-light">Total Proyek Tahun <?= $year  ?> </button>
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
                                        <option>Bulan</option>
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
                                        <option value="<?= $year; ?>"><?= $year; ?></option>
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
                        <h4 class="header-title m-t-0 m-b-30">Data Proposal Tahun <?= $year  ?></h4>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No Proposal</th>
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
                                <?php foreach ($proposal as $row) : ?>
                                    <tr>
                                        <td width="5%"><?= $i ?></td>
                                        <td width="10%" ;>
                                            <?php
                                            $t = $row['tanggalpro'];
                                            $ta = substr($t, 8, 2);
                                            $bu = "/" . substr($t, 5, 2) . "/";
                                            $tah = substr($t, 0, 4);

                                            echo $ta . $bu . $tah;
                                            ?>
                                        </td>
                                        <?php if ($row['status'] != 1) : ?>
                                            <td class="text-danger" width="10%" ;><?= $row["noproposal"] ?></td>
                                        <?php else : ?>
                                            <td class="text-success" width="10%" ;><?= $row["noproposal"] ?></td>
                                        <?php endif; ?>

                                        <td width="15%" ;>
                                            <?php
                                            $km = $row['namaklien'];
                                            $query = mysqli_query($conn, "SELECT * FROM marketing WHERE kodemarketing ='$km' ");
                                            $kodem = mysqli_fetch_array($query);
                                            ?>
                                            <?= $row["namaklien"] ?>
                                        </td>
                                        <td><?= $row['outlet'] ?></td>
                                        <td><?= $row['tempat'] ?></td>
                                        <td>
                                            <?php if ($row['pekerjaan'] != "") : ?>
                                                <?php
                                                if ($row['pekerjaan'] == '1') {
                                                    echo "FULL";
                                                } elseif ($row['pekerjaan'] == '2') {
                                                    echo "KITCHEN";
                                                } elseif ($row['pekerjaan'] == '3') {
                                                    echo "INSTALASI GAS";
                                                } elseif ($row['pekerjaan'] == '4') {
                                                    echo "DUCTING";
                                                } else {
                                                    echo "AC";
                                                }

                                                ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= number_format($row['nilaiproyek']) ?></td>
                                        <td>
                                            <?php if ($row['status'] != 1) : ?>
                                                <a href="models/inputproyek.php?ip=<?= $row['id'] ?>" class="on-default edit-row badge badge-warning"><i class="fa fa-question"></i></a>
                                            <?php else : ?>
                                                <a class="on-default edit-row badge badge-success"><i class="fa fa-check"></i></a>
                                            <?php endif ?>
                                            |
                                            <a class="on-default edit-row badge badge-info" data-toggle="modal" data-target="#modaleditfaktur<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> |
                                            <a href="models/hapus.php?code=hapusproposal&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data unit ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                        <div id="modaleditfaktur<?= $row['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h2 class="modal-title">Edit Proposal</h2>
                                                    </div>
                                                    <form method="post" action="models/edit">
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
                                                                            <option value="<?= $kodem['kodemarketing'] ?>"><?= $kodem['marketing']  ?></option>
                                                                            <?php foreach ($kodemarketingg as $rowr) : ?>
                                                                                <option value="<?= $rowr['kodemarketing'] ?>"><?= $rowr['marketing'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="field-3" class="control-label">Outlet</label>
                                                                        <input type="text" class="form-control" id="field-3" value="<?= $row['outlet']  ?>" name="outlet">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="field-3" class="control-label">Alamat Tempat</label>
                                                                        <input type="text" class="form-control" id="field-3" value="<?= $row['tempat']  ?>" name="tempat">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="field-2" class="control-label">Pekerjaan</label>
                                                                        <select class="form-control select2" name="pekerjaan">
                                                                            <option>
                                                                                <?php
                                                                                if ($row['pekerjaan'] == '1') {
                                                                                    echo "FULL";
                                                                                } elseif ($row['pekerjaan'] == '2') {
                                                                                    echo "KITCHEN";
                                                                                } elseif ($row['pekerjaan'] == '3') {
                                                                                    echo "INSTALASI GAS";
                                                                                } elseif ($row['pekerjaan'] == '4') {
                                                                                    echo "DUCTING";
                                                                                } else {
                                                                                    echo "AC";
                                                                                }
                                                                                ?>
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
                                                                        <input type="text" class="form-control" id="nilaiproyek" name="nilaiproyek" value="<?= $row['nilaiproyek']  ?>">
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

    <div id="modalproposal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title">Proposal</h2>
                </div>
                <form method="post" action="models/input">
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
                                    <label for="field-5" class="control-label">Nama Marketing</label>
                                    <select class="form-control select2" name="namaklien">
                                        <?php foreach ($kodemarketingg as $rowr) : ?>
                                            <option value="<?= $rowr['kodemarketing'] ?>"><?= $rowr['marketing'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Pekerjaan</label>
                                    <select class="form-control select2" name="pekerjaan">
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
                                    <input type="text" class="form-control" id="nilaiproyek" name="nilaiproyek" placeholder="Rp.">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default waves-effect" id="inputproposal" name="inputproposal">Input Proposal</button>
                        <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->

    <div id="modalmarketing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title">Input Marketing</h2>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <form method="post" action="models/input">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Nama Marketing </label>
                                    <input type="text" class="form-control" id="field-5" placeholder="Nama Marketing" name="marketing">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-5" class="control-label"></label>
                                    <input type="submit" class="form-control btn-primary" id="field-5" value="Input" name="inputmarketing">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">

                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <?php foreach ($kodemarketingg as $row) : ?>
                                <tr>
                                    <td width="5%"><?= $i ?></td>
                                    <td>
                                        <?= ucwords($row['marketing']) ?>
                                    </td>
                                    <td>
                                        <a href="models/hapus.php?code=hapusmarketing&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data marketing ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div><!-- /.modal -->

    <?php
    require '../include/footer.php';
    ?>