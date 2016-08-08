<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
        if(session_destroy()) // Destroying All Sessions
        {
            header('Location: '.base_url()); // Redirecting To Home Page
        }
	}
}