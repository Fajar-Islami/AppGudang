<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    public function konvertSatuan($a)
    {
        foreach ($a as $row) {
            $b = $row;
        }
        return $b;
    }

    /////// Dashboard///////
    // hitung jumlah barang
    public function jumlahBarang($tabel, $kolom)
    {
        $this->db->select_sum($kolom);
        return  $this->db->get($tabel)->row();
    }

    // hitung jumlah user/admin/supplier
    public function jumlah($tabel, $where = false, $status = false)
    {
        if ($where || $status) {
            $this->db->where($where, $status);
        }
        $this->db->from($tabel);
        return  $this->db->count_all_results();
    }

    /////// Data Barang///////
    // Ambil data
    public function getTabel($tabel)
    {
        return $this->db->get($tabel)->result_array();
    }

    public function getJoinTabel()
    {
        $this->db->join('data_satuan b', 'a.Satuan_Id = b.Id_Satuan');
        $this->db->join('data_jenis c', 'a.Jenis_Id = c.Id_Jenis');
        // $this->db->order_by('jam_mulai');
        return $this->db->get('data_barang a')->result_array();
    }

    public function baris($tabel, $kolom, $isi, $select = null)
    {
        if ($select) {
            $this->db->select($select);
        }
        $this->db->where($kolom, $isi);
        return $this->db->get($tabel)->row();
    }
}
