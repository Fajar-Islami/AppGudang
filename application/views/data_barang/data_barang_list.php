<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->

            <h2 style="margin-top:0px">List Data Barang</h2>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php echo anchor(site_url('data_barang/create'), 'Create', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('data_barang/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                                <?php
                                if ($q <> '') {
                                ?>
                                    <a href="<?php echo site_url('data_barang'); ?>" class="btn btn-default">Reset</a>
                                <?php
                                }
                                ?>
                                <button class="btn btn-primary" type="submit">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered" style="margin-bottom: 10px">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Jenis</th>
                    <th>User Id</th>
                    <th>Action</th>
                </tr><?php
                        foreach ($data_barang_data as $data_barang) {
                        ?>
                    <tr>
                        <td width="80px"><?php echo ++$start ?></td>
                        <td><?php echo $data_barang->Nama_Barang ?></td>
                        <td><?php echo $data_barang->Stok ?></td>

                        <td>
                            <?php
                            echo $this->admin->konvertSatuan($this->admin->baris('data_satuan', 'id_satuan',  $data_barang->Satuan_Id))
                            ?>
                        </td>

                        <td>
                            <?php
                            echo $this->admin->konvertSatuan($this->admin->baris('data_jenis', 'id_jenis',  $data_barang->Jenis_Id))
                            ?>
                        </td>

                        <td><?php echo $data_barang->user_id ?></td>
                        <td style="text-align:center" width="200px">
                            <?php
                            echo anchor(site_url('data_barang/read/' . $data_barang->Id_Barang), 'Read');
                            echo ' | ';
                            echo anchor(site_url('data_barang/update/' . $data_barang->Id_Barang), 'Update');
                            echo ' | ';
                            echo anchor(site_url('data_barang/delete/' . $data_barang->Id_Barang), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                            ?>
                        </td>
                    </tr>
                <?php
                        }
                ?>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                    <?php echo anchor(site_url('data_barang/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('data_barang/word'), 'Word', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->