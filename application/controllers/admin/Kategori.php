<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekAksesUser();
		$this->load->model('Kategori_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Kategori';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->db->get('kategori')->result_array();

		$this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('layout/navbar', $data);
			$this->load->view('admin/kategori/index', $data);
			$this->load->view('layout/footer');
		} else {
			$this->Kategori_model->tambahDataKategori();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Kategori Berhasil Ditambahkan.</div>');
			redirect('admin/kategori');
		}
	}

	public function getKategori()
	{
		echo json_encode($this->Kategori_model->getKategoriById($_POST['id'])->row_array());
	}

	public function ubahKategori()
	{
		$this->Kategori_model->ubahDataKategori($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Kategori Berhasil Diubah.</div>');
		redirect('admin/kategori');
	}

	public function hapus($id)
	{
		$this->db->delete('kategori', ['id_kategori' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-trash"></i> Kategori Berhasil Dihapus.</div>');
		redirect('admin/kategori');
	}

}