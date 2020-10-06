<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public function tambahUser()
	{
		$data = [
			'username' => html_escape($this->input->post('username', true)),
			'password' => html_escape(password_hash($this->input->post('password1', true), PASSWORD_DEFAULT)),
			'role' => 2
		];

		$this->db->insert('users', $data);
	}

}