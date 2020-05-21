<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-fw fa-warehouse"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Gudang <sup>CI</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Dashboard -->
    <li <?php if ($title == "Dashboard") echo "class='nav-item active'";
        else echo  "class='nav-item'" ?>>
        <a class="nav-link pb-0" href="<?= base_url('admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <li <?php if ($title == "Barang") echo "class='nav-item active'";
        else echo  "class='nav-item'" ?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Barang</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data Barang:</h6>
                <a <?php if ($submenu == "Data Barang") echo "class='collapse-item active'";
                    else echo  "class='collapse-item'" ?> href="<?= base_url('data_barang') ?>">Data Barang</a>
                <a <?php if ($submenu == "Satuan Barang") echo "class='collapse-item active'";
                    else echo  "class='collapse-item'" ?> href="<?= base_url('data_satuan') ?>">Satuan Barang</a>
                <a <?php if ($submenu == "Jenis Barang") echo "class='collapse-item active'";
                    else echo  "class='collapse-item'" ?> href="<?= base_url('data_jenis') ?>">Jenis Barang</a>
                <a <?php if ($submenu == "Supplier Barang") echo "class='collapse-item active'";
                    else echo  "class='collapse-item'" ?> href="<?= base_url('data_supplier') ?>">Supplier Barang</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Charts -->
    <li <?php if ($title == "Barang Masuk") echo "class='nav-item active'";
        else echo  "class='nav-item'" ?>>
        <a class="nav-link pb-0" href="<?= base_url('data_barang_masuk') ?>">
            <i class="fas fa-fw fa-dolly"></i>
            <span>Barang Masuk</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li <?php if ($title == "Barang Keluar") echo "class='nav-item active'";
        else echo  "class='nav-item'" ?>>
        <a class="nav-link" href="<?= base_url('data_barang_keluar') ?>">
            <i class="fas fa-fw fa-dolly fa-flip-horizontal "></i>
            <span>Barang Keluar</span></a>
    </li>


    <?php
    $role = $this->session->userdata('role_id');
    if ($role == 1) :
    ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            User Management
        </div>

        <!-- Nav Item - Charts -->
        <li <?php if ($title == "User Management") echo "class='nav-item active'";
            else echo  "class='nav-item'" ?>>
            <a class="nav-link" href="<?= base_url('data_user') ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>User Management</span></a>
        </li>


    <?php endif ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none mb-0 d-md-block">
    <!-- Nav Item - Charts -->
    <li <?php if ($title == "Beranda") echo "class='nav-item active'";
        else echo  "class='nav-item'" ?>>
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Keluar</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->