<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel_model extends CI_Model {
	public function getJoinArtikelKategori()
	{
		$this->db->select('*, artikel.status AS Status');
		$this->db->from('artikel');
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$this->db->join('penulis', 'penulis.id_penulis = artikel.id_penulis');
		// $this->db->limit('4');
		$this->db->order_by('artikel.id_artikel', 'desc');
		return $this->db->get()->result_array();
	}

	public function getJoinArtikelKategoriWhereStatus()
	{
		$this->db->select('*, artikel.status AS Status');
		$this->db->from('artikel');
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$this->db->join('penulis', 'penulis.id_penulis = artikel.id_penulis');
		$this->db->limit('4');
		$this->db->where('artikel.status', 1);
		$this->db->order_by('artikel.id_artikel', 'desc');
		return $this->db->get()->result_array();
	}

	public function getJoinDilihat()
	{
		$this->db->select('*');
		$this->db->from('artikel');
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$this->db->join('penulis', 'penulis.id_penulis = artikel.id_penulis');
		$this->db->order_by('dilihat', 'desc');
		return $this->db->get()->result_array();
	}

	public function getArtikelById($id)
	{
		return $this->db->get_where('artikel', ['id_artikel' => $id])->row_array();
	}

	public function tambahDataArtikel($status)
	{
		$foto = $_FILES['foto_artikel']['name'];
		if($foto) {
			$config['upload_path']          = './assets/theme_admin/img/artikel/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_artikel'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/artikel/index', $error);
            }
            else
            {
                $this->upload->data('file_name');
            }
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-alert" role="alert"><i class="fas fa-info"></i> Foto Penulis Belum Anda Upload.</div>');
			redirect('admin/penulis');
		}

		$slug = str_replace(' ', '-', $this->input->post('slug'));
		

		$data = [
			'judul' => html_escape($this->input->post('judul', true)),
			'isi_artikel' => html_escape($this->input->post('isi', true)),
			'slug' => html_escape($slug),
			'gambar_artikel' => $foto,
			'id_kategori' => html_escape($this->input->post('kategori', true)),
			'tag' => html_escape($this->input->post('tag', true)),
			'tanggal' => date('Y-m-d'),
			'id_penulis' => html_escape($this->input->post('penulis', true)),
			'status' => $status
		];

		$this->db->insert('artikel', $data);
	}

	public function ubahDataArtikel($status, $id)
	{
		$foto = $_FILES['foto_artikel']['name'];
		if($foto) {
			$config['upload_path']          = './assets/theme_admin/img/artikel/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_artikel'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/artikel/index', $error);
            }
            else
            {
            	$fotoArtikelLama = $this->input->post('fotoLamaArtikel');
            	$result = $this->db->get_where('artikel', ['id_artikel' => $id])->row_array();
            	$fotoArtikel = $result['gambar_artikel'];
            	if($fotoArtikelLama == $fotoArtikel) {
            		unlink(FCPATH . 'assets/theme_admin/img/artikel/' . $fotoArtikel);
            	}
                $fotoBaruArtikel = $this->upload->data('file_name');
                $this->db->set('gambar_artikel', $fotoBaruArtikel);
            }
		}

		$slug = str_replace(' ', '-', $this->input->post('slug'));
		

		$data = [
			'judul' => html_escape($this->input->post('judul', true)),
			'isi_artikel' => html_escape($this->input->post('isi', true)),
			'slug' => html_escape($slug),
			'id_kategori' => html_escape($this->input->post('kategori', true)),
			'tag' => html_escape($this->input->post('tag', true)),
			'id_penulis' => html_escape($this->input->post('penulis', true)),
			'status' => $status
		];

		$this->db->where('id_artikel', $id);
		$this->db->update('artikel', $data);
	}

	public function getJoinKategori()
	{
		$this->db->select('*');
		$this->db->from('artikel');
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$this->db->join('penulis', 'penulis.id_penulis = artikel.id_penulis');
		$this->db->where('kategori.nama_kategori', 'Teknologi');
		$this->db->limit('4');
		return $this->db->get()->result_array();
	}

	public function get_slug($slug) {
		$this->db->select('*');
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$this->db->join('penulis', 'penulis.id_penulis = artikel.id_penulis');
		return $this->db->get_where('artikel', ['slug' => $slug]);
	}

	public function keywordSearch($keyword)
	{
		$this->db->select('*');
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
		$this->db->join('penulis', 'penulis.id_penulis = artikel.id_penulis');
		$this->db->like('artikel.judul', $keyword);
		$this->db->order_by('artikel.tanggal', 'desc');
		return $this->db->get('artikel')->result_array();
	}

	public function updateCounter($slug)
	{
		$this->db->where('slug', $slug);
		$this->db->select('dilihat');
		$count = $this->db->get('artikel')->row_array();

		// Tambah Satu
		$this->db->where('slug', $slug);
		$this->db->set('dilihat', ($count['dilihat'] + 1));
		$this->db->update('artikel');
	}

	public function tambahDataKomentar()
	{
		$data = [
			'id_artikel' => html_escape($this->input->post('id_artikel', true)),
			'id_user' => $this->session->userdata('id_user'),
			'tgl_komen' => date('Y-m-d'),
			'isi' => html_escape($this->input->post('komentar', true)),
			'status' => 1
		];

		$this->db->insert('komentar', $data);
	}

	public function getKomentar($idArtikel)
	{
		$this->db->join('users', 'users.id_user = komentar.id_user');
		$this->db->join('artikel', 'artikel.id_artikel = komentar.id_artikel');
		$this->db->join('tamu', 'tamu.id_user = users.id_user');
		return $this->db->get_where('komentar', ['komentar.id_artikel' => $idArtikel]);
	}

}