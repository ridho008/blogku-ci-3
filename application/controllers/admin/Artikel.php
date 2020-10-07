<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekAksesUser();
		$this->load->model('Artikel_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Artikel';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['artikel'] = $this->Artikel_model->getJoinArtikelKategori();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('admin/artikel/index', $data);
		$this->load->view('layout/footer');
	}

	public function tambahArtikel()
	{
		$data['title'] = 'Tambah Data Artikel';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->db->get('kategori')->result_array();

		$this->form_validation->set_rules('judul', 'Judul Artikel', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Kategori Artikel', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Kategori Artikel', 'required|trim');
		$this->form_validation->set_rules('tag', 'Tag', 'required|trim');
		$this->form_validation->set_rules('slug', 'Slug Artikel', 'required|trim');
		$this->form_validation->set_rules('isi', 'Isi Artikel', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('layout/navbar', $data);
			$this->load->view('admin/artikel/tambah_artikel', $data);
			$this->load->view('layout/footer');
		} else {
			if($this->input->post('1') !== null) {
				$status = '1';
			} else if($this->input->post('0') !== null) {
				$status = '0';
			}
			$this->Artikel_model->tambahDataArtikel($status);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Artikel Berhasil Ditambahkan.</div>');
			redirect('admin/artikel');
		}
	}

}