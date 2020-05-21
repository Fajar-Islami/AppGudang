<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data_satuan <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">Nama Satuan <?php echo form_error('Nama_Satuan') ?></label>
                    <input type="text" class="form-control" name="Nama_Satuan" id="Nama_Satuan" placeholder="Nama Satuan" value="<?php echo $Nama_Satuan; ?>" />
                </div>
                <input type="hidden" name="Id_Satuan" value="<?php echo $Id_Satuan; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('data_satuan') ?>" class="btn btn-default">Cancel</a>
            </form>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->