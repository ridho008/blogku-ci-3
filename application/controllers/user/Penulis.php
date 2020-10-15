<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penulis extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekAdminAksesUser();
		$this->load->model('Artikel_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Penulis';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$where = ['id_user' => $this->session->userdata('id_user')];
		$data['id_penulis'] = $this->Artikel_model->getWhereCustom($where)->row_array();

		$id_penulis = $data['id_penulis']['id_penulis'];
		$where = ['id_penulis' => $id_penulis];
		// AMbil jumlah artikel berdasarkan id_penulis
		$data['jumlahArtikel'] = $this->Artikel_model->get_where_user($where)->num_rows();
		$tableSukai = 'sukai';
		$tableDislike = 'dislike';
		$data['jumlahLike'] = $this->Artikel_model->get_where_like($tableSukai)->num_rows();
		$data['jumlahDislike'] = $this->Artikel_model->get_where_like($tableDislike)->num_rows();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('penulis/dashboard', $data);
		$this->load->view('layout/footer');
	}

	public function pegaturan()
	{
		$data['title'] = 'Pegaturan | ' . ucfirst($this->session->userdata('username'));
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$idUser = $data['user']['id_user'];
		$where = ['id_user' => $idUser];
		$data['profile'] = $this->Artikel_model->getWhereCustom($where)->row_array();
		$this->form_validation->set_rules('passwordLama', 'Password Lama', 'required|trim');
		$this->form_validation->set_rules('passwordBaru1', 'Password Baru', 'required|trim|min_length[3]|matches[passwordBaru2]');
		$this->form_validation->set_rules('passwordBaru2', 'Password Baru', 'required|trim|matches[passwordBaru1]');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('layout/navbar', $data);
			$this->load->view('penulis/pengaturan/index', $data);
			$this->load->view('layout/footer');
		} else {
			$this->ubahPasswordPenulis();
		}
	}

	public function ubahPasswordPenulis()
	{
		$passwordLama = html_escape($this->input->post('passwordLama', true));
		$passwordBaru = html_escape($this->input->post('passwordBaru1', true));
		$konfirmasiPassword = html_escape($this->input->post('passwordBaru2', true));

		$user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

		if(!password_verify($passwordLama, $user['password'])) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Password Lama Salah!.</div>');
			redirect('penulis/pengaturan');
		} else {
			if($passwordLama == $passwordBaru) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Password Lama Sama Dengan Yang Baru! Coba Password Lain.</div>');
				redirect('penulis/pengaturan');
			} else {
				$passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

				$this->db->set('password', $passwordHash);
				$this->db->where('username', $this->session->userdata('username'));
				$this->db->update('users');

				$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="fa fa-bell" aria-hidden="true"></i> Password Berhasil Di Ganti.</div>');
				redirect('penulis/pengaturan');
			}
		}
	}

	public function ubahDataDiriPenulis()
	{
		$idPenulis = $this->input->post('id_penulis', true);
		$namaPenulis = $this->input->post('nama', true);
		$deskripsi = $this->input->post('deskripsi', true);

		$data = [
			'nama_penulis' => $namaPenulis,
			'desk_penulis' => $deskripsi
		];

		$this->db->where('id_penulis', $idPenulis);
		$this->db->update('penulis', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="fa fa-info-circle" aria-hidden="true"></i> Data Diri Berhasil Di Ganti.</div>');
				redirect('penulis/pengaturan');
	}

	public function gantiFoto()
	{
		$idUser = $this->session->userdata('id_user');
		$where = ['id_user' => $idUser];
		$data = $this->Artikel_model->get_where('penulis', $where)->row_array();
		// var_dump($data);
		$foto = $_FILES['fotoPenulis']['name'];
		if($foto) {
			$config['upload_path']          = './assets/theme_admin/img/penulis/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fotoPenulis'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/artikel/index', $error);
            }
            else
            {
            	$rowFotoPenulisDB = $data['foto_penulis'];
            	if($rowFotoPenulisDB) {
            		unlink(FCPATH . 'assets/theme_admin/img/penulis/' . $rowFotoPenulisDB);
            	}
                $fotoPenulisBaru = $this->upload->data('file_name');
                $this->db->set('foto_penulis', $fotoPenulisBaru);
                $this->db->where('id_penulis', $data['id_penulis']);
				$this->db->update('penulis');
            }
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info"></i> Foto Penulis Belum Anda Upload.</div>');
			redirect('penulis/pengaturan');
		}

		
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info"></i> Foto Penulis Berhasil Anda Upload.</div>');
		redirect('penulis/pengaturan');
	}

}