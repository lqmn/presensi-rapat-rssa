<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_presensi extends CI_Model{

	function get_presensi(){
		
	}

	function get_satker(){
		$result = $this->db->query("SELECT * FROM satuan_kerja");
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function get_id_pegawai($nama, $nip){
		$sql = 'SELECT ID_PEGAWAI FROM pegawai WHERE NIP="'.$nip.'" AND NAMA="'.$nama.'"';
		$result = $this->db->query($sql);
		$data = $result->row();
		if ($data) {
			return $data->ID_PEGAWAI;
		}else{
			return null;
		}
	}

	function get_hari_libur(){
		$sql = 'SELECT * FROM hari_libur ORDER BY TANGGAL ASC';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
		
	}

	function insert_pegawai($data){
		$result = $this->db->insert('pegawai',$data);
		return $this->db->affected_rows();
	}

	function insert_presensi($data){
		$result = $this->db->insert('presensi',$data);
		return $this->db->affected_rows();
	}
	function insert_libur($tanggal){
		$sql="INSERT INTO hari_libur (TANGGAL,ID_USER_INPUT) VALUES ('".$tanggal."','".$this->session->userdata('id_user')."')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

}