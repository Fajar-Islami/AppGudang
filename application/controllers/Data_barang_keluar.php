<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_barang_keluar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_barang_keluar_model');
        $this->load->library('form_validation');
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_barang_keluar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_barang_keluar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_barang_keluar/index.html';
            $config['first_url'] = base_url() . 'data_barang_keluar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_barang_keluar_model->total_rows($q);
        $data_barang_keluar = $this->Data_barang_keluar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_barang_keluar_data' => $data_barang_keluar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Barang Keluar';
        $data['submenu'] = '';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_barang_keluar/data_barang_keluar_list', $data);
        $this->load->view('templates/footer');
    }

    public function read($id)
    {
        $row = $this->Data_barang_keluar_model->get_by_id($id);
        if ($row) {
            $data = array(
                'Id_Barang_Keluar' => $row->Id_Barang_Keluar,
                'Id_User' => $row->Id_User,
                'Id_Barang' => $row->Id_Barang,
                'Jumlah_Keluar' => $row->Jumlah_Keluar,
                'Tanggal_Keluar' => $row->Tanggal_Keluar,
            );
            $data['title'] = 'Barang Keluar';
            $data['submenu'] = '';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_barang_keluar/data_barang_keluar_read', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang_keluar'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_barang_keluar/create_action'),
            'Id_Barang_Keluar' => set_value('Id_Barang_Keluar'),
            'Id_User' => set_value('Id_User'),
            'Id_Barang' => set_value('Id_Barang'),
            'Jumlah_Keluar' => set_value('Jumlah_Keluar'),
            'Tanggal_Keluar' => set_value('Tanggal_Keluar'),
        );
        $data['barang'] = $this->admin->getTabel('data_barang');
        $data['title'] = 'Barang Keluar';
        $data['submenu'] = '';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_barang_keluar/data_barang_keluar_form', $data);
        $this->load->view('templates/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'Id_User' => $this->input->post('Id_User', TRUE),
                'Id_Barang' => $this->input->post('Id_Barang', TRUE),
                'Jumlah_Keluar' => $this->input->post('Jumlah_Keluar', TRUE),
                'Tanggal_Keluar' => $this->input->post('Tanggal_Keluar', TRUE),
            );

            $this->Data_barang_keluar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_barang_keluar'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_barang_keluar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_barang_keluar/update_action'),
                'Id_Barang_Keluar' => set_value('Id_Barang_Keluar', $row->Id_Barang_Keluar),
                'Id_User' => set_value('Id_User', $row->Id_User),
                'Id_Barang' => set_value('Id_Barang', $row->Id_Barang),
                'Jumlah_Keluar' => set_value('Jumlah_Keluar', $row->Jumlah_Keluar),
                'Tanggal_Keluar' => set_value('Tanggal_Keluar', $row->Tanggal_Keluar),
            );
            $data['barang'] = $this->admin->getTabel('data_barang');
            $data['title'] = 'Barang Keluar';
            $data['submenu'] = '';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_barang_keluar/data_barang_keluar_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang_keluar'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Barang_Keluar', TRUE));
        } else {
            $data = array(
                'Id_User' => $this->input->post('Id_User', TRUE),
                'Id_Barang' => $this->input->post('Id_Barang', TRUE),
                'Jumlah_Keluar' => $this->input->post('Jumlah_Keluar', TRUE),
                'Tanggal_Keluar' => $this->input->post('Tanggal_Keluar', TRUE),
            );

            $this->Data_barang_keluar_model->update($this->input->post('Id_Barang_Keluar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_barang_keluar'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_barang_keluar_model->get_by_id($id);

        if ($row) {
            $this->Data_barang_keluar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_barang_keluar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang_keluar'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('Id_User', 'id user', 'trim|required');
        $this->form_validation->set_rules('Id_Barang', 'id barang', 'trim|required');
        $this->form_validation->set_rules('Jumlah_Keluar', 'jumlah keluar', 'trim|required');
        $this->form_validation->set_rules('Tanggal_Keluar', 'tanggal keluar', 'trim|required');

        $this->form_validation->set_rules('Id_Barang_Keluar', 'Id_Barang_Keluar', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_barang_keluar.xls";
        $judul = "data_barang_keluar";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id User");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Keluar");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Keluar");

        foreach ($this->Data_barang_keluar_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->Id_User);
            xlsWriteNumber($tablebody, $kolombody++, $data->Id_Barang);
            xlsWriteNumber($tablebody, $kolombody++, $data->Jumlah_Keluar);
            xlsWriteLabel($tablebody, $kolombody++, $data->Tanggal_Keluar);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_barang_keluar.doc");

        $data = array(
            'data_barang_keluar_data' => $this->Data_barang_keluar_model->get_all(),
            'start' => 0
        );
        $data['title'] = 'Barang Keluar';
        $data['submenu'] = '';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('data_barang_keluar/data_barang_keluar_doc', $data);
        // $this->load->view('templates/footer');
    }
}

/* End of file Data_barang_keluar.php */
/* Location: ./application/controllers/Data_barang_keluar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-01 06:50:23 */
/* http://harviacode.com */
