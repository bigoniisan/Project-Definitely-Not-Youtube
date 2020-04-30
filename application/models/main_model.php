<?php

class main_model extends CI_Model {

	public function fetch_single_data($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query;
		// SELECT * FROM user where id = '$id'
	}

	public function update_user($user_id, $data) {
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data);
	}

	public function can_login($login, $password) {
		$this->db->where('email', $login);
		$this->db->where('password', $password);
//		$result = $this->db->query("SELECT * FROM users WHERE email = '$login' AND password = '$password'");
		$query = $this->db->get('users');
		// SELECT * FROM user WHERE username = '$username' AND password = '$password'

		if ($query->num_rows() > 0) {
			// entered correct user info
			return true;
		} else {
			// wrong login data
			return false;
		}
	}

	public function user_exists($login) {
		$this->db->where('email', $login);
		$query = $this->db->get('users');
//		$result = $this->db->query("SELECT * FROM users WHERE email = '$login'");
		if ($query->num_rows() > 0) {
			// user exists
			return true;
		} else {
			// user does not exist
			return false;
		}
	}

	public function insert_user(
		$user_id,
		$email,
		$password,
		$name,
//		$last_name,
		$birthday
	) {
		$data = array(
			'user_id' => $user_id,
			'email' => $email,
			'password' => $password,
			'name' => $name,
//			'last_name' => $last_name,
			'birthday' => $birthday
		);
		$this->db->insert('users', $data);
	}

	public function get_users_length() {
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function get_user($login, $password) {
		$this->db->where('email', $login);
		$this->db->where('password', $password);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			// return false if user does not exist
			return false;
		}
	}
}
