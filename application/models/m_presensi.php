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
		return (array)@$data;
	}

	function delete_libur($data){
		$sql='DELETE FROM hari_libur WHERE ID_HARI_LIBUR='.$data;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	function get_presensi_for_rekap(){
		$sql='SELECT MONTH(TANGGAL) AS BULAN, YEAR(TANGGAL) AS TAHUN, ID_PEGAWAI,  COUNT(TANGGAL) AS PRESENSI, SUM(SELISIH) AS LEMBUR
		FROM(
		SELECT ID_PEGAWAI, MAX(TANGGAL) AS TANGGAL, HOUR(MAX(TIME(TANGGAL))) AS MAX_JAM,
		(CASE 
		WHEN HOUR(MAX(TIME(TANGGAL)))>15 THEN HOUR(MAX(TIME(TANGGAL)))-15
		ELSE 0
		END) AS SELISIH
		FROM presensi
		WHERE HITUNG=1
		GROUP BY ID_PEGAWAI, DATE(TANGGAL)
		) AS A
		GROUP BY ID_PEGAWAI,YEAR(TANGGAL),MONTH(TANGGAL)';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function get_rekap(){
		$sql = 'SELECT * FROM total';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function insert_update_rekap($data){
		$conditionData['BULAN']=$data->BULAN;
		$conditionData['TAHUN']=$data->TAHUN;
		$conditionData['ID_PEGAWAI']=$data->ID_PEGAWAI;
		$this->db->where($conditionData);
		$q = $this->db->get('total');
		var_dump($conditionData);
		if ($q->num_rows()>0) {
			$this->db->where($conditionData);
			$this->db->set($data);
		}else{
			$this->db->insert('total',$data);
		}
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
}