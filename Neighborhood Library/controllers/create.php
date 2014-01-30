<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('create_account');
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $data['user_type'] = $this->session->userdata('type');
            $this->load->view('header', $data);
            $this->load->view('error', $data);
        }
    }

    public function submit() {

        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[blogusers.email]|max_length[50]');
        $this->form_validation->set_rules('userid', 'User ID', 'required|is_unique[blogusers.userID]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('create_account');
        }
        else
        {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $userid = $this->input->post('userid');
            $password = $this->input->post('password');
            $password = $this->encrypt->sha1($password);

            $data = array(
                'firstname' => $firstname ,
                'lastname' => $lastname ,
                'email'     => $email ,
                'userID' => $userid ,
                'password' => $password ,
                'type' => 'author'
            );

            $this->db->insert('blogusers', $data);

            $data = array();
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('success');
        }


    }
}