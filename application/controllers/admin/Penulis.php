<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penulis extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekAksesUser();
		$this->load->model('Penulis_model');
		$this->load->model('Auth_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Penulis';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['penulis'] = $this->db->get('penulis')->result_array();
		$this->db->where('id_user >', '1'); //menghilangkan select admin di bagian tambah data penulis.
		$data['users'] = $this->db->get('users')->result_array();

		$this->form_validation->set_rules('nama', 'Nama Penulis', 'required|trim');
		$this->form_validation->set_rules('user', 'User', 'required|trim');
		$this->form_validation->set_rules('desk_penulis', 'Deskripsi Singkat', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('layout/navbar', $data);
			$this->load->view('admin/penulis/index', $data);
			$this->load->view('layout/footer');
		} else {
			$this->Penulis_model->tambahDataPenulis();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Penulis Berhasil Ditambahkan.</div>');
			redirect('admin/penulis');
		}
	}

	public function tambahPenulis()
	{
		$data['title'] = 'Penulis';
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]|min_length[3]');
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Auth_model->tambahUser();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Penulis Berhasil Dibuat.');
			redirect('admin/penulis');
		}
	}

	public function getpenulis()
	{
		echo json_encode($this->Penulis_model->getPenulisById($_POST['id'])->row_array());
	}

	public function ubahpenulis()
	{
		$this->Penulis_model->ubahDataPenulis($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Penulis Berhasil Diubah.</div>');
		redirect('admin/penulis');
	}

	public function hapus($id)
	{
		$result = $this->db->get_where('penulis', ['id_penulis' => $id])->row_array();
		$fotoPenulis = $result['foto_penulis'];
		unlink('assets/theme_admin/img/penulis/' . $fotoPenulis);
		$this->db->delete('penulis', ['id_penulis' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-trash"></i> Penulis Berhasil Dihapus.</div>');
		redirect('admin/penulis');
	}

}