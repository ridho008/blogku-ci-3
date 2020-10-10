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


	// --------------TAMU----------------
	public function tambahDataTamu()
	{
		// Insert Data Users
		$dataUser = [
			'username' => html_escape($this->input->post('username', true)),
			'password' => html_escape(password_hash($this->input->post('password1', true), PASSWORD_DEFAULT)),
			'role' => 3,
			'status' => 1
		];

		$this->db->insert('users', $dataUser);
		$data = $this->db->get_where('users', $dataUser)->row_array();

		// Insert Data Tamu
		$dataTamu = [
			'id_user' => $data['id_user'],
			'nama_tamu' => html_escape($this->input->post('nama', true)),
			'tgl_daftar' => date('Y-m-d'),
			'status' => 1
		];

		$this->db->insert('tamu', $dataTamu);

	}

}