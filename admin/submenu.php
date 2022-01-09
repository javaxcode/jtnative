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
                                         <button class="btn btn-info waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalsubmenu">Input Sub Menu2</button>
                                        <button class="btn btn-purple waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalaccess">Access</button>
                                    </div>
                                    
                                <h4 class="header-title m-t-0 m-b-30">Data Sub Menu</h4>
                                
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Menu ID</th>
                                                <th>SubMenu ID</th>
                                                <th>Halaman</th>
                                                <th>URL</th>
                                                <th>Active</th>
                                                <!-- <th>Out Standing</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($menu2 as $row ) : ?>
                                                <tr>
                                                    <?php 
                                                        $menu_id = $row['menu_id'];
                                                        $query = mysqli_query($conn, "SELECT * FROM user_menu WHERE id ='$menu_id' ");
                                                        $menu = mysqli_fetch_array($query);
                                                     ?>
                                                    <?php 
                                                        $submenu_id = $row['submenu_id'];
                                                        $query = mysqli_query($conn, "SELECT * FROM user_sub_menu WHERE id ='$submenu_id' ");
                                                        $smenu = mysqli_fetch_array($query);
                                                     ?>
                                                    <td width="5%"><?= $i ?></td> 
                                                    <td>
                                                        
                                                        <?= $menu['menu'] ?>
                                                    </td>
                                                    <td >
                                                        
                                                        <?= $smenu['title'] ?>
                                                    </td>
                                                    <td  ><?= $row['halaman'] ?></td>
                                                    <td  ><?= $row['url'] ?></td>
                                                    <td>
                                                        <?php if($row['is_active']=='1') : ?>
                                                            <span class="label label-success">Aktif</span>
                                                        <?php else : ?>
                                                            <span class="label label-inverse">Tidak Aktif</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a class="on-default edit-row badge badge-warning" data-toggle="modal" data-target="#modaleditmenu<?= $row['id'] ?>"><i class="fa fa-pencil"></i></a> | 
                                                        <a href="../models/hapus.php?code=hapussubmenu2&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data user ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger" ><i class="fa fa-trash-o"></i></a>
                                                    </td>

        <div id="modaleditmenu<?= $row['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">Edit Sub Menu2</h2>
                    </div>
                    <form method="post" action="../models/edit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" class="form-control" id="field-5" value="<?= $row['id'] ?>" name="id">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Nama Menu </label>
                                    <select class="form-control select2" name="menu" >
                                        <option value="<?= $row['menu_id'] ?>"><?= $menu['menu'] ?></option>
                                        <?php foreach ($userMenu as $roww ) : ?>
                                            <option value="<?= $roww['id'] ?>"><?= $roww['menu'] ?></option>
                                        <?php endforeach; ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Nama Sub Menu </label>
                                    <select class="form-control select2" name="submenu" >
                                        <option value="<?= $row['submenu_id'] ?>"><?= $smenu['title'] ?></option>
                                        <?php 
                                            $smid = $row['submenu_id'];
                                            $smenuid = query("SELECT * FROM user_sub_menu WHERE menu_id = '$smid'");
                                        ?>
                                        <?php foreach ($smenuid as $rowsb ) : ?>
                                            <option value="<?= $rowsb['menu_id'] ?>"><?= $rowsb['title'] ?></option>
                                        <?php endforeach; ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Nama Sub Menu2 </label>
                                    <input type="text" class="form-control" id="field-5" value="<?= $row['halaman'] ?>" name="submenu2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">URL</label>
                                    <input type="text" class="form-control" id="field-5" value="<?= $row['url'] ?>" name="url">
                                </div>
                            </div>
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
                            
                        </div>      
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default waves-effect" id="editmenu" name="editsubmenu2">Edit Menu</button>
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
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h2 class="modal-title">Input Menu</h2>
                            </div>
                            
                            <div class="modal-body">
                                <div class="row">
                                    <form method="post" action="../models/input">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Nama Menu </label>
                                                <input type="text" class="form-control" id="field-5" placeholder="Menu" name="menu">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label"></label>
                                            <input type="submit" class="form-control btn-primary" id="field-5" value="Input" name="inputmenu">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="row">
                                    
                                    <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Menu</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($userMenu as $row ) : ?>
                                        <tr>
                                            <td width="5%"><?= $i ?></td> 
                                            <td >
                                                <?= $row['menu'] ?>
                                            </td>
                                            <td>
                                                <a href="../models/hapus.php?code=hapusmenu&id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus data user ini ?')){return true}else{return false}" class="on-default remove-row badge badge-danger" ><i class="fa fa-trash-o"></i></a>
                                            </td> 
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div><!-- /.modal -->
                
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

                <div id="modalsubmenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h2 class="modal-title">Input Sub Menu2</h2>
                            </div>
                            <form method="post" action="../models/input">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Nama Menu </label>
                                            <select class="form-control select2" name="menu" id="menu">
                                                <option>Pilih Menu</option>
                                                <?php foreach ($userMenu as $rowww ) : ?>
                                                    <option value="<?= $rowww['id'] ?>"><?= $rowww['menu'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Nama Sub Menu</label>
                                            <select class="form-control select" name="submenu" id="submenu">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Nama Submenu2</label>
                                            <input type="text" class="form-control" id="field-5" placeholder="submenu2" name="submenu2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">URL</label>
                                            <input type="text" class="form-control" id="field-3" placeholder="url" name="url">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">Active</label>
                                            <select class="form-control select2" name="active">
                                                <option value="1">Aktif</option>
                                                <option value="2">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default waves-effect" id="inputsubmenu2" name="inputsubmenu2">Input Data</button>
                                <!-- <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button> -->
                            </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal -->

                <div id="modalaccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h2 class="modal-title">Access Menu</h2>
                            </div>
                            
                            <div class="modal-body">
                                <div class="row">
                                    <form method="post" action="../models/input">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Role ID </label>
                                            <select class="form-control select2" name="role">
                                                <?php foreach ($userrole as $rowr ) : ?>
                                                    <option value="<?= $rowr['id'] ?>"><?= $rowr['role'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Access Menu</label>
                                            <select class="form-control select2" name="menu">
                                                <?php foreach ($userMenu as $rowww ) : ?>
                                                    <option value="<?= $rowww['id'] ?>"><?= $rowww['menu'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label"></label>
                                            <input type="submit" class="form-control btn-primary" id="field-5" value="Input" name="inputaccessmenu">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Role ID</th>
                                                <th>Access Menu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($userAccessMenu as $row ) : ?>
                                            <tr>
                                                <td width="5%"><?= $i ?></td> 
                                                <td >
                                                    <?php 
                                                        $ri = $row['role_id'];
                                                        $uM = query("SELECT role FROM user_role WHERE id = '$ri'")[0];
                                                    ?>
                                                    <?= $uM['role'] ?>
                                                </td> 
                                                <td >
                                                    <?php 
                                                        $idM = $row['menu_id'];
                                                        $uM = query("SELECT menu FROM user_menu WHERE id = '$idM'")[0];
                                                    ?>
                                                    <?= $uM['menu'] ?>
                                                </td> 
                                                <td></td>
                                            </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                            
                        </div>
                    </div>
                </div><!-- /.modal -->

                

<?php 
require '../include/footer.php';
?>                