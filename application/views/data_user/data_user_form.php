<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data User <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">Id User <?php echo form_error('Id_User') ?></label>
                    <?php
                    if ($button <> "Update") :
                    ?>
                        <input type="text" class="form-control" name="Id_User" id="Id_User" placeholder="Id User" value="<?php echo $Id_User; ?>" />
                    <?php else : ?>
                        <input readonly type="text" class="form-control" name="Id_User" id="Id_User" placeholder="Id User" value="<?php echo $Id_User; ?>" />
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="varchar">Password <?php echo form_error('Password') ?></label>
                    <input type="text" class="form-control" name="Password" id="Password" placeholder="Password" value="<?php echo $Password; ?>" />
                </div>

                <div class="form-group">
                    <label for="date">Tanggal Buat <?php echo form_error('Tanggal_Buat') ?></label>
                    <?php
                    if ($button <> "Update") :
                    ?>
                        <input type="text" readonly class="form-control" name="Tanggal_Buat" id="Tanggal_Buat" placeholder="Id User" value="<?php echo (date('Y-m-d')); ?>" />
                    <?php else : ?>
                        <input disabled type="text" class="form-control" name="Tanggal_Buat" id="Tanggal_Buat" placeholder="Tanggal Buat" value="<?php echo $Tanggal_Buat; ?>" />
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="int">Role Id <?php echo form_error('role_id') ?></label>
                    <!-- <input type="text" class="form-control" name="role_id" id="role_id" placeholder="Role Id" value="<?php echo $role_id; ?>" /> -->
                    <select name="role_id" id="role_id" class="form-control">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="varchar">Nama <?php echo form_error('Nama') ?></label>
                    <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama" value="<?php echo $Nama; ?>" />
                </div>

                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('data_user') ?>" class="btn btn-default">Cancel</a>
            </form>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->