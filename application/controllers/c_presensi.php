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

	function isValidCell($cell){
		if ($cell[0]!='Nama' AND $cell[0]!=null AND $cell[1]!='NIP / NBI' AND $cell[1]!=null AND $cell[2]!='Waktu' AND $cell[2]!=null) {
			return true;
		}else{
			false;
		}
	}

	function cariAbsenPegawai($data,$date){
		$result = array();
		foreach ($data as $key => $value) {
			if (explode(' ',$value[2])[0]==$date) {
				$result[] =$value;
			}
		}
		return $result;

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

		// proses array
		$dataExcel = array();
		foreach ($arrayData as $key => $value) {
			if ($this->isValidCell($value)) {
				if (strlen(explode(' ',$value[2])[0])<10) {

					$date = date_create_from_format('n/j/y H:i', $value[2]);
					$date = date_format($date,'Y-m-d H:i:s');
					$value[2] = $date;
				}else{
					$date = date_create_from_format('d/m/Y H:i', $value[2]);
					$date = date_format($date,'Y-m-d H:i:s');
					$value[2] = $date;
				}
				$row['NAMA']=$value[0];
				$row['NIP']=$value[1];
				$row['TANGGAL']=$value[2];
				$dataExcel[] = $row;
			}
		}
		$data = $this->m_presensi->get_presensi_perhari($dataExcel);

		echo '
		<table id="tableConfirm" class="table">
			<thead>
				<tr>
					<th class="hidden"></th>
					<th>Nama</th>
					<th>NIP</th>
					<th>Tanggal</th>
					<th>Lembur</th>
					<th>Hitung Lembur?</th>
				</tr>
			</thead>
			<tbody>
				';
				foreach ($data as $key => $value) {
					echo '
					<tr>
						<td class="hidden">'.$id_satker.'</td>
						<td>'.$value->NAMA.'</td>
						<td>'.$value->NIP.'</td>
						<td>'.$value->TANGGAL.'</td>
						<td>'.$value->LEMBUR.'</td>
						<td><input class="hitung" type="checkbox"></td>
					</tr>
					';
				}

				echo "
			</tbody>
		</table>
		";

		unlink($target);
	}

	function form_upload(){
		$data['satker'] = $this->m_presensi->get_satker();
		$this->load->view('v_form_upload', $data); 
	}

	function upload(){
		$data = $this->input->post('data');

		foreach ($data as $key => $value) {
			$dataPegawai['NAMA']=$value[1];
			$dataPegawai['NIP']=$value[2];
			$dataPegawai['ID_SATKER']=$value[0];

			$id_pegawai = $this->m_presensi->get_id_pegawai($dataPegawai);
			if (!$id_pegawai) {
				$this->m_presensi->insert_pegawai($dataPegawai);
				$id_pegawai = $this->m_presensi->get_id_pegawai($dataPegawai);
			}
			$tmp['ID_PEGAWAI']=$id_pegawai;

			$tmp['TANGGAL']=$value[3];
			$tmp['LEMBUR']=$value[4];
			if ($value[5]=='true') {
				$tmp['HITUNG']=1;
			}else{
				$tmp['HITUNG']=0;
			}
			$tmp['ID_USER_INPUT']= $this->session->userdata('id_user');
			$insertData[]=$tmp;
		}
		
		$count=0;
		foreach ($insertData as $key => $value) {
			$dataPresensi['ID_PEGAWAI'] = $value['ID_PEGAWAI'];
			$dataPresensi['TANGGAL'] = $value['TANGGAL'];

			$id_presensi = $this->m_presensi->get_id_presensi($dataPresensi);
			if (!$id_presensi) {
				$this->m_presensi->insert_presensi($value);
				$count++;
			}else{
				$updateData['LEMBUR'] = $value['LEMBUR'];
				$updateData['HITUNG'] = $value['HITUNG'];
				var_dump($id_presensi);
				$res = $this->m_presensi->update_presensi($id_presensi, $updateData);
				if ($res>0) {
					$count++;
				}
			}
		}
		echo '<p>'.$count.' data telah dimasukkan</p>';
	}

	function form_libur(){
		$this->load->view('v_form_libur');
	}

	function insert_libur(){
		$tanggal = $this->input->post('tanggal');
		$tanggal = date_create_from_format('d/m/Y', $tanggal);
		$tanggal = date_format($tanggal,'Y-m-d');

		$data['TANGGAL'] = $tanggal;
		$data['KETERANGAN'] = $this->input->post('ket');
		$data['ID_USER_INPUT'] = $this->session->userdata('id_user');
		$result = $this->m_presensi->insert_libur($data);
		var_dump($result);

	}

	function get_tabel_libur(){
		$data = $this->m_presensi->get_libur();
		echo json_encode($data);
	}

	function delete_libur(){
		$id_delete = $this->input->post('array_del');
		foreach ($id_delete as $key => $value) {
			$res= $this->m_presensi->delete_libur($value);
		}
	}

	// function get_presensi_rekap(){
	// 	$data = $this->m_presensi->get_presensi_for_rekap();
	// 	return $data
	// }

	function insert_update_rekap(){
		$data= $this->input->post('data');
	}

	function get_tabel_rekap(){
		$dataPresensi = $this->m_presensi->get_presensi_for_rekap();
		foreach ($dataPresensi as $key => $value) {
			$this->m_presensi->insert_update_rekap($value);
		}
		

		// $data = $this->m_presensi->get_rekap();
		// echo json_encode($data);

	}

	function upload_page(){
		$data['satker'] = $this->m_presensi->get_satker();
		$this->load->view('v_upload',$data);
	}

	function test(){
		$this->m_presensi->test();

	}
}