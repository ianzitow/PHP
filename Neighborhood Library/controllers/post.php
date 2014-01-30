<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

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
            $this->load->view('login', $data);
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $data['user_type'] = $this->session->userdata('type');
            $query = $this->db->get('blogcategories');
            $data['categories'] = $query->result();
            $this->load->view('header', $data);
            $this->load->view('new_post', $data);
        }
    }

    public function submit() {

        if (!$this->session->userdata('logged_in')) {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('login', $data);
        } else {
            $this->form_validation->set_rules('booktitle', 'Book Title', 'required|max_length[100]');
            $this->form_validation->set_rules('posttitle', 'Post Title', 'required|max_length[100]');
            $this->form_validation->set_rules('userpost', 'Your Post', 'required|max_length[1000]');

            if ($this->form_validation->run() == FALSE)
            {
                $data['logged_in'] = TRUE;
                $data['user'] = $this->session->userdata('userid');
                $data['user_type'] = $this->session->userdata('type');
                $query = $this->db->get('blogcategories');
                $data['categories'] = $query->result();
                $this->load->view('header', $data);
                $this->load->view('new_post', $data);
            }
            else
            {
                $booktitle = $this->input->post('booktitle');
                $posttitle = $this->input->post('posttitle');
                $category = $this->input->post('category');
                $userpost = $this->input->post('userpost');

                $data = array(
                    'author' => $this->session->userdata('id') ,
                    'post_title' => $posttitle ,
                    'book_title' => $booktitle ,
                    'post' => $userpost ,
                    'type' => $category
                );

                $this->db->insert('blogposts', $data);

                $data['logged_in'] = TRUE;
                $data['user'] = $this->session->userdata('userid');
                $data['user_type'] = $this->session->userdata('type');
                $this->load->view('header', $data);
                $this->load->view('success', $data);
            }
        }
    }

    public function edit($id) {
        if (!$this->session->userdata('logged_in')) {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('login', $data);
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $data['user_type'] = $this->session->userdata('type');

            $post = $this->db->where('post_id', $id)->get('blogposts');
            $post = $post->row();

            if(($this->session->userdata('type') == 'admin') || ($this->session->userdata('id') == $post->author)) {
                $data['booktitle'] = $post->book_title;
                $data['posttitle'] = $post->post_title;
                $data['type'] = $post->type;
                $data['userpost'] = $post->post;
                $data['id'] = $id;

                $categories = $this->db->order_by("id", "asc")->get('blogcategories');
                $categories = $categories->result();
                $data['categories'] = $categories;
                $this->load->view('header', $data);
                $this->load->view('edit_post', $data);
            } else {
                $this->load->view('header', $data);
                $this->load->view('error');
            }
        }
    }

    public function update($id) {
        if (!$this->session->userdata('logged_in')) {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('login', $data);
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $data['user_type'] = $this->session->userdata('type');

            $post = $this->db->where('post_id', $id)->get('blogposts');
            $post = $post->row();

            if(($this->session->userdata('type') == 'admin') || ($this->session->userdata('id') == $post->author)) {
                $booktitle = $this->input->post('booktitle');
                $posttitle = $this->input->post('posttitle');
                $category = $this->input->post('category');
                $userpost = $this->input->post('userpost');

                $datadb = array(
                    'post_title' => $posttitle ,
                    'book_title' => $booktitle ,
                    'post' => $userpost ,
                    'type' => $category
                );

                $this->db->where('post_id', $id)->update('blogposts', $datadb);
                $this->load->view('header', $data);
                $this->load->view('success', $data);
            } else {
                $this->load->view('header', $data);
                $this->load->view('error');
            }
            }
    }

    public function delete($id) {
        if (!$this->session->userdata('logged_in')) {
            $data['logged_in'] = FALSE;
            $data['user_type'] = 0;
            $this->load->view('header', $data);
            $this->load->view('login', $data);
        } else {
            $data['logged_in'] = TRUE;
            $data['user'] = $this->session->userdata('userid');
            $data['user_type'] = $this->session->userdata('type');

            $post = $this->db->where('post_id', $id)->get('blogposts');
            $post = $post->row();

            if(($this->session->userdata('type') == 'admin') || ($this->session->userdata('id') == $post->author)) {

                $this->db->delete('blogposts', array('post_id' => $id));
                $this->load->view('header', $data);
                $this->load->view('success', $data);
            } else {
                $this->load->view('header', $data);
                $this->load->view('error');
            }
        }
    }
}