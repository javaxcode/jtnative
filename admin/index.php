<?php
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require 'controllers/c_auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
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

                        <?php require 'menubar.php';  ?>



                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <?php
    require '../include/footer.php';
    ?>