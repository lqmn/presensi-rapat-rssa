<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_login extends CI_Model {

	public function login($data) {
		$sql ='SELECT * FROM user WHERE STATUS="1" AND USERNAME="'.$data['username'].'" AND PASSWORD="'.$data['password'].'"';
		$res = $this->db->query($sql);
		if ($res->num_rows()>0) {
			return $res->result()[0]->ID_USER;
		} else {
			return false;
		}
	}

	// Read data from database to show data in admin page
	public function read_user_information($data) {
		$sql ='SELECT ID_USER, p.ID_PEGAWAI AS ID_PEGAWAI, USERNAME, OTORITAS, NAMA, NAMA_SATKER, p.ID_SATKER
		FROM user u JOIN pegawai p ON u.ID_PEGAWAI=p.ID_PEGAWAI
		JOIN satuan_kerja sk ON p.ID_SATKER = sk.ID_SATKER
		WHERE ID_USER ='.$data;

		$result = $this->db->query($sql);
		// if ($result->num_rows()==1) {
		// 	return $result->row();
		// }else{
		// 	foreach ($result->result() as $row) {
		// 		$data[] = $row;
		// 	}
		// 	return $data;
		// }

		if ($result->num_rows() == 1) {
			return $result->result()[0];
		} else {
			return false;
		}
	}

}
