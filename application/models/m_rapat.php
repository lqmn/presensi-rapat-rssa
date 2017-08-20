<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_rapat extends CI_Model{	

	function get_rapat(){
		$sql = 'SELECT ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG, p.NAMA AS PEMBUAT,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS_AKTIVASI
		FROM rapat rp JOIN ruang_rapat r ON rp.ID_RUANG = r.ID_RUANG
		JOIN pegawai p ON p.ID_PEGAWAI = rp.ID_USER_INPUT
		WHERE rp.STATUS=1
		ORDER BY rp.DATE_MODIFIED DESC';

		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function get_peserta(){
		$sql = 'SELECT * FROM peserta_rapat';
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
}