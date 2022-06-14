<?php
class M_login extends CI_Model{
  public function cek_user($data) {
			$query = $this->db->get_where('tb_user', $data);
			return $query;
		}
}
