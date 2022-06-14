<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('username') == "") {
			redirect('login');
		}
		if ($this->session->userdata('level') !== "admin") {
			echo "<script>alert('Maaf anda tidak diperkenankan mengakses Halaman ini.');history.go(-1);</script>";
			//redirect('login');
		}
		$this->load->helper('text');
		$this->load->model('m_admin');
		
	}
	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['jml_mhs'] = $this->m_admin->countmhs();
		// dump($data);
		$this->load->view('admin/sidebar',$data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	
}
