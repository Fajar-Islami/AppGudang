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
        <h2>Data_supplier List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Supplier</th>
		<th>No Telepon</th>
		<th>Alamat</th>
		<th>Id Jenis</th>
		
            </tr><?php
            foreach ($data_supplier_data as $data_supplier)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_supplier->Nama_Supplier ?></td>
		      <td><?php echo $data_supplier->No_Telepon ?></td>
		      <td><?php echo $data_supplier->Alamat ?></td>
		      <td><?php echo $data_supplier->Id_Jenis ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>