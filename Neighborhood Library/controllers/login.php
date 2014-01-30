<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('userid', 'User ID', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('login');
        }
        else
        {
            $userid = $this->input->post('userid');
            $password = $this->input->post('password');
            $password = $this->encrypt->sha1($password);

            $data = array(
                'userID' => $userid ,
                'password' => $password ,
                'access' => "granted"
            );

            $query = $this->db->get_where('blogusers', $data);

            if ($query->num_rows() > 0) {
                $row = $query->row();

                $data = array(
                    'userid'    => $userid,
                    'type'      => $row->type,
                    'id'        => $row->id,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($data);

                $data['logged_in'] = TRUE;
                $data['user_type'] = $row->type;
                $data['user'] = $userid;
                $this->load->view('header', $data);
                $this->load->view('success', $data);
            } else {
                $data['logged_in'] = FALSE;
                $data['user_type'] = 0;
                $this->load->view('header', $data);
                $this->load->view('error');
            }
        }
    }


}