<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">List Data jenis</h2>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php echo anchor(site_url('data_jenis/create'), 'Create', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('data_jenis/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                                <?php
                                if ($q <> '') {
                                ?>
                                    <a href="<?php echo site_url('data_jenis'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Nama Jenis</th>
                    <th>Action</th>
                </tr><?php
                        foreach ($data_jenis_data as $data_jenis) {
                        ?>
                    <tr>
                        <td width="80px"><?php echo ++$start ?></td>
                        <td><?php echo $data_jenis->Nama_Jenis ?></td>
                        <td style="text-align:center" width="200px">
                            <?php
                            echo anchor(site_url('data_jenis/read/' . $data_jenis->Id_Jenis), 'Read');
                            echo ' | ';
                            echo anchor(site_url('data_jenis/update/' . $data_jenis->Id_Jenis), 'Update');
                            echo ' | ';
                            echo anchor(site_url('data_jenis/delete/' . $data_jenis->Id_Jenis), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
                    <?php echo anchor(site_url('data_jenis/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('data_jenis/word'), 'Word', 'class="btn btn-primary"'); ?>
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