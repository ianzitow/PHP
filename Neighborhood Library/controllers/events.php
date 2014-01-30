<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
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

        $query = $this->db->get('blogevents');
        $data['events'] = $query->result();

        $query = $this->db->select('id, userID')->get('blogusers');
        $data['users'] = $query->result();

        $this->load->view('header', $data);
        $this->load->view('view_events', $data);
    }

    public function submit() {
        if (!$this->session->userdata('logged_in')) {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('login', $data);
        } else {
            $this->form_validation->set_rules('eventtitle', 'Event Title', 'required|max_length[100]');
            $this->form_validation->set_rules('date', 'Date', 'required|max_length[50]');
            $this->form_validation->set_rules('address', 'Address', 'required|max_length[100]');
            $this->form_validation->set_rules('description', 'Description', 'required|max_length[1000]');

            if ($this->form_validation->run() == FALSE)
            {
                $data['logged_in'] = TRUE;
                $data['user'] = $this->session->userdata('userid');
                $data['user_type'] = $this->session->userdata('type');
                $this->load->view('header', $data);
                $this->load->view('view_events', $data);
            }
            else
            {
                $eventtitle = $this->input->post('eventtitle');
                $date = $this->input->post('date');
                $address = $this->input->post('address');
                $description = $this->input->post('description');

                $data = array(
                    'userid' => $this->session->userdata('id') ,
                    'title' => $eventtitle ,
                    'date' => $date ,
                    'address' => $address ,
                    'description' => $description
                );

                $this->db->insert('blogevents', $data);

                $data['logged_in'] = TRUE;
                $data['user'] = $this->session->userdata('userid');
                $data['user_type'] = $this->session->userdata('type');
                $this->load->view('header', $data);
                $this->load->view('success', $data);
            }
        }
    }
}