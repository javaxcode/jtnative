<?php 
require '../include/fungsi.php';
require '../include/fungsi_rupiah.php';
require '../controllers/admin/auth.php';
require '../include/header.php';
require '../include/topbar.php';
require '../include/sidebar.php';
require '../controllers/admin/menu.php';
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
                                        <button class="btn btn-primary waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalmenu">Input Access Menu</button>
                                    </div>
                                    
                                <h4 class="header-title m-t-0 m-b-30">Data Access Menu</h4>
                                
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Role ID</th>
                                                <th>Menu</th>
                                                <th>SubMenu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($userAccessMenu as $row ) : ?>
                                                <tr>
                                                    <?php 
                                                        $role_id = $row['role_id'];
                                                        $query = mysqli_query($conn, "SELECT * FROM user_role WHERE id ='$role_id' ");
                                                        $role = mysqli_fetch_array($query);

                                                        $menu_id = $row['menu_id'];
                                                        $query = mysqli_query($conn, "SELECT * FROM user_sub_menu WHERE id ='$menu_id' ");
                                                        $menu = mysqli_fetch_array($query);

                                                        $submenu_id = $row['submenu_id'];
                                                        $query = mysqli_query($conn, "SELECT * FROM user_sub_menu2 WHERE id ='$submenu_id' ");
                                                        $submenu = mysqli_fetch_array($query);

                                                     ?>
                                                    <td width="5%"><?= $i ?></td> 
                                                    <td><?= $role['role'] ?></td>
                                                    <td ><?= $menu['title'] ?></td> 
                                                    <td><?= $submenu['halaman'] ?></td>
                                                    
                                                    <td>
                                                        <a class="on-default edit-row badge badge-warning" data-toggle="modal" data-target="#modaleditmenu<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> | 
                                                        <a href="../models/hapus.php?code=hapussubmenu&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data user ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger" ><i class="fa fa-trash-o"></i></a>
                                                    </td>

        <div id="modaleditmenu<?= $row['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">Edit Sub Menu</h2>
                    </div>
                    <form method="post" action="../models/edit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" class="form-control" id="field-5" value="<?= $row['id'] ?>" name="id">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Role </label>
                                    <select class="form-control select2" name="roleid" >
                                        <option value="<?= $role['id'] ?>"><?= $role['role'] ?></option> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Menu </label>
                                    <select class="form-control select2" name="menu" >
                                        <option value="<?= $menu['id'] ?>"><?= $menu['title'] ?></option> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Sub Menu</label>
                                    <select class="form-control select2" name="submenu" >
                                        <option value="<?= $submenu['id'] ?>"><?= $submenu['halaman'] ?></option> 
                                    </select>
                                </div>
                            </div>
                            
                        </div>   
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default waves-effect" id="editmenu" name="editmenu">Edit Menu</button>
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

                <script type="text/javascript">
               
                    $(document).ready(function(){
                        $('#menu').change(function() { // Jika Select Box id provinsi dipilih
                            var menu = $(this).val(); // Ciptakan variabel provinsi
                            $.ajax({
                                type: 'POST', // Metode pengiriman data menggunakan POST
                                url: '../models/js/submenu2.php', // File yang akan memproses data
                                data: 'menu=' + menu, // Data yang akan dikirim ke file pemroses
                                success: function(response) { // Jika berhasil
                                    $('#submenu').html(response); // Berikan hasil ke id kota
                                }
                            });
                        });
                        
                    });

                </script>

                <div id="modalmenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h2 class="modal-title">Input Access Menu</h2>
                            </div>
                            <form method="post" action="../models/input">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" class="form-control" id="field-5" value="<?= $row['id'] ?>" name="id">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">Role </label>
                                                <select class="form-control select2" name="menu" id="menu" >
                                                    <option>Pilih Role</option>
                                                    <?php foreach ($userMenu as $rowww ) : ?>
                                                    <option value="<?= $rowww['id'] ?>"><?= $rowww['menu'] ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-5" class="control-label">Menu </label>
                                                <select class="form-control select2" name="submenu" id="submenu" >
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">Sub Menu</label>
                                                <select class="form-control select2" name="submenu" >
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>   
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-default waves-effect" id="inputaccessmenu" name="inputaccessmenu">Input</button>
                                    <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                                </div>
                                </form>
                            
                            
                        </div>
                    </div>
                </div><!-- /.modal -->

<?php 
require '../include/footer.php';
?>                