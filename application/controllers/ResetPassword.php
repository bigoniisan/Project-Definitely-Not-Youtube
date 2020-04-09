<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ResetPassword extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');

		$this->load->view('templates/header');
		$this->load->view('reset_password');
		$this->load->view('templates/footer');
	}
}
