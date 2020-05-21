<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_barang_model');
        $this->load->library('form_validation');
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_barang/index.html';
            $config['first_url'] = base_url() . 'data_barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_barang_model->total_rows($q);
        $data_barang = $this->Data_barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_barang_data' => $data_barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['barang'] = $this->admin->getJoinTabel();
        $data['title'] = 'Barang';
        $data['submenu'] = 'Data Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_barang/data_barang_list', $data);
        $this->load->view('templates/footer');
    }

    public function read($id)
    {
        $row = $this->Data_barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'Id_Barang' => $row->Id_Barang,
                'Nama_Barang' => $row->Nama_Barang,
                'Stok' => $row->Stok,
                'Satuan_Id' => $row->Satuan_Id,
                'Jenis_Id' => $row->Jenis_Id,
                'user_id' => $row->user_id,
            );


            $data['title'] = 'Barang';
            $data['submenu'] = 'Data Barang';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_barang/data_barang_read', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_barang/create_action'),
            'Id_Barang' => set_value('Id_Barang'),
            'Nama_Barang' => set_value('Nama_Barang'),
            'Stok' => set_value('Stok'),
            'Satuan_Id' => set_value('Satuan_Id'),
            'Jenis_Id' => set_value('Jenis_Id'),
            'user_id' => set_value('user_id'),
        );
        $data['satuan'] = $this->admin->getTabel('data_satuan');
        $data['jenis'] = $this->admin->getTabel('data_jenis');

        $data['title'] = 'Barang';
        $data['submenu'] = 'Data Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_barang/data_barang_form', $data);
        $this->load->view('templates/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'Nama_Barang' => $this->input->post('Nama_Barang', TRUE),
                'Stok' => $this->input->post('Stok', TRUE),
                'Satuan_Id' => $this->input->post('Satuan_Id', TRUE),
                'Jenis_Id' => $this->input->post('Jenis_Id', TRUE),
                'user_id' => $this->input->post('user_id', TRUE),
            );

            $this->Data_barang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_barang'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_barang/update_action'),
                'Id_Barang' => set_value('Id_Barang', $row->Id_Barang),
                'Nama_Barang' => set_value('Nama_Barang', $row->Nama_Barang),
                'Stok' => set_value('Stok', $row->Stok),
                'Satuan_Id' => set_value('Satuan_Id', $row->Satuan_Id),
                'Jenis_Id' => set_value('Jenis_Id', $row->Jenis_Id),
                'user_id' => set_value('user_id', $row->user_id),
            );
            $data['satuan'] = $this->admin->getTabel('data_satuan');
            $data['jenis'] = $this->admin->getTabel('data_jenis');

            $data['title'] = 'Barang';
            $data['submenu'] = 'Data Barang';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_barang/data_barang_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Barang', TRUE));
        } else {
            $data = array(
                'Nama_Barang' => $this->input->post('Nama_Barang', TRUE),
                'Stok' => $this->input->post('Stok', TRUE),
                'Satuan_Id' => $this->input->post('Satuan_Id', TRUE),
                'Jenis_Id' => $this->input->post('Jenis_Id', TRUE),
                'user_id' => $this->input->post('user_id', TRUE),
            );

            $this->Data_barang_model->update($this->input->post('Id_Barang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_barang'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_barang_model->get_by_id($id);

        if ($row) {
            $this->Data_barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('Nama_Barang', 'nama barang', 'trim|required');
        $this->form_validation->set_rules('Stok', 'stok', 'trim|required');
        $this->form_validation->set_rules('Satuan_Id', 'satuan id', 'trim|required');
        $this->form_validation->set_rules('Jenis_Id', 'jenis id', 'trim|required');
        $this->form_validation->set_rules('user_id', 'user id', 'trim|required');

        $this->form_validation->set_rules('Id_Barang', 'Id_Barang', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_barang.xls";
        $judul = "data_barang";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Stok");
        xlsWriteLabel($tablehead, $kolomhead++, "Satuan Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Id");
        xlsWriteLabel($tablehead, $kolomhead++, "User Id");

        foreach ($this->Data_barang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->Nama_Barang);
            xlsWriteNumber($tablebody, $kolombody++, $data->Stok);
            xlsWriteNumber($tablebody, $kolombody++, $data->Satuan_Id);
            xlsWriteNumber($tablebody, $kolombody++, $data->Jenis_Id);
            xlsWriteLabel($tablebody, $kolombody++, $data->user_id);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_barang.doc");

        $data = array(
            'data_barang_data' => $this->Data_barang_model->get_all(),
            'start' => 0
        );
        $data['title'] = 'Barang';
        $data['submenu'] = 'Data Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('data_barang/data_barang_doc', $data);
        // $this->load->view('templates/footer');
    }
}

/* End of file Data_barang.php */
/* Location: ./application/controllers/Data_barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-01 06:50:23 */
/* http://harviacode.com */
