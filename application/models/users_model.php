<?php


class users_model extends CI_Model
{
	public function insert_user($username, $password) {
		$data = array(
			'username' => $username,
			'password' => $password
		);

		$this->db->insert('users', $data);
	}

	public function verify_unique_user() {

	}
}
