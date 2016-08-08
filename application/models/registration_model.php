<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model {

	public function registration($login, $password1, $password2)
	{	
		if($password1 == $password2){
            $query = $this->db->query("SELECT * FROM T_users WHERE username='$login'");
    		$answer = $query->result_array();
            
            if($answer){
               $message = "Введенный Email уже зарегистрирован ранее!";
            }else{
                $this->load->library('encrypt');
                $password1 = $this->encrypt->encode($password1);
                
                $query = $this->db->query("INSERT INTO T_users (username, password, uRole) VALUES ('$login','$password1',1)");
                $message = "Регистрация выполнена успешно!";
            }
        }else{
            $message = 'Пароли не совпадают!';
        }
        return $message;
	}
}
?>