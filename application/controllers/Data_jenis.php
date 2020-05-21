<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_jenis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_jenis_model');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_jenis/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_jenis/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_jenis/index.html';
            $config['first_url'] = base_url() . 'data_jenis/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_jenis_model->total_rows($q);
        $data_jenis = $this->Data_jenis_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_jenis_data' => $data_jenis,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Barang';
        $data['submenu'] = 'Jenis Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_jenis/data_jenis_list', $data);
        $this->load->view('templates/footer');
    }

    public function read($id)
    {
        $row = $this->Data_jenis_model->get_by_id($id);
        if ($row) {
            $data = array(
                'Id_Jenis' => $row->Id_Jenis,
                'Nama_Jenis' => $row->Nama_Jenis,
            );
            $data['title'] = 'Barang';
            $data['submenu'] = 'Jenis Barang';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_jenis/data_jenis_read', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_jenis'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_jenis/create_action'),
            'Id_Jenis' => set_value('Id_Jenis'),
            'Nama_Jenis' => set_value('Nama_Jenis'),
        );
        $data['title'] = 'Barang';
        $data['submenu'] = 'Jenis Barang';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_jenis/data_jenis_form', $data);
        $this->load->view('templates/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'Nama_Jenis' => $this->input->post('Nama_Jenis', TRUE),
            );

            $this->Data_jenis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_jenis'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_jenis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_jenis/update_action'),
                'Id_Jenis' => set_value('Id_Jenis', $row->Id_Jenis),
                'Nama_Jenis' => set_value('Nama_Jenis', $row->Nama_Jenis),
            );
            $data['title'] = 'Barang';
            $data['submenu'] = 'Jenis Barang';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_jenis/data_jenis_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_jenis'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_Jenis', TRUE));
        } else {
            $data = array(
                'Nama_Jenis' => $this->input->post('Nama_Jenis', TRUE),
            );

            $this->Data_jenis_model->update($this->input->post('Id_Jenis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_jenis'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_jenis_model->get_by_id($id);

        if ($row) {
            $this->Data_jenis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_jenis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_jenis'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('Nama_Jenis', 'nama jenis', 'trim|required');

        $this->form_validation->set_rules('Id_Jenis', 'Id_Jenis', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_jenis.xls";
        $judul = "data_jenis";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Jenis");

        foreach ($this->Data_jenis_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->Nama_Jenis);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_jenis.doc");

        $data = array(
            'data_jenis_data' => $this->Data_jenis_model->get_all(),
            'start' => 0
        );

        $this->load->view('data_jenis/data_jenis_doc', $data);
    }
}

/* End of file Data_jenis.php */
/* Location: ./application/controllers/Data_jenis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-01 06:50:24 */
/* http://harviacode.com */
