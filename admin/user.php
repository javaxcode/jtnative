<?php 
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require '../controllers/admin/auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require '../controllers/admin/user.php';
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

                                    <?php  require 'menubar.php';  ?>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-primary waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalmenu">Input User</button>
                                    </div>
                                    
                                <h4 class="header-title m-t-0 m-b-30">Data User</h4>
                                
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Role ID</th>
                                                <th>Status</th>
                                                <th>Bergabung</th>
                                                <th>Foto</th>
                                                <!-- <th>Out Standing</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($user as $row ) : ?>
                                                <tr>
                                                    <td width="5%"><?= $i ?></td> 
                                                    <td>
                                                        
                                                        <?= $row['name'] ?>
                                                    </td>
                                                    <td class="text-success" ><?= $row['email'] ?></td>   
                                                    
                                                    <td width="10%"; ><?= $row['role_id'] ?></td>
                                                    
                                                    <td>
                                                         <?php if($row['is_active']=='1') : ?>
                                                            <span class="label label-success">Aktif</span>
                                                        <?php else : ?>
                                                            <span class="label label-inverse">Tidak Aktif</span>
                                                        <?php endif; ?>
                                                    </td>
                                                   
                                                    
                                                    <td>
                                                        
                                                    </td>
                                                    <td>
                                                        
                                                    </td>
                                                    <td><a class="on-default edit-row badge badge-warning" data-toggle="modal" data-target="#modaledit<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> | <a href="../models/hapus.php?code=hapususer&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data user ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger" ><i class="fa fa-trash-o"></i></a></td>

        <div id="modaledit<?= $row['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">Edit User</h2>
                    </div>
                    <form method="post" action="../models/edit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" id="field-5" value="<?= $row['id'] ?>" name="id">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Nama </label>
                                    <input type="text" class="form-control" id="field-5" value="<?= $row['name'] ?>" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Email </label>
                                    <input type="text" class="form-control" id="field-5" value="<?= $row['email'] ?>" name="email">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Active</label>
                                    <select class="form-control select2" name="active">
                                        <option value="<?= $row['is_active'] ?>">
                                            <?php if($row['is_active']=='1'): ?>
                                                Aktif
                                            <?php else: ?>
                                                Tidak Aktif
                                            <?php endif; ?>
                                        </option>
                                        <?php if($row['is_active']!='1'): ?>
                                            <option value="1">Aktif</option>
                                        <?php else: ?>
                                            <option value="2">Tidak Aktif</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        $urID =  $row['role_id'];
                                        $userroleid = query("SELECT * FROM user_role WHERE id = '$urID' ")[0]; 
                                    ?>
                                    <label for="field-3" class="control-label">Role ID</label>
                                    <select class="form-control select2" name="role">
                                        <option value="<?= $userroleid['id']  ?>"><?= $userroleid['role']  ?></option>
                                        <?php foreach ($userrole as $rowww ) : ?>
                                            <option value="<?= $rowww['id'] ?>"><?= $rowww['role'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default waves-effect" id="edituser" name="edituser">Edit User</button>
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

                <div id="modalmenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h4 class="text-uppercase font-bold m-b-0">Daftar User</h4>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal m-t-20" method="post" action="../models/input">

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="text" id="name" name="name" placeholder="Nama">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="email" id="email" name="email" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <?php $uroleid = query("SELECT * FROM user_role WHERE id != '1' "); ?>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <select class="form-control select2" name="role">
                                                    <?php foreach ($uroleid as $roww ) : ?>
                                                        <option value="<?= $roww['id'] ?>"><?= $roww['role'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <div class="col-xs-12">
                                                <div class="checkbox checkbox-custom">
                                                    <input id="checkbox-signup" type="checkbox" checked="checked">
                                                    <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="form-group text-center m-t-40">
                                            <div class="col-xs-12">
                                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit" name="daftaruser">
                                                    Register
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <!-- end card-box -->  
                        </div>
                    </div>
                </div><!-- /.modal -->

<?php 
require '../include/footer.php';
?>                