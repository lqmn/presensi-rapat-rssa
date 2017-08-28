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

	function insert_pegawai($data){
		$result = $this->db->insert('pegawai',$data);
		return $this->db->affected_rows();
	}

	function insert_presensi($data){
		$result = $this->db->insert('presensi',$data);
		return $this->db->affected_rows();
	}

	function insert_libur($data){
		$result = $this->db->insert('hari_libur',$data);
		return $this->db->affected_rows();
	}

	function get_libur(){
		$sql = 'SELECT ID_HARI_LIBUR, TANGGAL, KETERANGAN FROM hari_libur';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function delete_libur($data){
		$sql='DELETE FROM hari_libur WHERE ID_HARI_LIBUR='.$data;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}