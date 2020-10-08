<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel_model extends CI_Model {
	public function getJoinArtikelKategori()
	{
		$this->db->select('*');
		$this->db->from('artikel');
		$this->db->join('kategori', 'kategori.id_kategori = artikel.id_kategori');
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
			'status' => $status
		];

		$this->db->where('id_artikel', $id);
		$this->db->update('artikel', $data);
	}

}