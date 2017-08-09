<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_admin extends CI_Model{

	function get_pegawai($nip=null){
		$sql ='SELECT ID_PEGAWAI,NIP,NAMA,NAMA_SATKER,p.STATUS as STATUS
				FROM pegawai p JOIN satuan_kerja s ON p.id_satker = s.id_satker';
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
	}

	function get_user($nip=null){
		$result = $this->db->query("select * from user");
		if ($result->num_rows()==1) {
			return $result->row();
		}else{
			foreach ($result->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	function get_non($nip=null){
		$result = $this->db->query("select * from non_pegawai");
		if ($result->num_rows()==1) {
			return $result->row();
		}else{
			foreach ($result->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function get_one_pegawai($id){
		$sql = "SELECT * FROM pegawai WHERE ID_PEGAWAI = ".$id;
		$result = $this->db->query($sql);
		$data = $result->row();
		return $data;
	}
	
	function get_one_pegawai_nip($nip){
		$sql = "SELECT * FROM pegawai WHERE NIP = ".$nip;
		$result = $this->db->query($sql);
		$data = $result->row();
		return $data;
	}

	function get_one_user($id){
		$sql = "SELECT * FROM user WHERE ID_USER = ".$id;
		$result = $this->db->query($sql);
		$data = $result->row();
		return $data;
	}
	
	function get_one_non($id){
		$sql = "SELECT * FROM non_pegawai WHERE ID = ".$id;
		$result = $this->db->query($sql);
		$data = $result->row();
		return $data;
	}
	function get_sk(){
		$result = $this->db->query("select * from satuan_kerja");
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function insert_pegawai($data){
		$result = $this->db->insert('pegawai',$data);
		return $result;
	}

	function insert_user($data){
		$result = $this->db->insert('user',$data);
		return $result;
	}
	
	function insert_non($data){
		// var_dump($data);
		$result = $this->db->insert('non_pegawai',$data);
		return $result;
	}
	
	function update_pegawai($data){
	// $var_dump($data);
		$this->db->where('ID_PEGAWAI',$data['ID_PEGAWAI']);
		$this->db->update('pegawai',$data);
		$result="nice";
		return $result;
	}
	function update_user($data){
	// $var_dump($data);
		$this->db->where('ID_USER',$data['ID_USER']);
		$this->db->update('user',$data);
		$result="nice";
		return $result;
	}
	function update_non($data){
	// $var_dump($data);
		$this->db->where('ID',$data['ID']);
		$this->db->update('non_pegawai',$data);
		$result="nice";
		return $result;
	}

	function delete_pegawai($data){
		// var_dump($data);	
		foreach ($data as $key => $value) {
			$sql = "DELETE FROM pegawai WHERE ID_PEGAWAI=".$value;
			$result = $this->db->query($sql);
			// var_dump($sql);
			// $result = $this->db->query()
			// $result=$this->db->query("DELETE FROM pegawai WHERE ID_PEGAWAI = ".$value->ID_PEGAWAI);
		}
	}


}