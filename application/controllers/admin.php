<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function gotoLogin(){
    if(!isset($_SESSION['username']) || $_SESSION['role'] != 2){
        $str = 'location: '.base_url();
        header($str);
    }      
}

class Admin extends CI_Controller {

	 function index()
	{
        gotoLogin();
        $this->load->model('admin_model');
		$data['books'] = $this->admin_model->get_last_books();
        
        $this->load->view('adminMain_view',$data);
	}
    
    /////////////////////////////////////////Authors////////////////////////////////////////////////////////

    public function authors()
	{
        gotoLogin();
        
        $config['base_url'] = base_url().'index.php/admin/authors';
        $config['total_rows'] = $this->db->count_all('T_authors');
        $config['per_page'] = '10'; 
        $this->pagination->initialize($config);
        
        $this->load->model('admin_model');
		$data['authors'] = $this->admin_model->get_all_authors($config['per_page'],$this->uri->segment(3));
        
        $this->load->view('authors_view',$data);
	}
    public function delA()
	{
        gotoLogin();
        $this->load->model('admin_model');
		$this->admin_model->del_authors($this->input->post('aID'));
        
        $str = 'location: '.base_url().'index.php/admin/authors';
        header($str);        
	}
     public function add_authors()
	{
        gotoLogin(); 
               
        if($this->input->post('name')){
            $this->load->model('admin_model');
    		$data['error'] = $this->admin_model->add_authors($this->input->post('name'));
            $this->load->view('add_authors_view',$data);
        }else{  
            $this->load->view('add_authors_view'); 
        }
	}

    /////////////////////////////////////////Categories////////////////////////////////////////////////////////

        public function categories()
    {
        gotoLogin();
        
        $config['base_url'] = base_url().'index.php/admin/authors';
        $config['total_rows'] = $this->db->count_all('T_categories');
        $config['per_page'] = '10'; 
        $this->pagination->initialize($config);
        
        $this->load->model('admin_model');
        $data['categories'] = $this->admin_model->get_all_categories($config['per_page'],$this->uri->segment(3));
        
        $this->load->view('categories_view',$data);
    }
    public function delCat()
    {
        gotoLogin();
        $this->load->model('admin_model');
        $this->admin_model->del_categories($this->input->post('catID'));
        
        $str = 'location: '.base_url().'index.php/admin/categories';
        header($str);        
    }
     public function add_categories()
    {
        gotoLogin(); 
               
        if($this->input->post('name')){
            $this->load->model('admin_model');
            $data['error'] = $this->admin_model->add_categories($this->input->post('name'));
            $this->load->view('add_categories_view',$data);
        }else{  
            $this->load->view('add_categories_view'); 
        }
    }
    
    /////////////////////////////////////////Books////////////////////////////////////////////////////////

    public function books()
    {
        gotoLogin();
        
        $config['base_url'] = base_url().'index.php/admin/books';
        $config['total_rows'] = $this->db->count_all('T_books');
        $config['per_page'] = '3'; 
        $this->pagination->initialize($config);
        
        $this->load->model('admin_model');
        $data['books'] = $this->admin_model->get_all_books($config['per_page'],$this->uri->segment(3));
        
        $this->load->view('books_view',$data);
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
        
        $config['base_url'] = base_url().'index.php/admin/SearchBooks';
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

        $this->load->view('books_view',$data);
    }
    public function delBooks()
    {
        gotoLogin();
        $this->load->model('admin_model');
        $this->admin_model->del_books($this->input->post('bID'));
        
        $str = 'location: '.base_url().'index.php/admin/books';
        header($str);        
    }
     public function add_books()
    {
        gotoLogin(); 
               
        if($this->input->post()){
            $this->load->model('admin_model');
            $data['error'] = $this->admin_model->add_books(
                $this->input->post('bName'), $this->input->post('catID'),
                $this->input->post('aID'), $this->input->post('year'),
                $this->input->post('source'));
            
            $data['categories'] = $this->admin_model->get_all_categories(NULL,NULL);
            $data['authors'] = $this->admin_model->get_all_authors(NULL,NULL);
            
            $this->load->view('add_books_view',$data);
        }else{  
            $this->load->model('admin_model');
            $data['categories'] = $this->admin_model->get_all_categories(NULL,NULL);
            $data['authors'] = $this->admin_model->get_all_authors(NULL,NULL);
            
            $this->load->view('add_books_view',$data); 
        }
    }
    public function editBooks()
    {
        gotoLogin(); 
               
        if(isset($_POST['enter'])){
            $this->load->model('admin_model');
            $data['error'] = $this->admin_model->edit_books(
                $this->input->post('bID'), $this->input->post('bName'),
                $this->input->post('catID'), $this->input->post('aID'),
                $this->input->post('year'), $this->input->post('source'));

            $str = 'location: '.base_url().'index.php/admin/books';
            header($str);  
        }else{  
            $this->load->model('admin_model');
            $data['categories'] = $this->admin_model->get_all_categories(NULL,NULL);
            $data['authors'] = $this->admin_model->get_all_authors(NULL,NULL);
            $data['book'] = $this->admin_model->get_book($this->input->post('bID'));
            
            $this->load->view('edit_books_view',$data); 
        }
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
        if(isset($_POST['delCom'])){
            $this->comments_model->del_comments($this->input->post('cID'));
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

        $this->load->view('page_book_view',$data);
    }

    /////////////////////////////////////////Upload////////////////////////////////////////////////////////

    public function addCover()
    {
        gotoLogin(); 
               
        if(isset($_POST['enter'])){
            $config['upload_path'] = './covers';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['encrypt_name'] = TRUE;
            
            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $dataF = $this->upload->data();
            $cover = 'covers/'.$dataF['file_name'];

            $this->load->model('admin_model');
            $data['error'] = $this->admin_model->upload_cover_books($this->input->post('bID'), $cover);
            $data['bID'] = $this->input->post('bID');

            $this->load->view('upload_cover_books_view',$data);                         
        }else{ 
            $data['bID'] = $this->input->post('bID');
            $this->load->view('upload_cover_books_view',$data); 
        }
    }
    public function addFile()
    {
        gotoLogin(); 
               
        if($this->input->post()){
            $config['upload_path'] = './files';
            $config['allowed_types'] = 'doc|docx|pdf|djv|txt|odt';
            $config['max_size'] = '40000';
            $config['encrypt_name'] = TRUE;
            
            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $dataF = $this->upload->data();
            $file = 'files/'.$dataF['file_name'];

            $this->load->model('admin_model');
            $data['error'] = $this->admin_model->upload_file_books($this->input->post('bID'), $file);
            $data['bID'] = $this->input->post('bID');

            $this->load->view('upload_file_books_view',$data);                         
        }else{ 
            $data['bID'] = $this->input->post('bID');
            $this->load->view('upload_file_books_view',$data); 
        }
    }
}
