<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi_datanilai extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('username') == "") {
			redirect('auth');
		}
		if ($this->session->userdata('level') !== "industri") {
			echo "<script>alert('Maaf anda tidak diperkenankan mengakses Halaman ini.');history.go(-1);</script>";
			//redirect('login');
		}
		$this->load->helper('text');
		$this->load->model('m_instansi_datanilai','datanilai');	
		$this->load->model('m_instansi');
		$this->load->library('pdf');		
		$this->load->helper('tanggal');	
		
	} 
	
	public function index()
	{	
		$data['username'] = $this->session->userdata('username');
		$this->load->helper('url');
		$this->load->view('instansi/sidebar',$data);
		$this->load->view('instansi/datanilai/index');
		$this->load->view('instansi/footer');
		$this->load->view('instansi/datanilai/ajax');
	}

	public function ajax_list()
	{
		$list = $this->datanilai->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datanilai) {
			$no++;
			$row = array();
			// $row[] = $datanilai->id;
			$row[] = $datanilai->rel_nim;
			$row[] = $datanilai->nama_mhs;			
			$row[] = $datanilai->lh_afektif;
			$row[] = $datanilai->lh_kognitif;
			$row[] = $datanilai->lh_psikomotor;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$datanilai->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit Nilai</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->datanilai->count_all(),
						"recordsFiltered" => $this->datanilai->count_filtered(),
						"data" => $data,
				);
		//output to json format
		print_r(json_encode($output));
	}

	public function ajax_edit($id)
	{
		$data = $this->datanilai->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
			);
		$insert = $this->datanilai->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(			
				'lh_afektif' => $this->input->post('lh_afektif'),
				'lh_kognitif' => $this->input->post('lh_kognitif'),
				'lh_psikomotor' => $this->input->post('lh_psikomotor'),
			);
		$this->datanilai->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->datanilai->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function print_nilai() {
		$data['username'] = $this->session->userdata('username');
		$kodelahan = $data['username'];
		$data['get'] = $this->datanilai->getdatanilai($kodelahan);
		$data['detail'] = $this->datanilai->getdetaillahan($kodelahan);
		$data['dosen'] = $this->datanilai->getdospem($kodelahan);
		// $kodelahan = $data['username'];
		
		// $id
		// dump($data);
		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "print_nilai_$kodelahan.pdf";
		// // $this->pdf->load_view('mahasiswa/navbar', $data);
		$this->pdf->load_view('instansi/datanilai/printnilai', $data);
		// $this->load->view('instansi/datanilai/printnilai', $data);
		// $this->pdf->load_view('mahasiswa/footer');

	}
}
