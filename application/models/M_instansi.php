<?php
class M_instansi extends CI_Model{

	public function countmhs($kodelahan) {
		$query = rst2Array("SELECT COUNT(*) AS jml_mhs FROM tb_nilai WHERE tb_nilai.rel_lahan = '$kodelahan'");
		return $query;
	}
	public function bio($kodelahan) {
		$query = rst2Array("SELECT * FROM tb_lahan WHERE tb_lahan.kode = '$kodelahan'");
		return $query;
	}
	public function getdospem($kodelahan) {
		$query = rst2Array("SELECT DISTINCT tb_nilai.id, tb_nilai.rel_nidn, tb_dosen.nama, tb_dosen.gelar_belakang, tb_nilai.afektif, tb_nilai.kognitif, tb_nilai.psikomotor
			FROM tb_nilai 
			JOIN tb_dosen on tb_dosen.nidn = tb_nilai.rel_nidn
			WHERE tb_nilai.rel_lahan = 'kodelahan'
			GROUP BY tb_nilai.rel_nidn
			ORDER BY tb_nilai.rel_nim ASC");
		return $query;
	}
	public function getdatanilai($kodelahan) {
		$query = rst2Array("SELECT DISTINCT tb_nilai.id, tb_nilai.rel_nim, tb_mhs.nama_mhs, tb_nilai.afektif, tb_nilai.kognitif, tb_nilai.psikomotor
			FROM tb_nilai 
			LEFT JOIN tb_mhs on tb_mhs.nim = tb_nilai.rel_nim
			WHERE tb_nilai.rel_lahan = '$kodelahan'
			order by tb_nilai.rel_nim asc ");
		return $query;
	}
	
}
