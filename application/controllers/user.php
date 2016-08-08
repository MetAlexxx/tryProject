<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function gotoLogin(){
    if(!isset($_SESSION['username'])){
        $str = 'location: '.base_url();
        header($str);
    }  
}

class User extends CI_Controller {

	 function index()
	{
        gotoLogin();
        $this->load->model('admin_model');
		$data['books'] = $this->admin_model->get_last_books();
        
        $this->load->view('userMain_view',$data);
	}
    
    /////////////////////////////////////////Authors////////////////////////////////////////////////////////

    public function authors()
	{
        gotoLogin();
        
        $config['base_url'] = base_url().'index.php/user/authors';
        $config['total_rows'] = $this->db->count_all('T_authors');
        $config['per_page'] = '10'; 
        $this->pagination->initialize($config);
        
        $this->load->model('admin_model');
		$data['authors'] = $this->admin_model->get_all_authors($config['per_page'],$this->uri->segment(3));
        
        $this->load->view('uAuthors_view',$data);
	}
    
    /////////////////////////////////////////Categories////////////////////////////////////////////////////////

        public function categories()
    {
        gotoLogin();
        
        $config['base_url'] = base_url().'index.php/user/authors';
        $config['total_rows'] = $this->db->count_all('T_categories');
        $config['per_page'] = '10'; 
        $this->pagination->initialize($config);
        
        $this->load->model('admin_model');
        $data['categories'] = $this->admin_model->get_all_categories($config['per_page'],$this->uri->segment(3));
        
        $this->load->view('uCategories_view',$data);
    }
        
    /////////////////////////////////////////Books////////////////////////////////////////////////////////

    public function books()
    {
        gotoLogin();
        
        $config['base_url'] = base_url().'index.php/user/books';
        $config['total_rows'] = $this->db->count_all('T_books');
        $config['per_page'] = '3'; 
        $this->pagination->initialize($config);
        
        $this->load->model('admin_model');
        $data['books'] = $this->admin_model->get_all_books($config['per_page'],$this->uri->segment(3));
        
        $this->load->view('uBooks_view',$data);
    }
    public function SearchBooks()
    {
        gotoLogin();

        if ($this->input->post('str') != ''){
            $newdata = array(
                       'strSearch'  => $this->input->post('str')
                   );
            $this->session->set_userdata($newdata);
        }

        $this->load->model('admin_model');
        
        $config['base_url'] = base_url().'index.php/user/SearchBooks';
        $config['total_rows'] = $this->admin_model->count_books($this->session->userdata('strSearch'), null, null);
        $config['per_page'] = '3'; 
        $this->pagination->initialize($config);    

        $data['books'] = $this->admin_model->search_books(
            $this->session->userdata('strSearch'),
            null, 
            null,
            $config['per_page'],$this->uri->segment(3)
        );        
        $data['searchStr'] = "Книги по запросу: '".$this->session->userdata('strSearch')."'";

        $this->load->view('uBooks_view',$data);
    }
    public function SearchBooksA()
    {
        gotoLogin();

        if ($this->input->post('aID') != ''){
            $newdata = array(
                       'aID'  => $this->input->post('aID')
                   );
            $this->session->set_userdata($newdata);
        }

        $this->load->model('admin_model');

        $config['base_url'] = base_url().'index.php/user/SearchBooksA';
        $config['total_rows'] = $this->admin_model->count_books(null, $this->session->userdata('aID'), null);
        $config['per_page'] = '3'; 
        $this->pagination->initialize($config);    

        $data['books'] = $this->admin_model->search_books(
            null,
            $this->session->userdata('aID'), 
            null,
            $config['per_page'],$this->uri->segment(3)
        );        
        $data['searchStr'] = "Книги по запросу: '".$this->admin_model->get_author_name($this->session->userdata('aID'))."'";

        $this->load->view('uBooks_view',$data);
    }
    public function SearchBooksC()
    {
        gotoLogin();

        if ($this->input->post('cID') != ''){
            $newdata = array(
                       'cID'  => $this->input->post('cID')
                   );
            $this->session->set_userdata($newdata);
        }

        $this->load->model('admin_model');
        
        $config['base_url'] = base_url().'index.php/user/SearchBooksC';
        $config['total_rows'] = $this->admin_model->count_books(null, null, $this->session->userdata('cID'));
        $config['per_page'] = '3'; 
        $this->pagination->initialize($config);    

        $data['books'] = $this->admin_model->search_books(
            null, 
            null, 
            $this->session->userdata('cID'),
            $config['per_page'],$this->uri->segment(3)
        );        
        $data['searchStr'] = "Книги по запросу: '".$this->admin_model->get_category_name($this->session->userdata('cID'))."'";

        $this->load->view('uBooks_view',$data);
    }
    public function pageBooks()
    {
        gotoLogin();

        $this->load->model('admin_model');
        $this->load->model('marks_model');
        $this->load->model('comments_model');

        if(isset($_POST['set_1'])) $uMark = 1;
        if(isset($_POST['set_2'])) $uMark = 2;
        if(isset($_POST['set_3'])) $uMark = 3;
        if(isset($_POST['set_4'])) $uMark = 4;
        if(isset($_POST['set_5'])) $uMark = 5;
        if(isset($uMark)){
            $this->marks_model->set_mark($this->input->post('bID'), $this->session->userdata('uID'), $uMark);
        }
        if(isset($_POST['say'])){
            $this->comments_model->create_comments(
                $this->input->post('bID'), 
                $this->session->userdata('uID'), 
                $this->input->post('cText'));
        }
        $data['book'] = $this->admin_model->get_book_page($this->input->post('bID'));
        $data['mark'] = $this->marks_model->get_mark($this->input->post('bID'));
        $data['uMark'] = $this->marks_model->get_user_mark($this->input->post('bID'), $this->session->userdata('uID'));
        $data['comments'] = $this->comments_model->get_comments($this->input->post('bID'));

        $this->load->view('uPage_book_view',$data);
    }
}
