<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function index()
    {
        $this->session->sess_destroy();
        $data['logged_in'] = FALSE;
        $data['user_type'] = 0;
        $this->load->view('header', $data);
        $this->load->view('login', $data);
    }
}