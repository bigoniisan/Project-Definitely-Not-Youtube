<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->database();
		$this->load->model('users_model');
		$this->load->helper('form');

		$this->load->view('stylesheets/stylesheet');
		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('templates/footer');
	}

	public function submit() {

	}

}
