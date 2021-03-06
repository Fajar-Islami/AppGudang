<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_user_model extends CI_Model
{

    public $table = 'data_user';
    public $id = 'Id_User';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('Id_User', $q);
	$this->db->or_like('Password', $q);
	$this->db->or_like('Tanggal_Buat', $q);
	$this->db->or_like('role_id', $q);
	$this->db->or_like('Nama', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('Id_User', $q);
	$this->db->or_like('Password', $q);
	$this->db->or_like('Tanggal_Buat', $q);
	$this->db->or_like('role_id', $q);
	$this->db->or_like('Nama', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Data_user_model.php */
/* Location: ./application/models/Data_user_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-01 06:50:24 */
/* http://harviacode.com */