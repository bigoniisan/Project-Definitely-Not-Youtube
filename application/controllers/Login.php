<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->model('users_model');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->view('stylesheets/stylesheet');
		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('templates/footer');
	}

	public function submit() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->users_model->verify_user($username, $password) == false) {
			$this->load_view('login');
			print_r("User does not exist");
		} else {
			$this->load_view('homepage');
			print_r("Login Successful");
		}
	}

	public function load_view($view) {
		$this->load->view('stylesheets/stylesheet');
		$this->load->view('templates/header');
		$this->load->view($view);
		$this->load->view('templates/footer');
	}

}
