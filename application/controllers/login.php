<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        if(!isset($_POST['enter'])){
            $this->load->view('login_view');
		}else{
            $this->load->model('login_model');
            $data['error'] = $this->login_model->authorization($this->input->post('login'), $this->input->post('password') );
                   
            $this->load->view('login_view', $data);
		}
        if($this->session->userdata('role')){//user logged in
            if($this->session->userdata('role') == 1){//as user
                $str = 'location: '.base_url().'index.php/user';
                header($str);
            }
            if($this->session->userdata('role') == 2){//as admin
                $str = 'location: '.base_url().'index.php/admin';
                header($str);
            }
        }
	}
}
