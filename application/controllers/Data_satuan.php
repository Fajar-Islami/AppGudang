<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_satuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_satuan_model');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_satuan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_satuan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_satuan/index.html';
            $config['first_url'] = base_url() . 'data_satuan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_satuan_model->total_rows($q);
        $data_satuan = $this->Data_satuan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_satuan_data' => $data_satuan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Barang';
        $data['submenu'] = 'Satuan Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_satuan/data_satuan_list', $data);
        $this->load->view('templates/footer');
    }

    public function read($id)
    {
        $row = $this->Data_satuan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'Id_Satuan' => $row->Id_Satuan,
                'Nama_Satuan' => $row->Nama_Satuan,
            );
            $data['title'] = 'Barang';
            $data['submenu'] = 'Satuan Barang';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_satuan/data_satuan_read', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_satuan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_satuan/create_action'),
            'Id_Satuan' => set_value('Id_Satuan'),
            'Nama_Satuan' => set_value('Nama_Satuan'),
        );
        $data['title'] = 'Barang';
        $data['submenu'] = 'Satuan Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_satuan/data_satuan_form', $data);
        $this->load->view('templates/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'Nama_Satuan' => $this->input->post('Nama_Satuan', TRUE),
            );

            $this->Data_satuan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_satuan'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_satuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_satuan/update_action'),
                'Id_Satuan' => set_value('Id_Satuan', $row->Id_Satuan),
                'Nama_Satuan' => set_value('Nama_Satuan', $row->Nama_Satuan),
            );
            $data['title'] = 'Barang';
            $data['submenu'] = 'Satuan Barang';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_satuan/data_satuan_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_satuan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Satuan', TRUE));
        } else {
            $data = array(
                'Nama_Satuan' => $this->input->post('Nama_Satuan', TRUE),
            );

            $this->Data_satuan_model->update($this->input->post('Id_Satuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_satuan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_satuan_model->get_by_id($id);

        if ($row) {
            $this->Data_satuan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_satuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_satuan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('Nama_Satuan', 'nama satuan', 'trim|required');

        $this->form_validation->set_rules('Id_Satuan', 'Id_Satuan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_satuan.xls";
        $judul = "data_satuan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Satuan");

        foreach ($this->Data_satuan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->Nama_Satuan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_satuan.doc");

        $data = array(
            'data_satuan_data' => $this->Data_satuan_model->get_all(),
            'start' => 0
        );

        $this->load->view('data_satuan/data_satuan_doc', $data);
    }
}

/* End of file Data_satuan.php */
/* Location: ./application/controllers/Data_satuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-01 06:50:24 */
/* http://harviacode.com */
