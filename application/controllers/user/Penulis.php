<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penulis extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekAdminAksesUser();
		$this->load->model('Artikel_model');
	}

	public function index()
	{
		$data['title'] = 'Penulis';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$where = ['id_user' => $this->session->userdata('id_user')];
		$data['id_penulis'] = $this->Artikel_model->getWhereCustom($where)->row_array();

		$id_penulis = $data['id_penulis']['id_penulis'];
		$where = ['id_penulis' => $id_penulis];
		// AMbil jumlah artikel berdasarkan id_penulis
		$data['jumlahArtikel'] = $this->Artikel_model->get_where_user($where)->num_rows();
		$tableSukai = 'sukai';
		$tableDislike = 'dislike';
		$data['jumlahLike'] = $this->Artikel_model->get_where_like($tableSukai)->num_rows();
		$data['jumlahDislike'] = $this->Artikel_model->get_where_like($tableDislike)->num_rows();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('penulis/dashboard', $data);
		$this->load->view('layout/footer');
	}

}