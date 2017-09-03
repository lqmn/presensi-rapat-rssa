<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_rapat extends CI_Model{	

	function get_rapat(){
		$sql = 'SELECT ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG, p.NAMA AS PEMBUAT,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS_AKTIVASI
		FROM rapat r JOIN ruang_rapat rp ON r.ID_RUANG = rp.ID_RUANG
		JOIN user u ON r.ID_USER_INPUT = u.ID_USER
		JOIN pegawai p ON u.ID_PEGAWAI = p.ID_PEGAWAI
		WHERE r.STATUS = 1 ORDER BY r.DATE_MODIFIED DESC';

		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function get_ruang(){
		$sql ='SELECT * FROM ruang_rapat';
		
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
		
	}

	function insert_rapat($data){
		$result = $this->db->insert('rapat',$data);
		return $this->db->affected_rows();
	}
	function get_one_rapat($id){
		$sql = "SELECT * FROM rapat WHERE ID_RAPAT = ".$id;
		$result = $this->db->query($sql);
		$data = $result->row();
		return $data;
	}

	function update_rapat($data){
		$this->db->where('ID_RAPAT',$data['ID_RAPAT']);
		$this->db->update('rapat',$data);
		return $this->db->affected_rows();
	}

	function get_peserta_by_rapat($id){
		$sql='SELECT ID_PESERTA_RAPAT, p.NIP, p.NAMA, s.NAMA_SATKER
		FROM peserta_rapat pr JOIN pegawai p ON pr.ID_REF=p.ID_PEGAWAI
		JOIN satuan_kerja s ON p.ID_SATKER = s.ID_SATKER
		WHERE pr.PEGAWAI=1 AND pr.ID_RAPAT='.$id;

		$pegawai = $this->db->query($sql);
		foreach ($pegawai->result() as $row) {
			$test = new stdClass();

			$test->ID = $row->ID_PESERTA_RAPAT;
			$test->NAMA = $row->NIP.', '.$row->NAMA;
			$test->INSTITUSI =$row->NAMA_SATKER.', RSSA Malang';
			$test->PEGAWAI = 1;

			$data[]=$test;
		}

		$sql='SELECT ID_PESERTA_RAPAT, np.NAMA, np.INSTITUSI 
		FROM peserta_rapat pr JOIN non_pegawai np ON pr.ID_REF=np.ID 
		WHERE pr.PEGAWAI=0 AND pr.ID_RAPAT='.$id;

		$non_pegawai = $this->db->query($sql);
		foreach ($non_pegawai->result() as $row) {
			$test = new stdClass();

			$test->ID = $row->ID_PESERTA_RAPAT;
			$test->NAMA = $row->NAMA;
			$test->INSTITUSI =$row->INSTITUSI;
			$test->PEGAWAI = 0;

			$data[]=$test;
		}
		return (array)@$data;
	}

	function delete_peserta($data){
		foreach ($data as $key => $value) {
			$sql='DELETE FROM peserta_rapat WHERE ID_PESERTA_RAPAT='.$value;
			$this->db->query($sql);
		}
		return $this->db->affected_rows();
	}

	function get_all_pegawai($id){
		$sql='SELECT ID_PEGAWAI, p.NIP, p.NAMA, s.NAMA_SATKER 
		FROM pegawai p JOIN satuan_kerja s ON p.ID_SATKER=s.ID_SATKER 
		WHERE ID_PEGAWAI NOT IN (SELECT ID_REF FROM peserta_rapat WHERE PEGAWAI=1 AND ID_RAPAT='.$id.')';

		$pegawai = $this->db->query($sql);
		foreach ($pegawai->result() as $row) {
			$test = new stdClass();

			$test->ID = $row->ID_PEGAWAI;
			$test->NAMA = $row->NIP.', '.$row->NAMA;
			$test->INSTITUSI =$row->NAMA_SATKER.', RSSA Malang';
			$test->PEGAWAI = 1;

			$data[]=$test;
		}
		return (array)@$data;
	}

	function tambah_peserta_pegawai($id_pegawai,$id_rapat){
		foreach ($id_pegawai as $key => $value) {
			$sql='INSERT INTO peserta_rapat (ID_RAPAT, ID_REF, PEGAWAI) VALUES ('.$id_rapat.', '.$value.', 1)';
			$this->db->query($sql);
		}
		return $this->db->affected_rows();
	}

	function get_all_non($id){
		$sql='SELECT ID, NAMA, INSTITUSI 
		FROM non_pegawai 
		WHERE ID NOT IN (SELECT ID_REF FROM peserta_rapat WHERE PEGAWAI=0 AND ID_RAPAT='.$id.')';

		$non = $this->db->query($sql);
		foreach ($non->result() as $row) {
			$test = new stdClass();

			$test->ID = $row->ID;
			$test->NAMA = $row->NAMA;
			$test->INSTITUSI =$row->INSTITUSI;
			$test->PEGAWAI = 0;

			$data[]=$test;
		}
		return (array)@$data;
	}

	function tambah_peserta_non($id_non,$id_rapat){
		foreach ($id_non as $key => $value) {
			$sql='INSERT INTO peserta_rapat (ID_RAPAT, ID_REF, PEGAWAI) VALUES ('.$id_rapat.', '.$value.', 0)';
			$this->db->query($sql);
		}
		return $this->db->affected_rows();
	}

	function delete_rapat($id){
		foreach ($id as $key => $value) {
			$sql='UPDATE rapat SET STATUS=0
			WHERE ID_RAPAT='.$value;
			$this->db->query($sql);
		}
		return $this->db->affected_rows();
	}

	function get_waktu_by_id_rapat($id_rapat){
		$sql='SELECT WAKTU_RAPAT FROM rapat WHERE ID_RAPAT='.$id_rapat ;
		$result = $this->db->query($sql);
		$res=$result->result();
		return $res[0]->WAKTU_RAPAT;
	}

	function get_rapat_by_waktu($waktu){
		$tanggal = explode(' ',$waktu);
		$sql ='SELECT JUDUL_RAPAT, WAKTU_RAPAT, rp.NAMA_RUANG
		FROM rapat r JOIN ruang_rapat rp ON r.ID_RUANG= rp.ID_RUANG
		WHERE r.STATUS_AKTIVASI=1 AND r.STATUS=1 AND date(WAKTU_RAPAT)="'.$tanggal[0].'"';
		// var_dump($sql);
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return (array)@$data;
	}

	function verifikasi_rapat($id_rapat){
		$sql='UPDATE RAPAT 
		SET STATUS_AKTIVASI=1 WHERE ID_RAPAT='.$id_rapat ;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	function get_peserta_guest(){
		$sql='SELECT p.NIP, p.NAMA, s.NAMA_SATKER
		FROM peserta_rapat pr JOIN pegawai p ON pr.ID_REF=p.ID_PEGAWAI
		JOIN satuan_kerja s ON p.ID_SATKER = s.ID_SATKER
		WHERE pr.PEGAWAI=1';

		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$test = new stdClass();

			$test->NAMA = $row->NIP.', '.$row->NAMA;
			$test->INSTITUSI =$row->NAMA_SATKER.', RSSA Malang';
			$test->PEGAWAI = 'Y';

			$peserta[]=$test;
		}

		$sql='SELECT np.NAMA, np.INSTITUSI 
		FROM peserta_rapat pr JOIN non_pegawai np ON pr.ID_REF=np.ID 
		WHERE pr.PEGAWAI=0';

		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$test = new stdClass();

			$test->NAMA = $row->NAMA;
			$test->INSTITUSI =$row->INSTITUSI;
			$test->PEGAWAI = 'N';

			$peserta[]=$test;
		}
		return $peserta;

	}

	function get_rapat_guest(){
		$sql='SELECT ID_RAPAT, r.WAKTU_RAPAT, rp.NAMA_RUANG, r.JUDUL_RAPAT
		FROM rapat r JOIN ruang_rapat rp on r.ID_RUANG = rp.ID_RUANG  
		WHERE WAKTU_RAPAT>NOW()  
		ORDER BY r.WAKTU_RAPAT ASC';

		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$rapat[] = $row;
		}
		return (array)@$rapat;

	}
}