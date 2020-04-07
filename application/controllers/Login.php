<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->view('login');
	}

	public function login() {

	}
}
