<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekAdminAksesUser();
		$this->load->model('Artikel_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Komentar';
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
		$data['listPenulis'] = $this->Artikel_model->getMenuKomentar($id_penulis)->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('penulis/komentar/index', $data);
		$this->load->view('layout/footer');
	}

	public function tampilKomentar($idKomentar)
	{
		$this->db->set('status', '0');
		$this->db->where('id_komen', $idKomentar);
		$this->db->update('komentar');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="fa fa-bell" aria-hidden="true"></i> Komentar Berhasil Ditarik.</div>');
		redirect('penulis/komentar');
	}

	public function hilangKomentar($idKomentar)
	{
		$this->db->set('status', '1');
		$this->db->where('id_komen', $idKomentar);
		$this->db->update('komentar');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="fa fa-bell" aria-hidden="true"></i> Komentar Berhasil Ditampilkan.</div>');
		redirect('penulis/komentar');
	}

	

}