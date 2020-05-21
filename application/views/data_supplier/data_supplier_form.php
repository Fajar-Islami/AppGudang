<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data supplier <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">Nama Supplier <?php echo form_error('Nama_Supplier') ?></label>
                    <input type="text" class="form-control" name="Nama_Supplier" id="Nama_Supplier" placeholder="Nama Supplier" value="<?php echo $Nama_Supplier; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">No Telepon <?php echo form_error('No_Telepon') ?></label>
                    <input type="text" class="form-control" name="No_Telepon" id="No_Telepon" placeholder="No Telepon" value="<?php echo $No_Telepon; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Alamat <?php echo form_error('Alamat') ?></label>
                    <input type="text" class="form-control" name="Alamat" id="Alamat" placeholder="Alamat" value="<?php echo $Alamat; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Id Jenis <?php echo form_error('Id_Jenis') ?></label>
                    <!-- <input type="text" class="form-control" name="Id_Jenis" id="Id_Jenis" placeholder="Id Jenis" value="<?php echo $Id_Jenis; ?>" /> -->
                    <select name="Jenis_Id" id="Jenis_Id" class="custom-select">
                        <option value="" selected disabled>Pilih Jenis</option>
                        <?php foreach ($jenis as $j) : ?>
                            <option <?= set_select('Jenis_Id', $j['Id_Jenis']) ?> value="<?= $j['Id_Jenis']; ?>"><?= $j['Nama_Jenis']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <input type="hidden" name="Id_Supplier" value="<?php echo $Id_Supplier; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('data_supplier') ?>" class="btn btn-default">Cancel</a>
            </form>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->