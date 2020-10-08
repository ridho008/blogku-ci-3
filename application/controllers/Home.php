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

}