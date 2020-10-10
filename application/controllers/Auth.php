<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Auth_model');
	}

	public function index()
	{
		$this->cekLogin();
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('auth/login');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = html_escape($this->input->post('username', true));
		$password = html_escape($this->input->post('password', true));

		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		if($user != null) {
			if(password_verify($password, $user['password'])) {
				$data = [
					'id_user' => $user['id_user'],
					'username' => $user['username'],
					'role' => $user['role'],
					'status' => $user['status']
				];
				$this->session->set_userdata($data);
				if($user['role'] == 1) {
					redirect('admin/dashboard');
				} else if($user['role'] == 2) {
					redirect('user/penulis');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info"></i> Password Salah !</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info"></i> Anda Belum Punya Akun, Silahkan Daftar Dulu.</div>');
			redirect('auth');
		}
	}

	public function daftar()
	{
		$this->cekLogin();
		$data['title'] = 'Daftar Akun Baru';
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]|min_length[3]');
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('auth/daftar', $data);
		} else {
			$this->Auth_model->tambahUser();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Akun Berhasil Dibuat, Silahkan Masuk Sekarang.</div>');
			redirect('auth/daftar');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('status');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Berhasil Logout.</div>');
		redirect('auth');
	}

	public function cekLogin()
	{
		if($this->session->userdata('role') == 1) {
			redirect('admin/dashboard');
		} else if($this->session->userdata('role') == 2) {
			redirect('user/penulis');
		}
	}



	// ---------------TAMU----------------------
	public function daftar_tamu()
	{
		$data['title'] = 'Daftar Akun';
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]|min_length[3]');
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('tamu/daftar', $data);
		} else {
			$this->Auth_model->tambahDataTamu();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Akun Berhasil Dibuat, Silahkan Masuk Sekarang.</div>');
			redirect('daftar');
		}
	}

	public function login_tamu()
	{
		$data['title'] = 'Login';
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('tamu/login', $data);
		} else {
			$this->_loginTamu();
		}
	}

	private function _loginTamu()
	{
		$username = html_escape($this->input->post('username', true));
		$password = html_escape($this->input->post('password', true));

		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		$dataIdUser =  $user['id_user'];
		$tamu = $this->db->get_where('tamu', ['id_user' => $dataIdUser])->row_array();
		if($user != null) {
			if(password_verify($password, $user['password'])) {
				$data = [
					'id_user' => $user['id_user'],
					'username' => $user['username'],
					'role' => $user['role'],
					'jk_tamu' => $tamu['jk_tamu'],
					'status' => $user['status']
				];
				$this->session->set_userdata($data);
				if($user['role'] == 3) {
					redirect('/');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info"></i> Password Salah !</div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info"></i> Anda Belum Punya Akun, Silahkan Daftar Dulu.</div>');
			redirect('login');
		}
	}

	public function logoutTamu()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('jk_tamu');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Berhasil Logout.</div>');
		redirect('login');
	}

}