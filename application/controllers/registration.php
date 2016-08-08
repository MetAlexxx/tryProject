<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function index()
	{
        if(!isset($_POST['enter'])){
			$this->load->view('registration_view');
		}else{
			$this->load->model('registration_model');
			
			$this->load->helper('email');

			if (valid_email($this->input->post('login'))){
				$data['error'] = $this->registration_model->registration(
					$this->input->post('login'),
					$this->input->post('password1'), 
					$this->input->post('password2') 
				);
			}else{
				$data['error'] = ' email не верен';
			}
			
			$this->load->view('registration_view', $data);
		}
	}
}