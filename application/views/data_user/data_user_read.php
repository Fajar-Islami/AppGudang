<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data user Read</h2>
            <table class="table">
                <tr>
                    <td>Id User</td>
                    <td><?php echo $Id_User; ?></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><?php echo $Password; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Buat</td>
                    <td><?php echo $Tanggal_Buat; ?></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                        <!-- <?php echo $role_id; ?> -->
                        <?php if ($role_id == 1) {
                            echo "Admin";
                        } else {
                            echo "User";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><?php echo $Nama; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="<?php echo site_url('data_user') ?>" class="btn btn-default">Cancel</a></td>
                </tr>
            </table>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->