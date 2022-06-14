<?php
class M_admin extends CI_Model{
	
	public function countmhs() {
		$query = rst2Array("SELECT COUNT(tb_mhs.nim) as jml_mhs FROM tb_mhs
			RIGHT JOIN tb_nilai on tb_nilai.rel_nim =  tb_mhs.nim");
		return $query;
	}
	
	public function getdatanilai() {
		$query = rst2Array("SELECT DISTINCT tb_nilai.id, tb_nilai.rel_nim, tb_mhs.nama_mhs, tb_nilai.afektif, tb_nilai.kognitif, tb_nilai.psikomotor
			FROM tb_nilai 
			LEFT JOIN tb_mhs on tb_mhs.nim = tb_nilai.rel_nim
			WHERE tb_nilai.stats = '1'			
			order by tb_nilai.rel_nim asc ");
		return $query;
	}

}
