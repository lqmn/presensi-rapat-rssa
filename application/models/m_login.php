<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_login extends CI_Model {

	// Insert registration data in database
	// public function registration_insert($data) {

	// 	// Query to check whether username already exist or not
	// 	$condition = "user_name =" . "'" . $data['user_name'] . "'";
	// 	$this->db->select('*');
	// 	$this->db->from('user_login');
	// 	$this->db->where($condition);
	// 	$this->db->limit(1);
	// 	$query = $this->db->get();
	// 	if ($query->num_rows() == 0) {
	// 		// Query to insert data in database
	// 		$this->db->insert('user_login', $data);
	// 		if ($this->db->affected_rows() > 0) {
	// 			return true;
	// 		}
	// 	} else {
	// 		return false;
	// 	}
	// }

	// Read data using username and password
	public function login($data) {
		$condition = "NIP_PEGAWAI =" . "'" . $data['NIP_PEGAWAI'] . "' AND " . "PASSWORD =" . "'" . $data['PASSWORD'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		// $dataStatus =$query->result_array();
		// if ($dataStatus[0]['STATUS'] == 0) {
		// 	return false;
		// }
		$dataStatus=$query->result_array();
  if($dataStatus[0]['STATUS'] == 0)
  {
   return false;
  }
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	// Read data from database to show data in admin page
	public function read_user_information($username) {

		$condition = "NIP_PEGAWAI =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

}
