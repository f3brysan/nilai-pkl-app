<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_datanilai extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('username') == "") {
			redirect('auth');
		}
		if ($this->session->userdata('level') !== "admin") {
			echo "<script>alert('Maaf anda tidak diperkenankan mengakses Halaman ini.');history.go(-1);</script>";
			//redirect('login');
		}
		$this->load->helper('text');
		$this->load->model('m_admin_datanilai','datanilai');	
		$this->load->model('m_admin');
		$this->load->library('pdf');		
		$this->load->helper('tanggal');	
		
	}
	
	public function index()
	{	
		$data['username'] = $this->session->userdata('username');
		$this->load->helper('url');
		$this->load->view('admin/sidebar',$data);
		$this->load->view('admin/datanilai/index');
		$this->load->view('admin/footer');
		$this->load->view('admin/datanilai/ajax');
	}

	public function ajax_list()
	{
		$list = $this->datanilai->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datanilai) {
			$no++;
			// $lahan = number_format(floatval($datanilai->lh_afektif)+floatval($datanilai->lh_kognitif)+floatval($lh_psikomotor),2);
			// $ds_individu = number_format(floatval($datanilai->ds_afektif)+floatval($datanilai->ds_kognitif)+floatval($ds_psikomotor),2);
			$row = array();
			// $row[] = $datanilai->id;
			$row[] = $datanilai->rel_nim;
			$row[] = $datanilai->nama_mhs;
			$row[] = $datanilai->nama_lahan;
			$row[] = $datanilai->lh_afektif;	
			$row[] = $datanilai->lh_kognitif;	
			$row[] = $datanilai->lh_psikomotor;
			$lh_individu = number_format(floatval($datanilai->lh_afektif)+floatval($datanilai->lh_kognitif)+floatval($datanilai->lh_psikomotor),2);
			$ds_individu = number_format(floatval($datanilai->ds_afektif)+floatval($datanilai->ds_kognitif)+floatval($datanilai->ds_psikomotor),2);
			$sempol = number_format((floatval($datanilai->laporan)+floatval($datanilai->seminar))/2,2);
			$n_dosen = number_format((floatval($sempol)+floatval($ds_individu))/2,2);
			$row[] = $ds_individu;
			// $lahan = number_format(floatval($datanilai->lh_afektif)+floatval($datanilai->lh_kognitif)+floatval($lh_psikomotor),2);
			// $ds_individu = number_format(floatval($datanilai->ds_afektif)+floatval($datanilai->ds_kognitif)+floatval($ds_psikomotor),2);				
			// $row[] = $ds_individu;	
			$row[] = $datanilai->laporan;
			$row[] = $datanilai->seminar;
			$row[] = number_format(((floatval($lh_individu))*0.7)
			+((floatval($n_dosen))*0.3),2);
			// $row[] = number_format(
			// 	((floatval($datanilai->lh_afektif)+floatval($datanilai->lh_kognitif)+floatval($datanilai->lh_psikomotor))*0.7)
			// 	+
			// 	((floatval($$datanilai->ds_afektif)+floatval($datanilai->ds_kognitif)+floatval($datanilai->ds_psikomotor))
			// 	+
			// 	((floatval($datanilai->laporan)+floatval($datanilai->seminar)/2)/2)*0.3),2);

			//add html for action			
		
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

	public function print_nilai() {
		// $data['username'] = $this->session->userdata('username');
		// $kodelahan = $data['username'];
		$data['get'] = $this->datanilai->getdatanilai();
		// $data['detail'] = $this->datanilai->getdetaillahan();
		// $data['dosen'] = $this->datanilai->getdospem($kodelahan);
		// $kodelahan = $data['username'];
		
		// $id
		// dump($data);
		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "print_nilai.pdf";
		// // $this->pdf->load_view('mahasiswa/navbar', $data);
		$this->pdf->load_view('admin/datanilai/printnilai', $data);
		// $this->pdf->load_view('mahasiswa/footer');

	}

	  public function export_excel(){
           $data['get'] = $this->datanilai->getdatanilai();
 
           $this->load->view('admin/datanilai/excelnilai',$data);
      }
}
