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
		if ($this->session->userdata('email') != '') {
			$this->load->view('templates/navbar_logged_in');
		} else {
			$this->load->view('templates/navbar_logged_out');
		}
		$this->load->view($view);
		$this->load->view('templates/footer');
	}

	public function login_validation() {
		$this->load->library('form_validation');
//		// set validation library rules, username + password not empty
		if ($this->form_validation->run('login')) {
			// form rules validated
			$form_submit = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);
			// model function
			$this->load->model('main_model');

			$user = $this->main_model->get_user($form_submit['email'], $form_submit['password']);
			if ($user == false) {
				// username or password not in database
				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect(base_url() . 'welcome/login');
			} else {
				// username and password in database
				foreach ($user as $value) {
					$session_data = array(
						'user_id' => $value['user_id'],
						'email' => $value['email'],
						'password' => $value['password'],
						'first_name' => $value['first_name'],
						'last_name' => $value['last_name'],
						'birthday' => $value['birthday']
					);
				}
				$this->session->set_userdata($session_data);
				$this->load_page('homepage');
			}
		} else {
			// form rules not validated
			$this->session->set_flashdata('error', 'Error with login');
			redirect(base_url(). 'welcome/login');
		}
	}

	public function logout() {
		$this->session->unset_userdata('email');
		redirect(base_url() . 'welcome/login');
	}

	public function signup_validation() {
		$this->load->library('form_validation');
//		 set validation library rules in \config\form_validation.php
		if ($this->form_validation->run('signup')) {
			// form rules validated
			$data = array(
				'user_id' => $this->main_model->get_users_length() + 1,
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'first_name' => $this->input->post('first-name'),
				'last_name' => $this->input->post('last-name'),
				'birthday' => $this->input->post('birthday')
			);
			// model function
			$this->load->model('main_model');
			if ($this->main_model->user_exists($data['email'])) {
				// email exists
				$this->session->set_flashdata('error', 'Email already taken');
				redirect(base_url() . 'welcome/signup');
			} else {
				// user does not exist
				$this->main_model->insert_user(
					$data['user_id'],
					$data['email'],
					$data['password'],
					$data['first_name'],
					$data['last_name'],
					$data['birthday']
				);
				$session_data = array(
					'user_id' => $data['user_id'],
					'email' => $data['email'],
					'first_name' => $data['first_name'],
					'last_name' => $data['last_name'],
					'birthday' => $data['birthday']
				);
				$this->session->set_userdata($session_data);
				$this->load_page('homepage');
			}
		} else {
			// form rules not validated
			$this->session->set_flashdata('error', 'First Name and Last Name should only consist of 
				alphabetic characters');
			redirect(base_url(). 'welcome/signup');
		}
	}
}
