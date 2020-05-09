<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('main_model');
		$this->load->helper(array(
			'form',
			'cookie'
		));
		$this->load->library(array(
			'email',
			'session',
			'image_lib'
		));
	}

	public function index() {
		$this->homepage();
	}

	public function login() {
		$this->load_header();
		$this->load->view('login', array(
			'error' => '',
			'file' => ''
		));
	}

	public function signup() {
		$this->load_header();
		$this->load->view('signup', array(
			'error' => '',
			'file' => ''
		));
	}

	public function upload() {
		$this->load_header();
		$this->load->view('upload', array(
			'error' => '',
			'file' => ''
		));
	}

	public function reset_password() {
		$this->load_header();
		$this->load->view('reset_password', array(
			'error' => '',
			'file' => ''
		));
	}

	public function my_account() {
		$this->load_header();
		$this->load->view('my_account', array(
			'error' => '',
			'file' => ''
		));
	}

	public function image_upload() {
		$this->load_header();
		$this->load->view('image_upload', array(
			'error' => '',
			'file' => ''
		));
	}

	public function homepage() {
		$this->load_header();
		$this->load->view('homepage', array(
			'error' => '',
			'file' => '',
			'map' => ''
		));

	}

	public function load_header() {
		$this->load->view('stylesheets/stylesheet');
		if ($this->session->userdata('email') != '') {
			$this->load->view('templates/navbar_logged_in');
		} else {
			$this->load->view('templates/navbar_logged_out');
		}
	}

//public function send_email() {
//		$config = array(
//			'protocol' => 'smtp',
//			'smtp_host' => 'ssl://smtp.googlemail.com',
//			'smpt_port' => '25',
//			'smtp_user' => 'name@gmail.com',
//			'smtp_pass' => 'password',
//			'maintype' => 'html',
//			'starttls' => true,
//			'newline' => "\r\n"
//		);
//		$this->load->library('email', $config);
//
//		$this->email->from('misterimouto@gmail.com', 'MisterImouto');
//		$this->email->to('johngod3@gmail.com');
//		$this->email->subject('Web Information Systems Email Test');
//		$this->email->message('Testing CodeIgniter Email functionality');
//		$this->email->send();
//}

	public function show_calendar() {
		$calendar_prefs = array(
			'show_next_prev' => TRUE,
			'next_prev_url' => 'http://localhost/infs3202/welcome/show_calendar'
		);
		$this->load->library('calendar', $calendar_prefs);
	}

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
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('email', 'Email', 'max_length[20]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password', 'Password', 'min_length[4]');
		if ($this->form_validation->run()) {

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
					print_r($value);
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
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('email', 'Email', 'max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password', 'Password', 'min_length[4]');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('name', 'Name', 'alpha');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');
		if ($this->form_validation->run()) {
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
//			$this->session->set_flashdata('error', 'Error with form input');
//			echo $this->form_validation->display_errors();
//			echo validation_errors();
			redirect(base_url() . 'welcome/signup');
		}
	}

	public function upload_image() {
		// set destination for uploads
		$config['upload_path'] = './uploads';
		// set allowed filetypes to be uploaded
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()) {
			$error = array(
				'error' => $this->upload->display_errors(),
				'file' => ''
			);
			$this->load_header();
			$this->load->view('image_upload', $error);
		} else {
			// returns array containing all data related to uploaded file
			$upload_data = $this->upload->data();
			$data = array(
				'error' => '',
				'file' => base_url().'/uploads/'.$upload_data['file_name']
			);
			$this->load_header();
			$this->load->view('image_upload', $data);
		}
	}

	public function upload_video() {
		// set destination for uploads
		$config['upload_path'] = './uploads';
		// set allowed filetypes to be uploaded
		$config['allowed_types'] = 'mp4';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()) {
			$data = array(
				'error' => $this->upload->display_errors(),
				'file' => ''
			);
			$this->load_header();
			$this->load->view('upload', $data);
		} else {
			// returns array containing all data related to uploaded file
			$upload_data = $this->upload->data();
			$data = array(
				'error' => '',
				'file' => base_url().'/uploads/'.$upload_data['file_name']
			);
			$this->load_header();
			$this->load->view('upload', $data);
		}
	}

	public function change_email() {
		$this->load->model('main_model');
		$user_id = $this->session->userdata('user_id');
		$change_email = $this->input->post('change-email');
		$data = array(
			'email' => $change_email
		);
		$this->main_model->update_user($user_id, $data);
		$session_data['email'] = $change_email;
		$this->session->set_userdata($session_data);
		redirect(base_url() . 'welcome/my_account');
	}

	public function change_name() {
		$this->load->model('main_model');
		$user_id = $this->session->userdata('user_id');
		$change_name = $this->input->post('change-name');
		if (preg_match('~[0-9]~', $change_name)) {
//			// why doesn't this work?
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

	public function change_birthday() {
		$this->load->model('main_model');
		$user_id = $this->session->userdata('user_id');
		$change_birthday = $this->input->post('change-birthday');
		if ($change_birthday > date('Y-m-d')) {
//			// why doesn't this work?
			$this->session->set_flashdata('error', 'Date cannot be after today');
			redirect(base_url() . 'welcome/my_account');
		} else {
			$data = array(
				'birthday' => $change_birthday
			);
			$this->main_model->update_user($user_id, $data);
			$session_data['birthday'] = $change_birthday;
			$this->session->set_userdata($session_data);
			redirect(base_url() . 'welcome/my_account');
		}
	}

//	public function upload_multiple_videos() {
//
//		$data = [];
//
//		$count = count($_FILES['files']['name']);
//
//		for($i=0; $i < $count; $i++) {
//
//			if(!empty($_FILES['files']['name'][$i])) {
//
//				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
//				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
//				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
//				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
//				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
//
//				$config['upload_path'] = 'uploads/';
//				$config['allowed_types'] = 'jpg|jpeg|png|gif';
//				$config['max_size'] = '5000';
//				$config['file_name'] = $_FILES['files']['name'][$i];
//
//				$this->load->library('upload',$config);
//
//				if($this->upload->do_upload('file')){
//					$uploadData = $this->upload->data();
//					$filename = $uploadData['file_name'];
//
//					$data['totalFiles'][] = $filename;
//				}
//			}
//
//		}
//		$this->load->view('upload', $data);
//	}
}
