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
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="m-b-30">
                                        <button id="addToTable" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <table class="table table-striped" id="datatable-editable">
                                    <thead>
                                        <tr>
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>Trident</td>
                                            <td>Internet
                                                Explorer 4.0
                                            </td>
                                            <td>Win 95+</td>
                                            <td class="actions">
                                                <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                                <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                                <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end: panel body -->

                    </div> <!-- end panel -->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
        </div> <!-- container -->

    </div> <!-- content -->

    <?php
    require '../include/footer.php';
    ?>