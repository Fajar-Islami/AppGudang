<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data barang masuk <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">Id User <?php echo form_error('Id_User') ?></label>
                    <input type="text" readonly class="form-control" name="Id_User" id="Id_User" placeholder="Id User" value="<?php echo ($this->session->userdata('user')); ?>" />
                </div>

                <div class="form-group">
                    <label for="int">Id Barang <?php echo form_error('Id_Barang') ?></label>
                    <!-- <input type="text" class="form-control" name="Id_Barang" id="Id_Barang" placeholder="Id Barang" value="<?php echo $Id_Barang; ?>" /> -->

                    <select name="Id_Barang" id="Id_Barang" class="custom-select">
                        <option value="" selected disabled>Pilih Barang</option>
                        <?php foreach ($barang as $b) : ?>
                            <option <?= set_select('Id_Barang', $b['Id_Barang']) ?> value="<?= $b['Id_Barang']; ?>"><?= $b['Nama_Barang']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="int">Jumlah Masuk <?php echo form_error('Jumlah_Masuk') ?></label>
                    <input type="text" class="form-control" name="Jumlah_Masuk" id="Jumlah_Masuk" placeholder="Jumlah Masuk" value="<?php echo $Jumlah_Masuk; ?>" />
                </div>

                <div class="form-group">
                    <label for="date">Tanggal Masuk <?php echo form_error('Tanggal_Masuk') ?></label>
                    <!-- <input type="text" class="form-control" name="Tanggal_Masuk" id="Tanggal_Masuk" placeholder="Tanggal Masuk" value="<?php echo $Tanggal_Masuk; ?>" /> -->
                    <!-- <div class="form-group"> -->
                    <?php
                    if ($button <> "Update") :
                    ?>
                        <input type="text" readonly class="form-control" name="Tanggal_Masuk" id="Tanggal_Masuk" placeholder="Id User" value="<?php echo (date('Y-m-d')); ?>" />

                    <?php else : ?>

                        <input disabled type="text" class="form-control" name="Tanggal_Masuk" id="Tanggal_Masuk" placeholder="Tanggal Buat" value="<?php echo $Tanggal_Masuk; ?>" />

                    <?php endif ?>
                    <!-- </div> -->
                </div>

                <input type="hidden" name="Id_Barang_Masuk" value="<?php echo $Id_Barang_Masuk; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('data_barang_masuk') ?>" class="btn btn-default">Cancel</a>
            </form>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->