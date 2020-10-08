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
		$data['penulis'] = $this->db->get('penulis')->result_array();

		$this->form_validation->set_rules('judul', 'Judul Artikel', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Kategori Artikel', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Kategori Artikel', 'required|trim');
		$this->form_validation->set_rules('tag', 'Tag', 'required|trim');
		$this->form_validation->set_rules('slug', 'Slug Artikel', 'required|trim');
		$this->form_validation->set_rules('penulis', 'Penulis Artikel', 'required|trim');
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

	public function ubahArtikel($id)
	{
		$data['title'] = 'Ubah Data Artikel';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->db->get('kategori')->result_array();
		$data['artikel'] = $this->Artikel_model->getArtikelById($id);
		$data['penulis'] = $this->db->get('penulis')->result_array();
		$this->form_validation->set_rules('judul', 'Judul Artikel', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Kategori Artikel', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Kategori Artikel', 'required|trim');
		$this->form_validation->set_rules('tag', 'Tag', 'required|trim');
		$this->form_validation->set_rules('slug', 'Slug Artikel', 'required|trim');
		$this->form_validation->set_rules('penulis', 'Penulis Artikel', 'required|trim');
		$this->form_validation->set_rules('isi', 'Isi Artikel', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('layout/navbar', $data);
			$this->load->view('admin/artikel/ubah_artikel', $data);
			$this->load->view('layout/footer');
		} else {
			if($this->input->post('1') !== null) {
				$status = '1';
			} else if($this->input->post('0') !== null) {
				$status = '0';
			}
			$this->Artikel_model->ubahDataArtikel($status, $id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Artikel Berhasil Diubah.</div>');
			redirect('admin/artikel');
		}
	}

	public function publish($id)
	{
		$this->db->where('id_artikel', $id);
		$this->db->update('artikel', ['status' => '1']);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Artikel Berhasil Dipublikasikan.</div>');
		redirect('admin/artikel');
	}

	public function draft($id)
	{
		$this->db->where('id_artikel', $id);
		$this->db->update('artikel', ['status' => '0']);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Artikel Berhasil Di Draft.</div>');
		redirect('admin/artikel');
	}

	public function hapus($id)
	{
		$result = $this->db->get_where('artikel', ['id_artikel' => $id])->row_array();
		$fotoArtikel = $result['gambar_artikel'];
		unlink('assets/theme_admin/img/artikel/' . $fotoArtikel);
		$this->db->delete('artikel', ['id_artikel' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-trash"></i> Artikel Berhasil Dihapus.</div>');
		redirect('admin/artikel');
	}

}