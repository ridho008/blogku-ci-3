<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Artikel_model');
	}

	public function index()
	{
		$data['title'] = 'BLOGKU';
		$data['artikel'] = $this->Artikel_model->getJoinArtikelKategori();
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
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/navbar', $data);
		$this->load->view('home/detail_artikel', $data);
		$this->load->view('themeplates/footer');
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
			$this->load->view('themeplates/header', $data);
			$this->load->view('themeplates/navbar', $data);
			$this->load->view('home/' . $folder . '/profile', $data);
			$this->load->view('themeplates/footer');
		}
	}

}