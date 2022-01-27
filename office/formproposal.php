<?php
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require 'controllers/c_auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require 'controllers/c_proyek.php';

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
                            <button class="btn btn-primary waves-effect waves-light">Total Proyek Tahun <?= $year  ?> : Rp. <?= format_rupiah($totali)  ?></button>
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
                                    <th>Nilai Proyek</th>
                                    <!-- <th>Out Standing</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($proyek as $row) : ?>
                                    <tr>
                                        <td width="5%"><?= $i ?></td>
                                        <td><?= $row['tanggalpjt'] ?></td>
                                        <td class="text-success"><?= $row['tanggalpjt'] ?></td>

                                        <td width="10%" ;></td>

                                        <td></td>


                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                <?php endforeach; ?>
                                <?php $i++; ?>
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