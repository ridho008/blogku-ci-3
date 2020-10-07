<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penulis_model extends CI_Model {
	public function tambahDataPenulis()
	{
		$foto = $_FILES['foto_penulis']['name'];
		if($foto) {
			$config['upload_path']          = './assets/theme_admin/img/penulis/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_penulis'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/penulis/index', $error);
            }
            else
            {
                $this->upload->data('file_name');
            }
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-alert" role="alert"><i class="fas fa-info"></i> Foto Penulis Belum Anda Upload.</div>');
			redirect('admin/penulis');
		}

		$data = [
			'id_user' => html_escape($this->input->post('user', true)),
			'tgl_daftar' => date('Y-m-d'),
			'nama_penulis' => html_escape($this->input->post('nama', true)),
			'foto_penulis' => $foto,
			'desk_penulis' => html_escape($this->input->post('desk_penulis', true)),
		];

		$this->db->insert('penulis', $data);
	}

	public function ubahDataPenulis($data)
	{
		$id_penulis = $data['id_penulis'];
		$foto = $_FILES['foto_penulis']['name'];
		// var_dump($data); die;
		if($foto) {
			$config['upload_path']          = './assets/theme_admin/img/penulis/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_penulis'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/penulis/index', $error);
            }
            else
            {
            	$fotoPenulisLama = $data['fotoPenulisLama'];
            	$result = $this->db->get_where('penulis', ['id_penulis' => $id_penulis])->row_array();
            	$fotoPenulis = $result['foto_penulis'];
            	if($fotoPenulisLama == $fotoPenulis) {
            		unlink(FCPATH . 'assets/theme_admin/img/penulis/' . $fotoPenulis);
            	}
                $fotoBaruPenulis = $this->upload->data('file_name');
            	$fotoBaruPenulis = $this->db->set('foto_penulis', $fotoBaruPenulis);
            }
		}

		$arr = [
			'id_user' => html_escape($data['user']),
			'nama_penulis' => html_escape($data['nama']),
			'desk_penulis' => html_escape($data['desk_penulis']),
		];

		$this->db->where('id_penulis', $id_penulis);
		$this->db->update('penulis', $arr);
	}

	public function getPenulisById($id)
	{
		return $this->db->get_where('penulis', ['id_penulis' => $id]);
	}

}