<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_datanilai extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('username') == "") {
			redirect('auth');
		}
		if ($this->session->userdata('level') !== "dosen") {
			echo "<script>alert('Maaf anda tidak diperkenankan mengakses Halaman ini.');history.go(-1);</script>";
			//redirect('login');
		}
		$this->load->helper('text');
		$this->load->model('m_dosen_datanilai','datanilai');	
		$this->load->model('m_dosen');
		$this->load->library('pdf');		
		$this->load->helper('tanggal');	
		
	}
	
	public function index()
	{	
		$data['username'] = $this->session->userdata('username');
		$this->load->helper('url');
		$this->load->view('dosen/sidebar',$data);
		$this->load->view('dosen/datanilai/index');
		$this->load->view('dosen/footer');
		$this->load->view('dosen/datanilai/ajax');
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
			$row[] = $datanilai->nama_lahan;
			$row[] = $datanilai->ds_afektif;
			$row[] = $datanilai->ds_kognitif;
			$row[] = $datanilai->ds_psikomotor;			
			$row[] = $datanilai->laporan;
			$row[] = $datanilai->seminar;
			

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
		echo json_encode($output);
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
				'ds_afektif' => $this->input->post('ds_afektif'),
				'ds_kognitif' => $this->input->post('ds_kognitif'),
				'ds_psikomotor' => $this->input->post('ds_psikomotor'),			
				'laporan' => $this->input->post('laporan'),
				'seminar' => $this->input->post('seminar'),				
			);
		$this->datanilai->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->datanilai->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	// public function print_nilai() {
	// 	$data['username'] = $this->session->userdata('username');
	// 	$kodelahan = $data['username'];
	// 	$data['get'] = $this->datanilai->getdatanilai($kodelahan);
	// 	$data['detail'] = $this->datanilai->getdetaillahan($kodelahan);
	// 	$data['dosen'] = $this->datanilai->getdospem($kodelahan);
	// 	// $kodelahan = $data['username'];
		
	// 	// $id
	// 	// dump($data);
	// 	$this->load->library('pdf');

	// 	$this->pdf->setPaper('A4', 'potrait');
	// 	$this->pdf->filename = "print_nilai_$kodelahan.pdf";
	// 	// // $this->pdf->load_view('mahasiswa/navbar', $data);
	// 	$this->pdf->load_view('dosen/datanilai/printnilai', $data);
	// 	// $this->pdf->load_view('mahasiswa/footer');

	// }
}
