<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('m_login');
				$this->load->library(array('form_validation'));
				$this->load->helper(array('url', 'language', 'form'));
    }

	public function index()
	{		
		$this->load->view('login');
	}

	public function cek_login() {
		$username = strtoupper($this->input->post('username'));
		$password = strtoupper($this->input->post('password'));
		$data = array('username' => $username,
						'password' => md5($password)
			);
		// dump($data);
		$this->load->model('m_login'); // load model_user
		$hasil = $this->m_login->cek_user($data);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result() as $sess) {
				$sess_data['status'] = 'login';
				$sess_data['id'] = $sess->id;
				$sess_data['username'] = $sess->username;
				$sess_data['level'] = $sess->level;
				$this->session->set_userdata($sess_data);
			}
			if ($this->session->userdata('level')=='admin') {

				redirect('admin');
			}
			elseif ($this->session->userdata('level')=='industri') {
				redirect('instansi_dashboard');

			}
			elseif ($this->session->userdata('level')=='dosen') {
				redirect('dosen_dashboard');

			}
			elseif ($this->session->userdata('level')=='prodi') {
				redirect('prodi');

			}
		}
		else {
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
		}
	}

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('auth');
	}

}
