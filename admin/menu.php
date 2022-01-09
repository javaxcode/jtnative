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
                                        <button class="btn btn-primary waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalmenu">Input Menu</button>
                                         <button class="btn btn-info waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalsubmenu">Input Sub Menu</button>
                                        <button class="btn btn-purple waves-effect waves-light btn-xs m-b-5" data-toggle="modal" data-target="#modalaccess">Access</button>
                                    </div>
                                    
                                <h4 class="header-title m-t-0 m-b-30">Data Menu</h4>
                                
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Menu ID</th>
                                                <th>Title</th>
                                                <th>Icon</th>
                                                <th>Active</th>
                                                <th>Model Menu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($menu as $row ) : ?>
                                                <tr>
                                                    <td width="5%"><?= $i ?></td> 
                                                    <td>
                                                        <?php 
                                                            $menu_id = $row['menu_id'];
                                                            $query = mysqli_query($conn, "SELECT * FROM user_menu WHERE id ='$menu_id' ");
                                                            $menu = mysqli_fetch_array($query);
                                                         ?>
                                                        <?= $menu['menu'] ?>
                                                    </td>
                                                    <td class="text-success" ><?= $row['title'] ?></td>   
                                                    
                                                    <td><?= $row['icon'] ?></td>
                                                   
                                                    
                                                    <td>
                                                        <?php if($row['is_active']=='1') : ?>
                                                            <span class="label label-success">Aktif</span>
                                                        <?php else : ?>
                                                            <span class="label label-inverse">Tidak Aktif</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($row['model_menu']=='1') : ?>
                                                            <span class="label label-primary">Tunggal</span>
                                                        <?php else : ?>
                                                            <span class="label label-info">Cabang</span>
                                                        <?php endif; ?>
                                                    </td>
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
                                    <label for="field-5" class="control-label">Nama Menu </label>
                                    <select class="form-control select2" name="menu" >
                                        <option value="<?= $menu['id'] ?>"><?= $menu['menu'] ?></option>
                                        <?php foreach ($userMenu as $roww ) : ?>
                                            <option value="<?= $roww['id'] ?>"><?= $roww['menu'] ?></option>
                                        <?php endforeach; ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Nama Sub Menu </label>
                                    <input type="text" class="form-control" id="field-5" value="<?= $row['title'] ?>" name="submenu">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Icon</label>
                                    <input type="text" class="form-control" id="field-5" value="<?= $row['icon'] ?>" name="icon">
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Model Menu</label>
                                    <select class="form-control select2" name="modelmenu">
                                        <option value="<?= $row['model_menu'] ?>">
                                            <?php if($row['model_menu']=='1'): ?>
                                                Tunggal
                                            <?php else: ?>
                                                Cabang
                                            <?php endif; ?>
                                        </option>
                                        <?php if($row['model_menu']!='1'): ?>
                                            <option value="1">Tunggal</option>
                                        <?php else: ?>
                                            <option value="2">Cabang</option>
                                        <?php endif; ?>
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

                <div id="modalmenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="width:80%;">
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
                                            <th>Action</th>
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

                <div id="modalsubmenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h2 class="modal-title">Input Sub Menu</h2>
                            </div>
                            <form method="post" action="../models/input">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Nama Menu </label>
                                            <select class="form-control select2" name="menu">
                                                <?php foreach ($userMenu as $rowww ) : ?>
                                                    <option value="<?= $rowww['id'] ?>"><?= $rowww['menu'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Nama Sub Menu</label>
                                            <input type="text" class="form-control" id="field-5" placeholder="Nama Sub Menu" name="submenu">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">Icon</label>
                                            <input type="text" class="form-control" id="field-3" placeholder="Icon" name="icon">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">Active</label>
                                            <select class="form-control select2" name="active">
                                                <option value="1>">Aktif</option>
                                                <option value="2">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="field-3" class="control-label">Model Menu</label>
                                            <select class="form-control select2" name="modelmenu">
                                                <option value="2">Cabang</option>
                                                <option value="1">Tunggal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                   
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default waves-effect" id="inputsubmenu" name="inputsubmenu">Input Sub Menu</button>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Access Menu</label>
                                            <select class="form-control select2" name="menu">
                                                <?php foreach ($userMenu as $rowww ) : ?>
                                                    <option value="<?= $rowww['id'] ?>"><?= $rowww['menu'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label">Access SubMenu</label>
                                            <select class="form-control select2" name="submenu2">
                                                <?php foreach ($menu2 as $row2 ) : ?>
                                                    <option value="<?= $row2['id'] ?>"><?= $row2['halaman'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="field-5" class="control-label"></label>
                                            <input type="submit" class="form-control btn-primary" id="field-5" value="Input" name="inputaccessmenu">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
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