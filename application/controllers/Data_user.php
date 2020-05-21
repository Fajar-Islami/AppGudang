<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_user_model');
        $this->load->library('form_validation');
        is_logged_in();


        $role = $this->session->userdata('role_id');
        if ($role <> 1) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_user/index.html';
            $config['first_url'] = base_url() . 'data_user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_user_model->total_rows($q);
        $data_user = $this->Data_user_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_user_data' => $data_user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'User Management';
        $data['submenu'] = '';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_user/data_user_list', $data);
        $this->load->view('templates/footer');
    }

    public function read($id)
    {
        $row = $this->Data_user_model->get_by_id($id);
        if ($row) {
            $data = array(
                'Id_User' => $row->Id_User,
                'Password' => $row->Password,
                'Tanggal_Buat' => $row->Tanggal_Buat,
                'role_id' => $row->role_id,
                'Nama' => $row->Nama,
            );
            $data['title'] = 'User Management';
            $data['submenu'] = '';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_user/data_user_read', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_user'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_user/create_action'),
            'Id_User' => set_value('Id_User'),
            'Password' => set_value('Password'),
            'Tanggal_Buat' => set_value('Tanggal_Buat'),
            'role_id' => set_value('role_id'),
            'Nama' => set_value('Nama'),
        );
        $data['title'] = 'User Management';
        $data['submenu'] = '';
        $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_user/data_user_form', $data);
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
                'Password' => $this->input->post('Password', TRUE),
                'Tanggal_Buat' => $this->input->post('Tanggal_Buat', TRUE),
                'role_id' => $this->input->post('role_id', TRUE),
                'Nama' => $this->input->post('Nama', TRUE),
            );

            $this->Data_user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_user'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_user_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_user/update_action'),
                'Id_User' => set_value('Id_User', $row->Id_User),
                'Password' => set_value('Password', $row->Password),
                'Tanggal_Buat' => set_value('Tanggal_Buat', $row->Tanggal_Buat),
                'role_id' => set_value('role_id', $row->role_id),
                'Nama' => set_value('Nama', $row->Nama),
            );
            $data['title'] = 'User Management';
            $data['submenu'] = '';
            $data['user'] = $this->db->get_where('data_User', ['Id_User' => $this->session->userdata('user')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data_user/data_user_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_user'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Id_User', TRUE));
        } else {
            $data = array(
                'Password' => $this->input->post('Password', TRUE),
                'Tanggal_Buat' => $this->input->post('Tanggal_Buat', TRUE),
                'role_id' => $this->input->post('role_id', TRUE),
                'Nama' => $this->input->post('Nama', TRUE),
            );

            $this->Data_user_model->update($this->input->post('Id_User', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_user'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_user_model->get_by_id($id);

        if ($row) {
            $this->Data_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_user'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('Password', 'password', 'trim|required');
        $this->form_validation->set_rules('Tanggal_Buat', 'tanggal buat', 'trim|required');
        $this->form_validation->set_rules('role_id', 'role id', 'trim|required');
        $this->form_validation->set_rules('Nama', 'nama', 'trim|required');

        $this->form_validation->set_rules('Id_User', 'Id_User', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_user.xls";
        $judul = "data_user";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Password");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Buat");
        xlsWriteLabel($tablehead, $kolomhead++, "Role Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");

        foreach ($this->Data_user_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->Password);
            xlsWriteLabel($tablebody, $kolombody++, $data->Tanggal_Buat);
            xlsWriteNumber($tablebody, $kolombody++, $data->role_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->Nama);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_user.doc");

        $data = array(
            'data_user_data' => $this->Data_user_model->get_all(),
            'start' => 0
        );

        $this->load->view('data_user/data_user_doc', $data);
    }
}

/* End of file Data_user.php */
/* Location: ./application/controllers/Data_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-05-01 06:50:24 */
/* http://harviacode.com */
