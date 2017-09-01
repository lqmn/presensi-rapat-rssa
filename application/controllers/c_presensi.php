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

	function openFile(){
		$id_satker = $_POST['satker'];

		$tmp = $_FILES['excel']['tmp_name'];
		$name = $_FILES['excel']['name'];
		$ext = explode('.',$name);
		$ext = end($ext);

		$target = "uploads/".$name;
		move_uploaded_file($tmp,$target);

		$objPHPExcel = PHPExcel_IOFactory::load($target);
		$sheet = $objPHPExcel->getAllSheets();

		$arrayData = array();
		foreach ($sheet as $key => $value) {
			$lastrow = $value->getHighestRow();
			$sheet[$key]->getStyle('B1:B'.$lastrow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
			$arrayData = array_merge($arrayData, $sheet[$key]->toArray());
		}

		echo '
		<table id="tableConfirm" class="table">
			<thead>
				<tr>
					<th class="hidden"></th>
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

				echo '
				<tr>
					<td class="hidden">'.$id_pegawai.'</td>
					<td>'.$value[0].'</td>
					<td>'.$value[1].'</td>
					<td>'.$value[2].'</td>
					<td><input class="hitung" type="checkbox" value="1"></input></td>
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

	function hari_libur(){
		$data['libur']=$this->m_presensi->get_hari_libur();
		$this->load->view('v_hari_libur',$data); 
	}

	function upload(){
		// echo "awdawdawdawd";
		// $data = $_POST['data'];
		$data = $this->input->post('data');
		foreach ($data as $key => $value) {
			$tmp['ID_PEGAWAI']=$value[0];
			$tmp['TANGGAL']=$value[3];
			if ($value[4]=='true') {
				$tmp['HITUNG']=1;
			}else{
				$tmp['HITUNG']=0;
			}
			$tmp['ID_USER_INPUT']= $this->session->userdata('id_user');
			$insertData[]=$tmp;
		}
		
		$count=0;
		foreach ($insertData as $key => $value) {
			$res = $this->m_presensi->insert_presensi($value);
			$count = $count + $res;
		}
		var_dump($count);
	}
	function form_libur(){
		$this->load->view('v_form_libur');
	}

		function insert_libur(){
		$tanggal=$this->input->post('tanggal');
		$this->m_presensi->insert_libur($tanggal);
		$data['libur']=$this->m_presensi->get_hari_libur();
		$data['pesan']="Data Berhasil Dimasukkan";
		$this->load->view('v_hari_libur',$data); 
	}

	function delete_hari_libur(){
		$array_del = $this->input->post('array_del');
		$res = $this->m_presensi->delete_hari_libur($array_del);

		if ($res>0) {
			$data['pesan']="Data berhasil dihapus";
			$data['libur']=$this->m_presensi->get_hari_libur();
		
			$this->load->view('v_hari_libur',$data); 
		}else{
			echo "Error";
		}
	}

	function form_delete_hari_libur(){
		$this->load->view('v_form_delete_hari_libur');
	}
}