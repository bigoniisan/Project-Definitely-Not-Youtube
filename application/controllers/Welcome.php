<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('main_model');
		$this->load->helper('form');
		$this->load->library('session');
	}

	public function index() {
		$this->load_page('homepage');
	}

	public function login() {
		$this->load_page('login');
	}

	public function signup() {
		$this->load_page('signup');
	}

	public function upload() {
		$this->load_page('upload');
	}

	public function reset_password() {
		$this->load_page('reset_password');
	}

	public function my_account() {
		$this->load_page('my_account');
	}

	public function homepage() {
		$this->load_page('homepage');
	}

	public function load_page($view) {
		$this->load->view('stylesheets/stylesheet');
		if ($this->session->userdata('username') != '') {
			$this->load->view('templates/navbar_logged_in');
		} else {
			$this->load->view('templates/navbar_logged_out');
		}
		$this->load->view($view);
		$this->load->view('templates/footer');
	}

	public function login_validation() {
		$this->load->library('form_validation');
		// set validation library rules, username + password not empty
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run()) {
			// form rules validated
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			// model function
			$this->load->model('main_model');
			if ($this->main_model->can_login($username, $password)) {
				// login info correct
				$session_data = array(
					'username' => $username
				);
				$this->session->set_userdata($session_data);
				redirect(base_url() . 'welcome/enter');
			} else {
				// login info incorrect
				$this->session->set_flashdata('error', 'Invalid username and password');
				redirect(base_url() . 'welcome/login');
			}
		} else {
			// form rules not validated
			$this->login();
		}
	}

	// after login redirect to this page
	public function enter() {
		if ($this->session->userdata('username') != '') {
			// session variable is same as current user
			echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';
			$this->load_page('homepage');
		} else {
			// session variable is not same as current user
			redirect(base_url() . 'welcome/login');
		}
	}

	public function logout() {
		$this->session->unset_userdata('username');
		redirect(base_url() . 'welcome/login');
	}

	public function signup_validation() {
		$this->load->library('form_validation');
		// set validation library rules, username + password not empty
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run()) {
			// form rules validated
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			// model function
			$this->load->model('main_model');
			if ($this->main_model->user_exists($username) == true) {
				// user exists
				$this->session->set_flashdata('error', 'Username already taken');
				redirect(base_url() . 'welcome/login');
			} else {
				// user does not exist
				$this->main_model->insert_user($username, $password);
				$session_data = array(
					'username' => $username
				);
				$this->session->set_userdata($session_data);
				redirect(base_url() . 'welcome/enter');
			}
		}
	}
}
