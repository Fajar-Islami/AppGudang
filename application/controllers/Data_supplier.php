<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_supplier_model');
        $this->load->library('form_validation');
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_supplier/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_supplier/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_supplier/index.html';
            $config['first_url'] = base_url() . 'data_supplier/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_supplier_model->total_rows($q);
        $data_supplier = $this->Data_supplier_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_supplier_data' => $data_supplier,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Barang';
        $data['submenu'] = 'Supplier Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_supplier/data_supplier_list', $data);
        $this->load->view('templates/footer');
    }

    public function read($id)
    {
        $row = $this->Data_supplier_model->get_by_id($id);
        if ($row) {
            $data = array(
                'Id_Supplier' => $row->Id_Supplier,
                'Nama_Supplier' => $row->Nama_Supplier,
                'No_Telepon' => $row->No_Telepon,
                'Alamat' => $row->Alamat,
                'Id_Jenis' => $row->Id_Jenis,
            );
            $data['title'] = 'Barang';
            $data['submenu'] = 'Supplier Barang';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_supplier/data_supplier_read', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_supplier'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_supplier/create_action'),
            'Id_Supplier' => set_value('Id_Supplier'),
            'Nama_Supplier' => set_value('Nama_Supplier'),
            'No_Telepon' => set_value('No_Telepon'),
            'Alamat' => set_value('Alamat'),
            'Id_Jenis' => set_value('Id_Jenis'),
        );
        $data['jenis'] = $this->admin->getTabel('data_jenis');
        $data['title'] = 'Barang';
        $data['submenu'] = 'Supplier Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_supplier/data_supplier_form', $data);
        $this->load->view('templates/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'Nama_Supplier' => $this->input->post('Nama_Supplier', TRUE),
                'No_Telepon' => $this->input->post('No_Telepon', TRUE),
                'Alamat' => $this->input->post('Alamat', TRUE),
                'Id_Jenis' => $this->input->post('Id_Jenis', TRUE),
            );

            $this->Data_supplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_supplier'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_supplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_supplier/update_action'),
                'Id_Supplier' => set_value('Id_Supplier', $row->Id_Supplier),
                'Nama_Supplier' => set_value('Nama_Supplier', $row->Nama_Supplier),
                'No_Telepon' => set_value('No_Telepon', $row->No_Telepon),
                'Alamat' => set_value('Alamat', $row->Alamat),
                'Id_Jenis' => set_value('Id_Jenis', $row->Id_Jenis),
            );
            $data['jenis'] = $this->admin->getTabel('data_jenis');
            $data['title'] = 'Barang';
            $data['submenu'] = 'Supplier Barang';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_supplier/data_supplier_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_supplier'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Supplier', TRUE));
        } else {
            $data = array(
                'Nama_Supplier' => $this->input->post('Nama_Supplier', TRUE),
                'No_Telepon' => $this->input->post('No_Telepon', TRUE),
                'Alamat' => $this->input->post('Alamat', TRUE),
                'Id_Jenis' => $this->input->post('Id_Jenis', TRUE),
            );

            $this->Data_supplier_model->update($this->input->post('Id_Supplier', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_supplier'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_supplier_model->get_by_id($id);

        if ($row) {
            $this->Data_supplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_supplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_supplier'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('Nama_Supplier', 'nama supplier', 'trim|required');
        $this->form_validation->set_rules('No_Telepon', 'no telepon', 'trim|required');
        $this->form_validation->set_rules('Alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('Id_Jenis', 'id jenis', 'trim|required');

        $this->form_validation->set_rules('Id_Supplier', 'Id_Supplier', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_supplier.xls";
        $judul = "data_supplier";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Supplier");
        xlsWriteLabel($tablehead, $kolomhead++, "No Telepon");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Jenis");

        foreach ($this->Data_supplier_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->Nama_Supplier);
            xlsWriteLabel($tablebody, $kolombody++, $data->No_Telepon);
            xlsWriteLabel($tablebody, $kolombody++, $data->Alamat);
            xlsWriteNumber($tablebody, $kolombody++, $data->Id_Jenis);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_supplier.doc");

        $data = array(
            'data_supplier_data' => $this->Data_supplier_model->get_all(),
            'start' => 0
        );

        $this->load->view('data_supplier/data_supplier_doc', $data);
    }
}

/* End of file Data_supplier.php */
/* Location: ./application/controllers/Data_supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-01 06:50:24 */
/* http://harviacode.com */
