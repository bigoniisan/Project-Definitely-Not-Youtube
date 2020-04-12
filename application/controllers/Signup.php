<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function index()
	{
		$this->load->database();
		$this->load->model('users_model');
		$this->load->helper('form');

		$this->load->view('stylesheets/stylesheet');
		$this->load->view('templates/header');
		$this->load->view('signup');
		$this->load->view('templates/footer');
	}

	public function submit() {
		$this->load->database();
		$this->load->model('users_model');
		$this->load->helper('form');

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($username != NULL && $password != NULL) {
			$this->users_model->insert_user($username, $password);
		}
	}
}
