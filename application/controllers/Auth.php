<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


	public function index()
	{
		$data['web'] = $this->db->get('web')->row();
		$this->load->view('login', $data);
	}
	public function aksi_login()
	{
		$data = [
			'email'		=> $this->input->post('email'),
			'password'	=> md5($this->input->post('password'))
		];
		$cek = $this->db->get_where('user', $data);
		if ($cek->num_rows() > 0) {
			$usr = $cek->row_array();
			$this->session->set_userdata($usr);
			if ($usr['level'] == 'admin') {
				redirect('admin');
			} else {
				redirect('pegawai');
			}
		} else {
			$this->session->set_flashdata('message', 'swal("Ops!", "Email / Password yang anda masukan salah", "error");');
			redirect('Auth');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth');
	}
}
