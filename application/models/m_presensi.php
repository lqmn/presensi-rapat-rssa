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

	function get_id_pegawai($data){
		$res = $this->db->select('*')->from('pegawai')->where($data)->get();
		$data = $res->row();
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
		return (array)@$data;
	}

	function delete_libur($data){
		$sql='DELETE FROM hari_libur WHERE ID_HARI_LIBUR='.$data;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	function get_presensi_for_rekap(){
		$sql='SELECT BULAN, TAHUN, ID_PEGAWAI, COUNT(ID_PRESENSI) AS PRESENSI, SUM(LEMBUR) AS LEMBUR
			FROM
			(SELECT pr.ID_PRESENSI, pr.ID_PEGAWAI, p.NAMA, YEAR(TANGGAL) AS TAHUN, MONTH(TANGGAL) AS BULAN, pr.LEMBUR
			FROM presensi pr JOIN pegawai p ON pr.ID_PEGAWAI=p.ID_PEGAWAI
			WHERE HITUNG=1) AS S
			GROUP BY ID_PEGAWAI, TAHUN, BULAN';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function get_presensi_perhari($dataExcel){
		foreach ($dataExcel as $key => $value) {
			$result = $this->db->insert('data_excel',$value);
		}
		
		$sql='
		SELECT NAMA, NIP, DATE(TANGGAL) AS TANGGAL,
		(CASE 
			WHEN HOUR(TANGGAL)>15 THEN HOUR(TANGGAL)-15
		 	ELSE 0
		END) AS LEMBUR
		FROM(
			SELECT NAMA,NIP, MAX(TANGGAL) AS TANGGAL 
			FROM data_excel
			GROUP BY NAMA, DATE(TANGGAL)
		) AS D
		';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		// var_dump($data);

		$sql = 'DELETE FROM data_excel';
		$this->db->query($sql);

		return $data;
		// return $this->db->affected_rows();

	}

	function get_id_presensi($data){
		$res = $this->db->select('*')->from('presensi')->where($data)->get();
		$data = $res->row();
		if ($data) {
			return $data->ID_PRESENSI;
		}else{
			return null;
		}
	}

	function update_presensi($id,$data){
		$res = $this->db->set($data)->where('ID_PRESENSI',$id)->update('presensi');
		return $this->db->affected_rows();
	}

	function get_id_rekap($data){
		$res = $this->db->select('*')->from('rekap')->where($data)->get();
		$data = $res->row();
		if ($data) {
			return $data->ID_REKAP;
		}else{
			return null;
		}

	}

	function insert_rekap($data){
		$result = $this->db->insert('rekap',$data);
		return $this->db->affected_rows();
	}

	function update_rekap($id,$data){
		$res = $this->db->set($data)->where('ID_REKAP',$id)->update('rekap');
		return $this->db->affected_rows();
	}

	function get_rekap_tabel(){
		$sql = 'SELECT ID_REKAP, CONCAT(p.NIP,", ",p.NAMA) AS NAMA, sk.NAMA_SATKER AS SATKER, r.TAHUN, r.BULAN, r.PRESENSI, r.LEMBUR
		FROM rekap r JOIN pegawai p ON r.ID_PEGAWAI=p.ID_PEGAWAI
		JOIN satuan_kerja sk ON sk.ID_SATKER=p.ID_SATKER';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}
}