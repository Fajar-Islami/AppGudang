<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->

            <body>
                <h2 style="margin-top:0px">Data barang Read</h2>
                <table class="table">
                    <tr>
                        <td>Nama Barang</td>
                        <td><?php echo $Nama_Barang; ?></td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td><?php echo $Stok; ?></td>
                    </tr>
                    <tr>
                        <td>Satuan Id</td>
                        <td>
                            <?php
                            echo $this->admin->konvertSatuan($this->admin->baris('data_satuan', 'id_satuan',  $Satuan_Id))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Id</td>
                        <td>
                            <?php
                            echo $this->admin->konvertSatuan($this->admin->baris('data_jenis', 'id_jenis',  $Jenis_Id))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>User Id</td>
                        <td><?php echo $user_id; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo site_url('data_barang') ?>" class="btn btn-default">Cancel</a></td>
                    </tr>
                </table>
                <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->