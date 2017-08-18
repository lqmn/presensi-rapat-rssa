<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_rapat extends CI_Model{	

	function getRapat(){
		$sql = 'SELECT ID_RAPAT, JUDUL_RAPAT, WAKTU_RAPAT, NAMA_RUANG,
		(CASE 
		WHEN STATUS_AKTIVASI=0      THEN "Belum diverifikasi"
		WHEN STATUS_AKTIVASI=1      THEN "Terverifikasi"
		END) as STATUS_AKTIVASI, DATE_MODIFIED
		FROM rapat p JOIN ruang_rapat r ON p.ID_RUANG = r.ID_RUANG
		WHERE STATUS=1
		ORDER BY date_modified DESC';

		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function getPeserta(){
		$sql = 'SELECT * FROM peserta_rapat';
		$result = $this->db->query($sql);
		foreach ($result->result() as $row) {
			$data[] = $row;
		}
		return $data;

	}

}