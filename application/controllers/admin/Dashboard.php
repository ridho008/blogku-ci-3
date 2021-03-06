<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekAksesUser();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->db->get('kategori')->num_rows();
		$data['penulis'] = $this->db->get('penulis')->num_rows();
		$data['artikel'] = $this->db->get('artikel')->num_rows();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('layout/footer');
	}

}