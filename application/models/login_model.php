<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function authorization($login, $password)
	{
    $this->load->library('encrypt');

		$query = $this->db->query("SELECT * FROM T_users WHERE username='$login'");
		$answer = $query->result_array();
    if($answer){
      $password2 = $this->encrypt->decode($answer[0]['password']);     
      if($password2 == $password){
        $newdata = array(
                   'username'  => $answer[0]['username'],
                   'role'     => $answer[0]['uRole'],
                   'uID' =>  $answer[0]['uID']
               );
        
        $this->session->set_userdata($newdata);
        $message = "Вход выполнен!";
      }else{
        $message = "Неверно введены логин или пароль!";
      }
      return $message;
    }
	}
}
?>