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
		$condition = 'STATUS="1" AND USERNAME="'.$data['USERNAME'].'" AND PASSWORD="'.$data['PASSWORD'].'"';
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $data[0]['ID_USER'];
		} else {
			return false;
		}
	}

	// Read data from database to show data in admin page
	public function read_user_information($data) {
		$sql ='SELECT ID_USER,pegawai.ID_PEGAWAI AS ID_PEGAWAI,USERNAME,OTORITAS,NAMA,NAMA_SATKER
		FROM user JOIN pegawai ON user.ID_PEGAWAI=pegawai.ID_PEGAWAI
		JOIN satuan_kerja ON pegawai.ID_SATKER = satuan_kerja.ID_SATKER
		WHERE ID_USER ='.$data;

		$result = $this->db->query($sql);
		// var_dump($result->num_rows);
		if ($result->num_rows()==1) {
			return $result->row();
		}else{
			foreach ($result->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

		// $condition = "USERNAME =" . "'" . $username . "'";
		// $this->db->select('*');
		// $this->db->from('user');
		// $this->db->where($condition);
		// $this->db->limit(1);
		// $query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

}
