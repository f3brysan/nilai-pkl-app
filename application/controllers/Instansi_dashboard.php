<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == "") {
            redirect('login');
        }
        if ($this->session->userdata('level') !== "industri") {
            echo "<script>alert('Maaf anda tidak diperkenankan mengakses Halaman ini.');history.go(-1);</script>";
            //redirect('login');
        }
        $this->load->helper('text');
        $this->load->model('m_instansi');

    }
    public function index()
    {
        $data['username'] = $this->session->userdata('username');
        $kodelahan        = $data['username'];
        $data['bio']  = $this->m_instansi->bio($kodelahan);
        $data['jml_mhs']  = $this->m_instansi->countmhs($kodelahan);
        // dump($data);
        $this->load->view('instansi/sidebar', $data);
        $this->load->view('instansi/dashboard');
        $this->load->view('instansi/footer');
    }

}
