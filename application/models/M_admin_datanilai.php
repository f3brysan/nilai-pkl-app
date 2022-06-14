<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_datanilai extends CI_Model {

	var $table = 'tb_nilai';
	var $column_order = array('rel_nim','tb_lahan.nama','nama_mhs','lh_afektif','lh_kognitif','lh_psikomotor',null,'laporan','seminar',null); //set column field database for datatable orderable
	var $column_search = array('rel_nim','tb_lahan.nama','nama_mhs'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('tb_nilai.rel_nim' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$value = '1';
		$this->db->select('tb_nilai.id, rel_nim, tb_lahan.nama as nama_lahan, nama_mhs, lh_afektif, lh_kognitif, lh_psikomotor, ds_afektif, ds_kognitif, ds_psikomotor, laporan, seminar');
		$this->db->from('tb_nilai');
		$this->db->join('tb_mhs', 'tb_mhs.nim = tb_nilai.rel_nim');
		$this->db->join('tb_lahan', 'tb_lahan.kode = tb_nilai.rel_lahan');	
		$this->db->where('tb_nilai.stats',$value);
		

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{	
		$value = '1';

		$this->db->distinct('count(tb_nilai.id)');
		$this->db->from('tb_nilai');
		$this->db->join('tb_mhs', 'tb_mhs.nim = tb_nilai.rel_nim');	
		$this->db->where('tb_nilai.stats',$value);	
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_by_id($id)
	{	$value = '1';
		$this->db->select('tb_nilai.id,rel_nim,nama_mhs,laporan,seminar');
		$this->db->from('tb_nilai');
		$this->db->join('tb_mhs', 'tb_mhs.nim = tb_nilai.rel_nim');
		$this->db->where('tb_nilai.id',$id);
		$this->db->where('tb_nilai.stats',$value);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
 
	
	public function getdatanilai() {
		$query = rst2Array("SELECT DISTINCT
		tb_nilai.id,
		tb_nilai.rel_nim,	
		tb_mhs.nama_mhs,
		tb_lahan.nama,
		tb_nilai.lh_afektif,
		tb_nilai.lh_kognitif,
		tb_nilai.lh_psikomotor,
		tb_nilai.ds_afektif,
		tb_nilai.ds_kognitif,
		tb_nilai.ds_psikomotor,
		tb_nilai.seminar,
		tb_nilai.laporan 
	FROM
		tb_nilai
		LEFT JOIN tb_mhs ON tb_mhs.nim = tb_nilai.rel_nim 
		LEFT JOIN tb_lahan on tb_lahan.kode = tb_nilai.rel_lahan
		where tb_nilai.stats = '1'
	ORDER BY
		tb_nilai.rel_nim ASC");
		return $query;
	
	}


}
