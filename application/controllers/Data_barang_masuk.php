<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_barang_masuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_barang_masuk_model');
        $this->load->library('form_validation');
        $this->load->library('form_validation');
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_barang_masuk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_barang_masuk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_barang_masuk/index.html';
            $config['first_url'] = base_url() . 'data_barang_masuk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_barang_masuk_model->total_rows($q);
        $data_barang_masuk = $this->Data_barang_masuk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_barang_masuk_data' => $data_barang_masuk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Barang Masuk';
        $data['submenu'] = '';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_barang_masuk/data_barang_masuk_list', $data);
        $this->load->view('templates/footer');
    }

    public function read($id)
    {
        $row = $this->Data_barang_masuk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'Id_Barang_Masuk' => $row->Id_Barang_Masuk,
                'Id_User' => $row->Id_User,
                'Id_Barang' => $row->Id_Barang,
                'Jumlah_Masuk' => $row->Jumlah_Masuk,
                'Tanggal_Masuk' => $row->Tanggal_Masuk,
            );
            $data['title'] = 'Barang Masuk';
            $data['submenu'] = '';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_barang_masuk/data_barang_masuk_read', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang_masuk'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_barang_masuk/create_action'),
            'Id_Barang_Masuk' => set_value('Id_Barang_Masuk'),
            'Id_User' => set_value('Id_User'),
            'Id_Barang' => set_value('Id_Barang'),
            'Jumlah_Masuk' => set_value('Jumlah_Masuk'),
            'Tanggal_Masuk' => set_value('Tanggal_Masuk'),
        );
        $data['barang'] = $this->admin->getTabel('data_barang');

        $data['title'] = 'Barang Masuk';
        $data['submenu'] = '';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_barang_masuk/data_barang_masuk_form', $data);
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
                'Jumlah_Masuk' => $this->input->post('Jumlah_Masuk', TRUE),
                'Tanggal_Masuk' => $this->input->post('Tanggal_Masuk', TRUE),
            );

            $this->Data_barang_masuk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_barang_masuk'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_barang_masuk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_barang_masuk/update_action'),
                'Id_Barang_Masuk' => set_value('Id_Barang_Masuk', $row->Id_Barang_Masuk),
                'Id_User' => set_value('Id_User', $row->Id_User),
                'Id_Barang' => set_value('Id_Barang', $row->Id_Barang),
                'Jumlah_Masuk' => set_value('Jumlah_Masuk', $row->Jumlah_Masuk),
                'Tanggal_Masuk' => set_value('Tanggal_Masuk', $row->Tanggal_Masuk),
            );
            $data['barang'] = $this->admin->getTabel('data_barang');

            $data['title'] = 'Barang Masuk';
            $data['submenu'] = '';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_barang_masuk/data_barang_masuk_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang_masuk'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Barang_Masuk', TRUE));
        } else {
            $data = array(
                'Id_User' => $this->input->post('Id_User', TRUE),
                'Id_Barang' => $this->input->post('Id_Barang', TRUE),
                'Jumlah_Masuk' => $this->input->post('Jumlah_Masuk', TRUE),
                'Tanggal_Masuk' => $this->input->post('Tanggal_Masuk', TRUE),
            );

            $this->Data_barang_masuk_model->update($this->input->post('Id_Barang_Masuk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_barang_masuk'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_barang_masuk_model->get_by_id($id);

        if ($row) {
            $this->Data_barang_masuk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_barang_masuk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_barang_masuk'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('Id_User', 'id user', 'trim|required');
        $this->form_validation->set_rules('Id_Barang', 'id barang', 'trim|required');
        $this->form_validation->set_rules('Jumlah_Masuk', 'jumlah masuk', 'trim|required');
        $this->form_validation->set_rules('Tanggal_Masuk', 'tanggal masuk', 'trim|required');

        $this->form_validation->set_rules('Id_Barang_Masuk', 'Id_Barang_Masuk', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_barang_masuk.xls";
        $judul = "data_barang_masuk";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Masuk");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Masuk");

        foreach ($this->Data_barang_masuk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->Id_User);
            xlsWriteNumber($tablebody, $kolombody++, $data->Id_Barang);
            xlsWriteNumber($tablebody, $kolombody++, $data->Jumlah_Masuk);
            xlsWriteLabel($tablebody, $kolombody++, $data->Tanggal_Masuk);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_barang_masuk.doc");

        $data = array(
            'data_barang_masuk_data' => $this->Data_barang_masuk_model->get_all(),
            'start' => 0
        );

        $this->load->view('data_barang_masuk/data_barang_masuk_doc', $data);
    }
}

/* End of file Data_barang_masuk.php */
/* Location: ./application/controllers/Data_barang_masuk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-02 17:22:17 */
/* http://harviacode.com */
