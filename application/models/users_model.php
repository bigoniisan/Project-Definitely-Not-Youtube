<?php


class Users_model extends CI_Model
{
	public function insert_user($username, $password) {
		$data = array(
			'username' => $username,
			'password' => $password
		);
		$this->db->insert('User', $data);
	}

	public function get_user($username) {
		$sql = "SELECT * FROM user WHERE username = ?";
		$query = $this->db->query($sql, array($username));
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function verify_user($username, $password) {
//		$sql = "SELECT count(1) FROM user WHERE username = $username AND password = $password";
		$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
		$query = $this->db->query($sql, array($username, $password));
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

}
