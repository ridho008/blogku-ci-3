<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penulis extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekAdminAksesUser();
	}

	public function index()
	{
		$data['title'] = 'Penulis';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('penulis/dashboard', $data);
		$this->load->view('layout/footer');
	}

}