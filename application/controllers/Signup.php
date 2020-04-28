<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('users_model');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->view('stylesheets/stylesheet');
		$this->load->view('templates/header');
		$this->load->view('signup');
		$this->load->view('templates/footer');
	}

	public function submit() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// check if form is null
		if ($username != NULL && $password != NULL) {
			// check password strength if length > 4
			if (strlen($password) > 4) {
				// check if user already exists
				if ($this->users_model->get_user($username) == false) {
					$this->users_model->insert_user($username, $password);
					$this->load_view('homepage');
				} else {
					$this->load_view('signup');
					print_r("Username already taken");
				}
			} else {
				$this->load_view('signup');
				print_r("Password must be at least 4 characters");
			}
		} else {
			$this->load_view('signup');
			print_r("Password must not be null");
		}
	}

	public function load_view($view) {
		$this->load->view('stylesheets/stylesheet');
		$this->load->view('templates/header');
		$this->load->view($view);
		$this->load->view('templates/footer');
	}
}
