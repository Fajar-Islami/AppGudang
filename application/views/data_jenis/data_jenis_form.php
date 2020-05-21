<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data jenis <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">Nama Jenis <?php echo form_error('Nama_Jenis') ?></label>
                    <input type="text" class="form-control" name="Nama_Jenis" id="Nama_Jenis" placeholder="Nama Jenis" value="<?php echo $Nama_Jenis; ?>" />
                </div>
                <input type="hidden" name="Id_Jenis" value="<?php echo $Id_Jenis; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('data_jenis') ?>" class="btn btn-default">Cancel</a>
            </form>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->