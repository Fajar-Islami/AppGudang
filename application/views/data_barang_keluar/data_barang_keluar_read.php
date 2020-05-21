<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data barang keluar Read</h2>
            <table class="table">
                <tr>
                    <td>Id User</td>
                    <td><?php echo $Id_User; ?></td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>
                        <!-- <?php echo $Id_Barang; ?> -->
                        <?php
                        echo $this->admin->konvertSatuan($this->admin->baris('data_barang', 'id_barang',  $Id_Barang, 'nama_barang'))
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah Keluar</td>
                    <td><?php echo $Jumlah_Keluar; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Keluar</td>
                    <td><?php echo $Tanggal_Keluar; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="<?php echo site_url('data_barang_keluar') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->