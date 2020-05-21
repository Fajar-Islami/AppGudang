<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Data_barang_masuk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id User</th>
		<th>Id Barang</th>
		<th>Jumlah Masuk</th>
		<th>Tanggal Masuk</th>
		
            </tr><?php
            foreach ($data_barang_masuk_data as $data_barang_masuk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_barang_masuk->Id_User ?></td>
		      <td><?php echo $data_barang_masuk->Id_Barang ?></td>
		      <td><?php echo $data_barang_masuk->Jumlah_Masuk ?></td>
		      <td><?php echo $data_barang_masuk->Tanggal_Masuk ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>