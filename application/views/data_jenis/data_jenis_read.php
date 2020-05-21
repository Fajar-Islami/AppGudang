<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data jenis Read</h2>
            <table class="table">
                <tr>
                    <td>Nama Jenis</td>
                    <td><?php echo $Nama_Jenis; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="<?php echo site_url('data_jenis') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->