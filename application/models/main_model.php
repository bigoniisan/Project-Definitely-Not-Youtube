<?php

class main_model extends CI_Model {

	public function fetch_single_data($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('user');
		return $query;
		// SELECT * FROM user where id = '$id'
	}

	public function update_data($data, $id) {
		$this->db->where('id', $id);
		$this->db-update('user', $data);
		// UPDATE user SET first_name = '$first_name', last_name = '$last_name' WHERE id = '$id'
	}

	public function can_login($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('user');
		// SELECT * FROM user WHERE username = '$username' AND password = '$password'

		if ($query->num_rows() > 0) {
			// entered correct user info
			return true;
		} else {
			// wrong login data
			return false;
		}
	}

	public function user_exists($username) {
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			// user exists
			return true;
		} else {
			// user does not exist
			return false;
		}
	}

	public function insert_user($username, $password) {
		$data = array(
			'username' => $username,
			'password' => $password
		);
		$this->db->insert('user', $data);
	}
}
