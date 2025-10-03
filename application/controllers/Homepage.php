<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('auth_model');
	}

	public function index()
	{
		if (isset($_SESSION['logged_in'])) {
			redirect('/' . $_SESSION['role']);
		}

		if (isset($_POST['login'])) {
			$username = htmlspecialchars($this->input->post('username', true));
			$password = htmlspecialchars($this->input->post('password', true));

			$cekData = $this->auth_model->login($username);

			if ($cekData) {
				if (password_verify($password, $cekData->password)) {
					$_SESSION['id_user'] = $cekData->id;
					$_SESSION['role'] = $cekData->role;
					$_SESSION['logged_in'] = true;

					redirect($_SESSION['role']);
				} else {
					$this->session->set_flashdata('message', '<div class="text-danger text-center mb-2">Login gagal, pastikan Username dan Password benar!</div>');
					redirect('/');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="text-danger text-center mb-2">Login gagal, pastikan Username dan Password benar!</div>');
				redirect('/');
			}
		}

		$data['judul'] = 'Login';

		$this->load->view('pages/homepage', $data);
	}

	public function logout()
	{
		session_destroy();
		redirect('/');
	}
}
