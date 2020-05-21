<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data supplier Read</h2>
            <table class="table">
                <tr>
                    <td>Nama Supplier</td>
                    <td><?php echo $Nama_Supplier; ?></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><?php echo $No_Telepon; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?php echo $Alamat; ?></td>
                </tr>
                <tr>
                    <td>Id Jenis</td>
                    <td>
                        <?php
                        echo $this->admin->konvertSatuan($this->admin->baris('data_jenis', 'id_jenis',  $Id_Jenis))
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="<?php echo site_url('data_supplier') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->