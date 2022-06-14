<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('username') == "") {
			redirect('login');
		}
		if ($this->session->userdata('level') !== "dosen") {
			echo "<script>alert('Maaf anda tidak diperkenankan mengakses Halaman ini.');history.go(-1);</script>";
			//redirect('login');
		}
		$this->load->helper('text');
		$this->load->model('m_dosen');		
		
	}
	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$kodelahan = $data['username'];
		$data['jml_mhs'] = $this->m_dosen->countmhs($kodelahan);
		// dump($data);
		$this->load->view('dosen/sidebar',$data);
		$this->load->view('dosen/dashboard');
		$this->load->view('dosen/footer');
	}	
	
}
