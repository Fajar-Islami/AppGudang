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
        <h2>Data_user List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Password</th>
		<th>Tanggal Buat</th>
		<th>Role Id</th>
		<th>Nama</th>
		
            </tr><?php
            foreach ($data_user_data as $data_user)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_user->Password ?></td>
		      <td><?php echo $data_user->Tanggal_Buat ?></td>
		      <td><?php echo $data_user->role_id ?></td>
		      <td><?php echo $data_user->Nama ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>