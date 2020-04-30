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
		$this->load->helper('cookie');
	}

	public function index() {
		$this->load_header();
		$this->load->view('homepage', array(
			'error' => '',
			'image' => ''
		));
	}

	public function login() {
		$this->load_header();
		$this->load->view('login', array(
			'error' => '',
			'image' => ''
		));
	}

	public function signup() {
		$this->load_header();
		$this->load->view('signup', array(
			'error' => '',
			'image' => ''
		));
	}

	public function upload() {
		$this->load_header();
		$this->load->view('upload', array(
			'error' => '',
			'image' => ''
		));
	}

	public function reset_password() {
		$this->load_header();
		$this->load->view('reset_password', array(
			'error' => '',
			'image' => ''
		));
	}

	public function my_account() {
		$this->load_header();
		$this->load->view('my_account', array(
			'error' => '',
			'image' => ''
		));
	}

	public function image_upload() {
		$this->load_header();
		$this->load->view('image_upload', array(
			'error' => '',
			'image' => ''
		));
	}

	public function homepage() {
		$this->load_header();
		$this->load->view('homepage');
	}

	public function load_header() {
		$this->load->view('stylesheets/stylesheet');
		if ($this->session->userdata('email') != '') {
			$this->load->view('templates/navbar_logged_in');
		} else {
			$this->load->view('templates/navbar_logged_out');
		}
	}

//	public function load_page($view) {
//		$this->load->view('stylesheets/stylesheet');
//		if ($this->session->userdata('email') != '') {
//			$this->load->view('templates/navbar_logged_in');
//		} else {
//			$this->load->view('templates/navbar_logged_out');
//		}
//		$this->load->view($view, array(
//			'error' => '',
//			'image' => ''
//		));
//	}

//	public function load_page_error($view, $error) {
//		$this->load->view('stylesheets/stylesheet');
//		if ($this->session->userdata('email') != '') {
//			$this->load->view('templates/navbar_logged_in');
//		} else {
//			$this->load->view('templates/navbar_logged_out');
//		}
//		$this->load->view($view, $error);
//	}

	// skip login in cookies exist
	public function user_login() {
		// if cookies exist
		if ($this->input->cookie('email') != '' && $this->input->cookie('password') != '') {
			redirect('welcome/homepage');
		} else {
			$this->login_validation();
		}
	}

	public function login_validation() {
		$this->load->library('form_validation');
//		// set validation library rules, username + password not empty
		if ($this->form_validation->run('login')) {

			// form rules validated
			$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'remember-me' => $this->input->post('remember-me')
			);
			// model function
			$this->load->model('main_model');

			// get user from db
			$user = $this->main_model->get_user($data['email'], $data['password']);

			if ($user == false) {
				// username or password not in database
				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect(base_url() . 'welcome/login');
			} else {
				// username and password in database

				// check if user wants to store login info
				if ($data['remember-me']) {
					$this->input->set_cookie('email', $data['email']);
					$this->input->set_cookie('password', $data['password']);
				} else {
					delete_cookie('email');
					delete_cookie('password');
				}

				// get details from user in db and store as session data
				foreach ($user as $value) {
					$session_data = array(
						'user_id' => $value['user_id'],
						'email' => $value['email'],
						'password' => $value['password'],
						'name' => $value['name'],
//						'last_name' => $value['last_name'],
						'birthday' => $value['birthday']
					);
				}
				$this->session->set_userdata($session_data);
				$this->load_header();
				$this->load->view('homepage', array(
					'error' => '',
					'image' => ''
				));
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
				'name' => $this->input->post('name'),
//				'last_name' => $this->input->post('last-name'),
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
					$data['name'],
//					$data['last_name'],
					$data['birthday']
				);
				$session_data = array(
					'user_id' => $data['user_id'],
					'email' => $data['email'],
					'name' => $data['name'],
//					'last_name' => $data['last_name'],
					'birthday' => $data['birthday']
				);
				$this->session->set_userdata($session_data);
				$this->load_header();
				$this->load->view('homepage', array(
					'error' => '',
					'image' => ''
				));
			}
		} else {
			// form rules not validated
			$this->session->set_flashdata('error', 'Name should only consist of alphabetic characters');
			redirect(base_url() . 'welcome/signup');
		}
	}

	public function change_name() {
		$this->load->model('main_model');
		$user_id = $this->session->userdata('user_id');
		$change_name = $this->input->post('change-name');
		if (preg_match('~[0-9]~', $change_name)) {
			// why doesn't this work?
			$this->session->set_flashdata('error', 'Name should only consist of alphabetic characters');
			redirect(base_url() . 'welcome/my_account');
		} else {
			$data = array(
				'name' => $change_name
			);
			$this->main_model->update_user($user_id, $data);
			$session_data['name'] = $change_name;
			$this->session->set_userdata($session_data);
			redirect(base_url() . 'welcome/my_account');
		}
	}

	public function upload_image() {
		// set destination for uploads
		$config['upload_path'] = './images/uploaded_images';
		// set allowed filetypes to be uploaded
		$config['allowed_types'] = 'jpg|jpeg|gif|png';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()) {
			$error = array(
				'error' => $this->upload->display_errors()
			);
			$this->load_header();
			$this->load->view('image_upload', $error);
		} else {
			$file_data = $this->upload->data();
			$data = array(
				'error' => '',
				'image' => base_url().'/images/uploaded_images/'.$file_data['file_name']
			);
			$this->load_header();
			$this->load->view('image_upload', $data);

//			redirect(base_url() . 'welcome/image_upload');
		}

	}
}
