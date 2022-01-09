<?php
    $ri = query("SELECT * FROM user WHERE email = '$s'")[0];
    $role_id = $ri['role_id'];
    // $menu = query("SELECT * FROM user_access_menu 
    //                 JOIN user_menu 
    //                 ON user_access_menu.menu_id = user_menu.id  
    //                 WHERE user_access_menu.role_id = '$role_id'");
    
?>
<!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu ">
                <div class="sidebar-inner slimscrollleft m-t-20">

                  

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            
                            <li class="text-muted menu-title">ADMIN</li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="../admin/index">Overview</a>
                                        <li><a href="../admin/page-starter">Tes</a>
                                    </ul>
                                </li>
                            <li class="text-muted menu-title">OFFICE</li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Work</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="../office/proposal">Proposal</a>
                                        <li><a href="../office/proyek">Proyek</a>
                                        <li><a href="../office/maintenance">Maintenance</a>
                                        
                                    </ul>
                                </li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Cash</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="../office/kaskecil">Kas Kecil</a>
                                        <li><a href="../office/pembayaran">Pembayaran</a>
                                    </ul>
                                </li>

                            <li class="text-muted menu-title">INVENTORY</li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Pembelian</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="../inventory/unit">Unit</a>
                                        <li><a href="../inventory/maintenance">Sparepart</a>
                                    </ul>
                                </li>

                            <li class="text-muted menu-title">ACCOUNTING</li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Kas</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="../accounting/kasbankmasuk">Kas Bank Masuk</a>
                                        <li><a href="../accounting/kasbankkeluar">Kas Bank Keluar</a>
                                        
                                    </ul>
                                </li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Administrasi</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="../accounting/listrikspeedy">Listrik Speedy</a>
                                        
                                    </ul>
                                </li>
                            
                            <li class="text-muted menu-title">KARYAWAN</li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="overview">Proyek</a>
                                        <li><a href="maintenance">Maintenance</a>
                                        
                                    </ul>
                                </li>        
                                <li>
                                    <a href="../logout" class="waves-effect"><i class="zmdi zmdi-power"></i> <span> Log Out </span> </a>
                                </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End