<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $submenu ?></h1>

    <div class="card p-2 shadow-sm border-bottom-primary">
        <div class="card-body">

            <!-- HarviaCode -->
            <h2 style="margin-top:0px">Data barang <?php echo $button ?></h2>
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="varchar">Nama Barang <?php echo form_error('Nama_Barang') ?></label>
                    <input type="text" class="form-control" name="Nama_Barang" id="Nama_Barang" placeholder="Nama Barang" value="<?php echo $Nama_Barang; ?>" />
                </div>


                <!-- <div class="form-group">
                    <label for="int">Stok <?php echo form_error('Stok') ?></label>
                    <input type="text" class="form-control" name="Stok" id="Stok" placeholder="Stok" value="<?php echo $Stok; ?>" />
                </div> -->
                <div class="form-group">
                    <label for="int">Satuan Id <?php echo form_error('Satuan_Id') ?></label>
                    <!-- <input type="text" class="form-control" name="Satuan_Id" id="Satuan_Id" placeholder="Satuan Id" value="<?php echo $Satuan_Id; ?>" /> -->

                    <select name="Satuan_Id" id="Satuan_Id" class="custom-select">
                        <option value="" selected disabled>Pilih Jenis</option>
                        <?php foreach ($satuan as $s) : ?>
                            <option <?= set_select('Satuan_Id', $s['Id_Satuan']) ?> value="<?= $s['Id_Satuan']; ?>"><?= $s['Nama_Satuan']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="int">Jenis Id <?php echo form_error('Jenis_Id') ?></label>
                    <!-- <input type="text" class="form-control" name="Jenis_Id" id="Jenis_Id" placeholder="Jenis Id" value="<?php echo $Jenis_Id; ?>" /> -->

                    <select name="Jenis_Id" id="Jenis_Id" class="custom-select">
                        <option value="" selected disabled>Pilih Jenis</option>
                        <?php foreach ($jenis as $j) : ?>
                            <option <?= set_select('Jenis_Id', $j['Id_Jenis']) ?> value="<?= $j['Id_Jenis']; ?>"><?= $j['Nama_Jenis']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <label for="varchar">User Id <?php echo form_error('user_id') ?></label>
                    <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
                </div> -->

                <?php
                if ($button <> "Update") :
                ?>
                    <input type="hidden" name="Stok" value=0 />
                <?php else : ?>
                    <input type="hidden" name="Stok" value="<?php echo $Stok; ?>" />
                <?php endif ?>

                <input type="hidden" name="Id_Barang" value="<?php echo $Id_Barang; ?>" />
                <input type="hidden" name="user_id" value="<?php echo ($this->session->userdata('user')); ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('data_barang') ?>" class="btn btn-default">Cancel</a>
            </form>
            <!-- HarviaCode -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->