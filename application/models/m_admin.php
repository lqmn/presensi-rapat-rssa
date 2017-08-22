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
		if($this->session->userdata('otoritas')==1)
		{
		$sql ='SELECT rapat.ID_RAPAT AS ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG, pegawai.NAMA AS NAMA_USER,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS
		FROM rapat JOIN ruang_rapat ON rapat.ID_RUANG = ruang_rapat.ID_RUANG
		JOIN user ON rapat.ID_USER_INPUT = user.ID_USER
		JOIN pegawai ON user.ID_PEGAWAI = pegawai.ID_PEGAWAI
		WHERE rapat.STATUS = 1 ORDER BY rapat.DATE_MODIFIED DESC';}
		
		else if($this->session->userdata('otoritas')==2)
		{
			$sql ='SELECT rapat.ID_RAPAT AS ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG, pegawai.NAMA AS NAMA_USER,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS
		FROM rapat JOIN ruang_rapat ON rapat.ID_RUANG = ruang_rapat.ID_RUANG
		JOIN user ON rapat.ID_USER_INPUT = user.ID_USER
		JOIN pegawai ON user.ID_PEGAWAI = pegawai.ID_PEGAWAI
		WHERE rapat.STATUS = 1 AND rapat.STATUS_AKTIVASI=0 ORDER BY rapat.DATE_MODIFIED DESC';
			
		}
		
		else if($this->session->userdata('otoritas')==3)
		{
			$sql ='SELECT rapat.ID_RAPAT AS ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG, pegawai.NAMA AS NAMA_USER,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS
		FROM rapat JOIN ruang_rapat ON rapat.ID_RUANG = ruang_rapat.ID_RUANG
		JOIN user ON rapat.ID_USER_INPUT = user.ID_USER
		JOIN pegawai ON user.ID_PEGAWAI = pegawai.ID_PEGAWAI
		WHERE rapat.STATUS = 1 AND rapat.ID_USER_INPUT='.$this->session->userdata('id_user').' ORDER BY rapat.DATE_MODIFIED DESC';
			
		}
		else 
		{
		$sql ='SELECT rapat.ID_RAPAT AS ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG, pegawai.NAMA AS NAMA_USER,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS
		FROM rapat JOIN ruang_rapat ON rapat.ID_RUANG = ruang_rapat.ID_RUANG
		JOIN user ON rapat.ID_USER_INPUT = user.ID_USER
		JOIN pegawai ON user.ID_PEGAWAI = pegawai.ID_PEGAWAI
		WHERE rapat.STATUS = 1 ORDER BY rapat.WAKTU_RAPAT ASC';}
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return (array)@$data;
		
	}
	
	function get_rapat_verified(){
		$sql ='SELECT rapat.ID_RAPAT AS ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG, pegawai.NAMA AS NAMA_USER,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS
		FROM rapat JOIN ruang_rapat ON rapat.ID_RUANG = ruang_rapat.ID_RUANG
		JOIN user ON rapat.ID_USER_INPUT = user.ID_USER
		JOIN pegawai ON user.ID_PEGAWAI = pegawai.ID_PEGAWAI
		WHERE rapat.STATUS = 1 AND STATUS_AKTIVASI=1 ORDER BY rapat.DATE_MODIFIED DESC';
		
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return (array)@$data;
	}
	
	function get_all_rapat(){
		$sql =$sql ='SELECT rapat.ID_RAPAT AS ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG, pegawai.NAMA AS NAMA_USER,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS
		FROM rapat JOIN ruang_rapat ON rapat.ID_RUANG = ruang_rapat.ID_RUANG
		JOIN user ON rapat.ID_USER_INPUT = user.ID_USER
		JOIN pegawai ON user.ID_PEGAWAI = pegawai.ID_PEGAWAI
		WHERE rapat.STATUS = 1 ORDER BY rapat.DATE_MODIFIED DESC';
		
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return (array)@$data;
	} 
	
	function get_waktu_by_id_rapat($id_rapat){
		$sql='SELECT WAKTU_RAPAT FROM rapat WHERE ID_RAPAT='.$id_rapat ;
		$result = $this->db->query($sql);
		$res=$result->result();
		return $res;
	}
	
	function get_rapat_by_waktu($waktu){
		$d = date_parse_from_format("Y-m-d", $waktu); 
		$sql ='SELECT rapat.JUDUL_RAPAT,rapat.WAKTU_RAPAT,ruang_rapat.NAMA_RUANG
		from rapat JOIN ruang_rapat
		WHERE rapat.ID_RUANG=ruang_rapat.ID_RUANG AND DAY(rapat.WAKTU_RAPAT)='.$d['day'].'
		AND rapat.STATUS_AKTIVASI=1 AND rapat.STATUS=1 AND MONTH(rapat.WAKTU_RAPAT)='.$d['month'] ;
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return (array)@$data;
		}
		
	
	
	function get_all_entitas($id_rapat){
		$sql='SELECT p.NIP AS ID , p.NAMA, s.NAMA_SATKER as SATKER, "PEGAWAI" AS ASAL 
		FROM pegawai p JOIN satuan_kerja s ON p.ID_SATKER=s.ID_SATKER 
		WHERE p.NIP NOT IN
		(SELECT ID_USER   
		from peserta_rapat 
		WHERE ID_RAPAT = '.$id_rapat.' )
		
		
		UNION 
		SELECT ID,NAMA , 
		INSTITUSI AS SATKER,"NON-PEGAWAI" AS ASAL FROM non_pegawai
		WHERE ID NOT IN
		(SELECT ID_USER   
		from peserta_rapat 
		WHERE ID_RAPAT = '.$id_rapat.' )';
		
		// mengembalikan ID,NAMA,SATKER,ASAL
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return (array)@$data;
	}
	
	function get_detail_peserta($id_rapat){
		$sql='SELECT "'.$id_rapat.'" AS ID_RAPAT ,P.NIP AS ID ,P.NAMA,S.NAMA_SATKER as SATKER,"PEGAWAI" AS ASAL  from pegawai P,satuan_kerja S,peserta_rapat R 
		WHERE 
		P.ID_SATKER=S.ID_SATKER AND
		P.NIP = R.ID_USER AND R.ID_RAPAT="'.$id_rapat.'"

		UNION 
		SELECT "'.$id_rapat.'" AS ID_RAPAT ,ID,NAMA , 
		INSTITUSI AS SATKER,"NON-PEGAWAI" AS ASAL FROM non_pegawai,peserta_rapat R
		WHERE ID = R.ID_USER AND R.ID_RAPAT="'.$id_rapat.'"';
		// mengembalikan ID,NAMA,SATKER,ASAL
		$result = $this->db->query($sql);
		
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		
		return (array)@$data;
		
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
		return $this->db->affected_rows();
		// return $result;
	}

	function insert_pegawai($data){
		$result = $this->db->insert('pegawai',$data);
		return $this->db->affected_rows();
	}

	function insert_user($data){
		$result = $this->db->insert('user',$data);
		return $this->db->affected_rows();
	}
	
	function insert_non($data){
		// var_dump($data);
		$result = $this->db->insert('non_pegawai',$data);
		return $this->db->affected_rows();
	}
	
	function insert_peserta($id_peserta,$id_rapat){
		// var_dump($data);	
		foreach ($id_peserta
			as $key => $value) {
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
	return $this->db->affected_rows();
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
		$this->db->query($sql);
	}
	return $this->db->affected_rows();
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
	return $this->db->affected_rows();
}

function delete_rapat($data){
		// var_dump($data);	
	foreach ($data as $key => $value) {
		$sql = "DELETE FROM rapat WHERE ID_RAPAT=".$value;
		$sql2=" DELETE FROM peserta_rapat WHERE ID_RAPAT=".$value;
		$result2 = $this->db->query($sql2);
		$result = $this->db->query($sql);
		
	}
}

function delete_peserta($data,$id_rapat){
	
	foreach ($data as $key => $value) {
			// $sql = "DELETE FROM peserta_rapat WHERE ID_RAPAT=".$id_rapat."AND ID_USER".$value ;
		$sql = "DELETE FROM peserta_rapat WHERE ID_RAPAT=".$id_rapat." AND ID_USER=".$value." ";
		$result = $this->db->query($sql);
			 // var_dump($value);	
	}
}

function update_status_rapat(){
	$sql="UPDATE  rapat
	SET rapat.STATUS=0
	WHERE  DATE_SUB(NOW(), INTERVAL 1 HOUR) > WAKTU_RAPAT";
	$this->db->query($sql);
	return $this->db->affected_rows();
}

function verifikasi_rapat($id_rapat){
	$sql='UPDATE RAPAT 
	SET STATUS_AKTIVASI=1 WHERE ID_RAPAT='.$id_rapat ;
		$this->db->query($sql);
	return $this->db->affected_rows();
	
}
function insert_absen($data){


$result=$this->db->insert('absensi', $data);

	return $this->db->affected_rows();
}

function get_id_absen($id_bulan){
//jangan lupa parameternya bulan
	$sql="SELECT DISTINCT ID_USER FROM absensi WHERE ID_BULAN=".$id_bulan;
	$result=$this->db->query($sql);
	foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return (array)@$data;
		}

function rekap_absen($id_user,$id_bulan){ //kasih parameter id_bulan
	$sql="SELECT   '".$id_user."' as ID_USER, COUNT(DISTINCT DAY(TANGGAL)) AS TOTAL_ABSEN FROM `absensi` WHERE ID_BULAN=".$id_bulan." AND ID_USER_INPUT=".$this->session->userdata('id_user')." AND ID_USER='".$id_user."'";
	$result=$this->db->query($sql);
	foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return (array)@$data;
		}




	





}