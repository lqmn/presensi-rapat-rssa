<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_presensi extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_presensi');
		$this->load->library('Excelfile');
	}

	function index(){
		$this->load->view('v_presensi_admin');
	}

	function upload(){
		$id_satker = $_POST['satker'];

		$tmp = $_FILES['excel']['tmp_name'];
		$name = $_FILES['excel']['name'];
		$ext = explode('.',$name);
		$ext = end($ext);

		$target = "uploads/".$name;
		move_uploaded_file($tmp,$target);

		$objPHPExcel = PHPExcel_IOFactory::load($target);
		$sheet = $objPHPExcel->getActiveSheet();

		$lastrow = $sheet->getHighestRow();
		$sheet->getStyle('B1:B'.$lastrow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
		$arrayData = $sheet->toArray();


		echo '
		<table class="table">
			<thead>
				<tr>
					<th>Nama</th>
					<th>NIP</th>
					<th>Tanggal</th>
					<th>Hitung</th>
				</tr>
			</thead>
			<tbody>
		';
		foreach ($arrayData as $key => $value) {
			if ($value[0]!='Nama' AND $value[0]!=null) {
				if (strlen(explode(' ',$value[2])[0])<10) {

					$date = date_create_from_format('n/j/y H:i', $value[2]);
					$date = date_format($date,'Y-m-d H:i:s');
					$value[2] = $date;
				}else{
					$date = date_create_from_format('d/m/Y H:i', $value[2]);
					$date = date_format($date,'Y-m-d H:i:s');
					$value[2] = $date;
				}
				$id_pegawai = $this->m_presensi->get_id_pegawai($value[0],$value[1]);
				// echo "aokwdokao";
				if (!$id_pegawai) {
					$data['NAMA']=$value[0];
					$data['NIP']=$value[1];
					$data['ID_SATKER']=$id_satker;
					$this->m_presensi->insert_pegawai($data);
					$id_pegawai = $this->m_presensi->get_id_pegawai($value[0],$value[1]);
				}
				$value[3]=$id_pegawai;

				echo '
				<tr>
					<td>'.$value[0].'</td>
					<td>'.$value[1].'</td>
					<td>'.$value[2].'</td>
					<td>'.$value[3].'</td>
				</tr>
				';
			}
		}
		echo "
			</tbody>
		</table>
		";
		unlink($target);
	}

	function delete($target){

	}

	function form_upload(){
		$data['satker'] = $this->m_presensi->get_satker();
		$this->load->view('v_form_upload', $data); 
	}
}