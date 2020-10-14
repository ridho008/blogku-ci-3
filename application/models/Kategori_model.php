<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {
	public function tambahDataKategori()
	{
		$data = [
			'nama_kategori' => html_escape($this->input->post('kategori', true))
		];

		$this->db->insert('kategori', $data);
	}

	public function ubahDataKategori($data)
	{
		$id_kategori = $data['id_kategori'];
		$arr = [
			'nama_kategori' => html_escape($data['kategori'])
		];

		$this->db->where('id_kategori', $id_kategori);
		$this->db->update('kategori', $arr);
	}

	public function getKategoriById($id)
	{
		return $this->db->get_where('kategori', ['id_kategori' => $id]);
	}

	public function get_where($where)
	{
		return $this->db->get_where('kategori', $where);
	}

}