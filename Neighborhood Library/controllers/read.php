<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Read extends CI_Controller {

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
    public function index($id)
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

        $query = $this->db->query("SELECT * FROM blogposts WHERE post_id = \"".$id."\"");
        $data['post'] = $query->row();

        $authors = $this->db->order_by("id", "asc")->get('blogusers');
        $authors = $authors->result();
        $data['authors'] = $authors;

        $comments = $this->db->query("SELECT * FROM blogcomments WHERE post_id = \"".$id."\" ORDER BY date_published DESC");

        $data['comments'] = $comments->result();
        $this->load->view('header', $data);
        $this->load->view('view_post', $data);
    }
}