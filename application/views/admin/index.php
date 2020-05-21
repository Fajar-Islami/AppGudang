<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <!-- Pendapatan Harian -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success h-auto shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Stok Barang </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stok ?> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info h-auto shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Supplier Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $supplier ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-people-carry fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-auto shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $admin ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-user-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary h-auto shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Jumlah User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user1 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->