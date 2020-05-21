<!doctype html>
<html>

<head>
    <title>harviacode.com - codeigniter crud generator</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
    <style>
        .word-table {
            border: 1px solid black !important;
            border-collapse: collapse !important;
            width: 100%;
        }

        .word-table tr th,
        .word-table tr td {
            border: 1px solid black !important;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <h2>Data_barang List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Satuan Id</th>
            <th>Jenis Id</th>
            <th>User Id</th>

        </tr><?php
                foreach ($data_barang_data as $data_barang) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $data_barang->Nama_Barang ?></td>
                <td><?php echo $data_barang->Stok ?></td>
                <td><?php echo $data_barang->Satuan_Id ?></td>
                <td><?php echo $data_barang->Jenis_Id ?></td>
                <td><?php echo $data_barang->user_id ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>