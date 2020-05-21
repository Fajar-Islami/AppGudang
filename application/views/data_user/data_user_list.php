<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">List Data user</h2>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php echo anchor(site_url('data_user/create'), 'Create', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('data_user/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                                <?php
                                if ($q <> '') {
                                ?>
                                    <a href="<?php echo site_url('data_user'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Id User</th>
                    <th>Password</th>
                    <th>Tanggal Buat</th>
                    <th>Role</th>
                    <th>Nama</th>
                    <th>Action</th>
                </tr><?php
                        foreach ($data_user_data as $data_user) {
                        ?>
                    <tr>
                        <td width="80px"><?php echo ++$start ?></td>
                        <td><?php echo $data_user->Id_User ?></td>
                        <td><?php echo $data_user->Password ?></td>
                        <td><?php echo $data_user->Tanggal_Buat ?></td>
                        <td><?php if ($data_user->role_id == 1) {
                                echo "Admin";
                            } else {
                                echo "User";
                            }
                            ?></td>
                        <td><?php echo $data_user->Nama ?></td>
                        <td style="text-align:center" width="200px">
                            <?php
                            echo anchor(site_url('data_user/read/' . $data_user->Id_User), 'Read');
                            echo ' | ';
                            echo anchor(site_url('data_user/update/' . $data_user->Id_User), 'Update');
                            echo ' | ';
                            echo anchor(site_url('data_user/delete/' . $data_user->Id_User), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
                    <?php echo anchor(site_url('data_user/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('data_user/word'), 'Word', 'class="btn btn-primary"'); ?>
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