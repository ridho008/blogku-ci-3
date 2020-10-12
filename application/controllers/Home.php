<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Artikel_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'BLOGKU';
		$data['artikel'] = $this->Artikel_model->getJoinArtikelKategoriWhereStatus();
		$data['populer'] = $this->Artikel_model->getJoinDilihat();
		$data['artikelKategori'] = $this->Artikel_model->getJoinKategori();
		$data['kategori'] = $this->db->get('kategori')->result_array();
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/navbar', $data);
		$this->load->view('home/index', $data);
		$this->load->view('themeplates/footer');
	}

	public function detailArtikel($slug)
	{
		// AMbil slug dri DB
		$data['isi'] = $this->Artikel_model->get_slug($slug)->row_array();
		$data['title'] = $data['isi']['judul'] . ' - BLOGKU';

		$this->load->helper('cookie');
		$checkVisitor = $this->input->cookie($slug, false);
		$ipAddress = $this->input->ip_address();

		// Jika pengunjung melihat artikel
		if($checkVisitor == false) {
			$cookie = [
				"name" => $slug,
				"value" => $ipAddress,
				'expire' => time() + 7200, // 2Jam
				'secure' => false
			];

			// set cookie dan update jumlah view
			$this->input->set_cookie($cookie);
			$this->Artikel_model->updateCounter($slug);
		}

		// Komentar
		$idArtikel = $data['isi']['id_artikel']; 
		$data['komentar'] = $this->Artikel_model->getKomentar($idArtikel)->result_array();

		// Cek Tombol Like
		$dataLike = [
			'id_artikel' => $idArtikel,
			'id_user' => $this->session->userdata('id_user')
		];
		$tableSukai = 'sukai';
		$tableDislike = 'dislike';
		$data['cekLike'] = $this->Artikel_model->get_where($tableSukai, $dataLike)->num_rows();
		$data['dislike'] = $this->Artikel_model->get_where($tableDislike, $dataLike)->num_rows();

		$this->form_validation->set_rules('komentar', 'Komentar', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates/header', $data);
			$this->load->view('themeplates/navbar', $data);
			$this->load->view('home/detail_artikel', $data);
			$this->load->view('themeplates/footer');
		} else {
			$this->tambahKomentar($slug);
		}
	}

	public function tambahKomentar($slug)
	{
		$this->Artikel_model->tambahDataKomentar();
		$this->session->set_flashdata('komentar', '<div class="alert alert-success"><i class="fa fa-bell" aria-hidden="true"></i> Komentar Berhasil Ditampilkan.</div>');
		redirect('artikel/' . $slug);
	}

	public function pencarian()
	{
		$keyword = $this->input->get('keyword');
		$data['title'] = 'Hasil Pencarian ' . $keyword;
		// Ambil artikel berdasarkan keyword yg di cari.
		$data['cari'] = $this->Artikel_model->keywordSearch($keyword);
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/navbar', $data);
		$this->load->view('home/pencarian', $data);
		$this->load->view('themeplates/footer');
	}

	public function profileTamu($status, $username)
	{
		if($status == 'user') {
			$folder = 'tamu';
		} else {
			$folder = 'penulis';
		}

		if($this->load->view('home/' . $folder . '/profile', '', true) === '') {

		} else {
			if($status == 'user') :
				$data['user'] = $this->db->get_where('users', ['username' => $username])->row_array();
				$idUser = $data['user']['id_user'];
				$data = ['id_user' => $idUser];
				$data['profile'] = $this->db->get_where('tamu', ['id_user' => $idUser])->row_array();
			endif;
			$data['user'] = $this->db->get_where('users', ['username' => $username])->row_array();
			$data['title'] = 'Profile ' . ucfirst($username);
			$this->form_validation->set_rules('passwordLama', 'Password Lama', 'required|trim');
			$this->form_validation->set_rules('passwordBaru1', 'Password Baru', 'required|trim|min_length[3]|matches[passwordBaru2]');
			$this->form_validation->set_rules('passwordBaru2', 'Password Baru', 'required|trim|matches[passwordBaru1]');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('themeplates/header', $data);
				$this->load->view('themeplates/navbar', $data);
				$this->load->view('home/' . $folder . '/profile', $data);
				$this->load->view('themeplates/footer');
			} else {
				$this->ubahPasswordTamu();
			}
		}
	}

	public function ubahPasswordTamu()
	{
		$passwordLama = html_escape($this->input->post('passwordLama', true));
		$passwordBaru = html_escape($this->input->post('passwordBaru1', true));
		$konfirmasiPassword = html_escape($this->input->post('passwordBaru2', true));

		$user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

		if(!password_verify($passwordLama, $user['password'])) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-danger"></i> Password Lama Salah!.</div>');
			redirect('profil/user/' . $this->session->userdata('username'));
		} else {
			if($passwordLama == $passwordBaru) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-danger"></i> Password Lama Sama Dengan Yang Baru! Coba Password Lain.</div>');
				redirect('profil/user/' . $this->session->userdata('username'));
			} else {
				$passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

				$this->db->set('password', $passwordHash);
				$this->db->where('username', $this->session->userdata('username'));
				$this->db->update('users');

				$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="fa fa-bell" aria-hidden="true"></i> Password Berhasil Di Ganti.</div>');
				redirect('profil/user/' . $this->session->userdata('username'));
			}
		}
	}

	public function likeArtikel($idArtikel, $slug)
	{
		$data = [
			'id_artikel' => $idArtikel,
			'id_user' => $this->session->userdata('id_user')
		];

		// Proses cek dislike
		$tableDislike = 'dislike';
		$cek = $this->Artikel_model->get_where($tableDislike, $data)->num_rows();
		if($cek > 0) {
			$datanya = $this->Artikel_model->get_where($tableDislike, $data)->row_array();
			$idArtikel = $datanya['id_artikel'];
			$hapus = $this->Artikel_model->hapus($tableDislike, $idArtikel);
		}

		$this->db->insert('sukai', $data);
		$this->session->set_flashdata('komentar', '<div class="alert alert-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Anda Berhasil Like Artikel.</div>');
		redirect('artikel/' . $slug);
	}

	public function dislikeArtikel($idArtikel, $slug)
	{
		$data = [
			'id_artikel' => $idArtikel,
			'id_user' => $this->session->userdata('id_user')
		];

		// Proses cek dislike
		$tableDislike = 'sukai';
		$cek = $this->Artikel_model->get_where($tableDislike, $data)->num_rows();
		if($cek > 0) {
			$datanya = $this->Artikel_model->get_where($tableDislike, $data)->row_array();
			$idArtikel = $datanya['id_artikel'];
			$hapus = $this->Artikel_model->hapus($tableDislike, $idArtikel);
		}

		$this->db->insert('dislike', $data);
		$this->session->set_flashdata('komentar', '<div class="alert alert-success"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Anda Berhasil Dislike Artikel.</div>');
		redirect('artikel/' . $slug);
	}

}