<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_admin extends CI_Model{

	function get_pegawai(){
		$sql ='SELECT ID_PEGAWAI,NIP,NAMA,NAMA_SATKER
		FROM pegawai p JOIN satuan_kerja s ON p.id_satker = s.id_satker
		WHERE p.status=1
		ORDER BY p.date_modified DESC';
		$result = $this->db->query($sql);
		// var_dump($result->num_rows);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
		
	}
	

	function get_user(){
		$sql='SELECT ID_USER, USERNAME,
		(CASE 
		WHEN OTORITAS=1      THEN "Admin"
		WHEN OTORITAS=2      THEN "Verifikator"
		WHEN OTORITAS=3      THEN "User"
		END) as OTORITAS FROM user
		WHERE STATUS=1
		ORDER BY date_modified DESC';

		$result = $this->db->query($sql);
		// if ($result->num_rows()==1) {
		// 	return $result->row();
		// }else{
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
		// }
	}
	function get_non($nip=null){
		$sql = 'SELECT * FROM non_pegawai ORDER BY date_modified DESC';
		$result = $this->db->query($sql);
		// if ($result->num_rows()==1) {
		// 	return $result->row();
		// }else{
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
		// }
	}
	
	function get_rapat(){
		$sql ='SELECT P.ID_RAPAT,P.JUDUL_RAPAT,P.WAKTU_RAPAT,R.NAMA_RUANG,U.NAMA_USER,
		(CASE 
		WHEN P.status=0      THEN "Belum diverifikasi"
		WHEN P.status=1      THEN "Terverifikasi"
		END) as STATUS
		FROM rapat P JOIN ruang_rapat R JOIN user U ON P.id_ruang = R.id_ruang AND P.ID_USER_INPUT = U.ID_USER';
		
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
		
	}
	
	function get_all_entitas(){
		$sql='SELECT p.ID_PEGAWAI AS ID ,P.NAMA,S.NAMA_SATKER as SATKER,"PEGAWAI" AS ASAL  from pegawai P,satuan_kerja S
		WHERE P.ID_SATKER=S.ID_SATKER  
		UNION 
		SELECT ID,NAMA , 
		INSTITUSI AS SATKER,"NON-PEGAWAI" AS ASAL FROM non_pegawai';
		//mengembalikan ID,NAMA,SATKER,ASAL
		$result = $this->db->query($sql);
			foreach ($result->result() as $row) {
				$data[] = $row;
			}
			return $data;
	}
	
  
	function get_ruang(){
		$sql ='SELECT * FROM RUANG_RAPAT';
		
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
		
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

	function get_one_rapat($id){
		$sql = "SELECT * FROM rapat WHERE ID_RAPAT = ".$id;
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

	function insert_rapat($data){
		// var_dump($data);
		$result = $this->db->insert('rapat',$data);
		return $result;
	}
	function insert_pegawai($data){
		$result = $this->db->insert('pegawai',$data);
		return $result;
	}

	function insert_user($data){
		$result = $this->db->insert('user',$data);
		return $this->db->affected_rows();
	}
	
	function insert_non($data){
		// var_dump($data);
		$result = $this->db->insert('non_pegawai',$data);
		return $result;
	}
	
	function insert_peserta($id_peserta,$id_rapat){
		// var_dump($data);	
		foreach ($id_peserta as $key => $value) {
			$sql = "INSERT INTO peserta_rapat (ID_USER,ID_RAPAT)
			VALUES (".$value.",".$id_rapat." )" ;
			// $sql = "DELETE FROM pegawai WHERE ID_PEGAWAI=".$value;
			$result = $this->db->query($sql);
		}
		return $result;
	}
	
	function update_pegawai($data){
		// $var_dump($data);
		$this->db->where('ID_PEGAWAI',$data['ID_PEGAWAI']);
		$this->db->update('pegawai',$data);

		return $this->db->affected_rows();
	}

	function update_user($data){

		$this->db->where('ID_USER',$data['ID_USER']);
		$res = $this->db->update('user',$data);

		return $this->db->affected_rows();
	}

	function update_non($data){
		// $var_dump($data);
		$this->db->where('ID',$data['ID']);
		$this->db->update('non_pegawai',$data);
		$result="nice";
		return $result;
	}
	
	function update_rapat($data){
		// $var_dump($data);
		$this->db->where('ID_RAPAT',$data['ID_RAPAT']);
		$this->db->update('rapat',$data);
		$result="nice";
		return $result;
	}

	function delete_pegawai($data){
		// var_dump($data);	
		foreach ($data as $key => $value) {
			$sql = "UPDATE pegawai
			SET status = 0
			WHERE ID_PEGAWAI=".$value;
			// $sql = "DELETE FROM pegawai WHERE ID_PEGAWAI=".$value;
			$result = $this->db->query($sql);
		}
	}
	function delete_user($data){
		// var_dump($data);	
		foreach ($data as $key => $value) {
			$sql = "UPDATE user
			SET status = 0
			WHERE ID_USER=".$value;
			// $sql = "DELETE FROM user WHERE ID_USER=".$value;
			$result = $this->db->query($sql);
		}
		return $this->db->affected_rows();
	}
	function delete_non($data){
		// var_dump($data);	
		foreach ($data as $key => $value) {
			$sql = "DELETE FROM non_pegawai WHERE ID=".$value;
			$result = $this->db->query($sql);
		}
	}
	
		function delete_rapat($data){
		// var_dump($data);	
		foreach ($data as $key => $value) {
			$sql = "DELETE FROM rapat WHERE ID_RAPAT=".$value;
			$result = $this->db->query($sql);
		}
	}


}