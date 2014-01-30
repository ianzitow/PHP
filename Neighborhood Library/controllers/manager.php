<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_userdata('logged_in', FALSE);
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $data['id'] = 0;
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $data['id'] = $this->session->userdata('id');
            $data['user_type'] = $this->session->userdata('type');
        }

        if ($data['user_type'] === "admin") {
            $query = $this->db->select('userID, id, firstname, lastname, access')->get('blogusers');
            $data['users'] = $query->result();

            $this->load->view('header', $data);
            $this->load->view('manager', $data);
        } else {
            $this->load->view('header', $data);
            $this->load->view('error', $data);
        }
    }

    public function deny($id) {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_userdata('logged_in', FALSE);
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $data['id'] = 0;
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $data['id'] = $this->session->userdata('id');
            $data['user_type'] = $this->session->userdata('type');
        }

        if ($data['user_type'] === "admin") {
            $datadb = array(
                'access' => "denied"
            );

            $this->db->where('id', $id);
            $this->db->update('blogusers', $datadb);

            $this->load->view('header', $data);
            $this->load->view('success', $data);
        } else {
            $this->load->view('header', $data);
            $this->load->view('error', $data);
        }
    }

    public function grant($id) {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_userdata('logged_in', FALSE);
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $data['id'] = 0;
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $data['id'] = $this->session->userdata('id');
            $data['user_type'] = $this->session->userdata('type');
        }

        if ($data['user_type'] === "admin") {
            $datadb = array(
                'access' => "granted"
            );

            $this->db->where('id', $id);
            $this->db->update('blogusers', $datadb);

            $this->load->view('header', $data);
            $this->load->view('success', $data);
        } else {
            $this->load->view('header', $data);
            $this->load->view('error', $data);
        }
    }
}