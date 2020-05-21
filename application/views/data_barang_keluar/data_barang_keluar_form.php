<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data barang keluar <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="int">Id User <?php echo form_error('Id_User') ?></label>
                    <input type="text" readonly class="form-control" name="Id_User" id="Id_User" placeholder="Id User" value="<?php echo ($this->session->userdata('user')); ?>" />
                </div>

                <div class="form-group">
                    <label for="int">Nama Barang <?php echo form_error('Id_Barang') ?></label>
                    <!-- <input type="text" class="form-control" name="Id_Barang" id="Id_Barang" placeholder="Id Barang" value="<?php echo $Id_Barang; ?>" /> -->

                    <select name="Id_Barang" id="Id_Barang" class="custom-select">
                        <option value="" selected disabled>Pilih Barang</option>
                        <?php foreach ($barang as $b) : ?>
                            <option <?= set_select('Id_Barang', $b['Id_Barang']) ?> value="<?= $b['Id_Barang']; ?>"><?= $b['Nama_Barang']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="int">Jumlah Keluar <?php echo form_error('Jumlah_Keluar') ?></label>
                    <input type="text" class="form-control" name="Jumlah_Keluar" id="Jumlah_Keluar" placeholder="Jumlah Keluar" value="<?php echo $Jumlah_Keluar; ?>" />
                </div>
                <!-- 
                <div class="form-group">
                    <label for="date">Tanggal Keluar <?php echo form_error('Tanggal_Keluar') ?></label>
                    <input type="text" class="form-control" name="Tanggal_Keluar" id="Tanggal_Keluar" placeholder="Tanggal Keluar" value="<?php echo $Tanggal_Keluar; ?>" />
                </div> -->

                <div class="form-group">
                    <label for="date">Tanggal Masuk <?php echo form_error('Tanggal_Keluar') ?></label>
                    <?php
                    if ($button <> "Update") :
                    ?>
                        <input type="text" readonly class="form-control" name="Tanggal_Keluar" id="Tanggal_Keluar" placeholder="Id User" value="<?php echo (date('Y-m-d')); ?>" />
                    <?php else : ?>
                        <input disabled type="text" class="form-control" name="Tanggal_Keluar" id="Tanggal_Keluar" placeholder="Tanggal Buat" value="<?php echo $Tanggal_Keluar; ?>" />
                    <?php endif ?>
                </div>

                <input type="hidden" name="Id_Barang_Keluar" value="<?php echo $Id_Barang_Keluar; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('data_barang_keluar') ?>" class="btn btn-default">Cancel</a>
            </form>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->