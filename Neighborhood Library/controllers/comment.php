<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {

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

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index($id)
    {
        if (!$this->session->userdata('logged_in')) {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $name = 0;
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $name = $this->session->userdata('id');
            $data['user_type'] = $this->session->userdata('type');
        }

        $this->form_validation->set_rules('comment', 'Comment', 'required|max_length[200]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('header', $data);
            $this->load->view('error', $data);
        }
        else
        {
            $comment = $this->input->post('comment');

            $datadb = array(
                'post_id' => $id ,
                'author' => $name ,
                'comment' => $comment
            );

            $this->db->insert('blogcomments', $datadb);

            $this->load->view('header', $data);
            $this->load->view('success', $data);
        }

    }
}