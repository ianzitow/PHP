<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->helper("url");
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
	public function index($type = 1, $page = 0)
	{
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_userdata('logged_in', FALSE);
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
        } else {
            $data['logged_in'] = TRUE;
            $data['user_type'] = $this->session->userdata('type');
            $data['user'] = $this->session->userdata('userid');
        }

        $categories = $this->db->order_by("id", "asc")->get('blogcategories');
        $categories = $categories->result();

        $authors = $this->db->order_by("id", "asc")->get('blogusers');
        $authors = $authors->result();

        $data['categories'] = $categories;
        $data['authors'] = $authors;

        $limit = 5;

        $offset = $page;

        $query = $this->db->query("SELECT * FROM blogposts WHERE type = \"".$type."\" ORDER BY date_published DESC LIMIT ". $offset*$limit . "," . $limit);

        $num = $this->db->get_where('blogposts', array('type' => $type))->num_rows();
        $data['pages'] = ceil($num / $limit);

        $data['posts'] = $query->result();
        $data['type'] = $type;
        $data['cur_page'] = $page;

        $this->load->view('header', $data);
        $this->load->view('welcome_message', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */