<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_admin extends CI_Controller{

	function test(){
		$this->load->view('test');
		// $this->load->library('Excelfile');

		// $excelFile = "./uploads/dummy.csv";

		// $objPHPExcel = PHPExcel_IOFactory::load($excelFile);
		// foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		// 	$arrayData = $worksheet->toArray();
		// }
		// echo "
		// 	<table>

		// ";
		// foreach ($arrayData as $key => $value) {
		// 	// var_dump($value);
		// 	echo "
		// 		<tr>
		// 			<td>".$value[0]."</td>
		// 			<td>".$value[1]."</td>
		// 			<td>".$value[2]."</td>
		// 		</tr>
		// 	";
		// }

		// echo "</table>";

	}

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		 $this->load->helper(array('form', 'url'));

		// Load form validation library
		// $this->load->lxibraryibrary('form_validation');

		// Load session library
		// $this->load->library('session');

		// Load database
		$this->load->model('m_admin');
	}

	function error_authority(){
		$this->load->view('v_error_access');
	}

	function index() {
		$this->load->view('v_admin_home');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('c_login','refresh');
	}

	function pegawai(){
		$this->load->view('v_admin_pegawai');
	}


	function rapat(){
		$this->load->view('v_header_rapat');

		if($this->session->userdata('otoritas')==2){
			$this->load->view('v_ver_rapat');
		}
		else if($this->session->userdata('otoritas')==1){ 

			$this->load->view('v_admin_rapat');
		}


	}

	function peserta($id_rapat){
		$data['rapat']=$this->m_admin->get_one_rapat($id_rapat);
		$this->load->view('v_header_rapat');
		$this->load->view('v_admin_peserta_rapat',$data);

	}

	function lihatPeserta($id_rapat){
		$data['rapat']=$this->m_admin->get_one_rapat($id_rapat);
		$this->load->view('v_header_rapat');
		$this->load->view('v_admin_detail_peserta',$data);

	}
	function presensi(){
		$this->load->view('v_header_presensi');
	
		if($this->session->userdata('otoritas')==2){
				$this->load->view('v_ver_presensi');
		}
		else if($this->session->userdata('otoritas')==1){ 
		
			$this->load->view('v_admin_presensi');
		}
		else if($this->session->userdata('otoritas')==3){ 
		
			$this->load->view('v_user_presensi');
		}
	}


	function user(){
		// $data1['dataPegawai']= $this->m_admin->get_pegawai();
		// $data2['v_table_pegawai'] = $this->load->view('v_table_pegawai', $data1, true);
		// var_dump($dataPegawai);
		$this->load->view('v_admin_user');
	}

	function non_pegawai(){
		$this->load->view('v_admin_non');
	}


	function form_insert_rapat(){
		$this->load->view('v_form_insert_rapat');
	}
	function form_rapat(){
		$data['ruang'] = $this->m_admin->get_ruang();
		$this->load->view('v_form_rapat',$data);
	}

	function form_pegawai(){
		$data['satker'] = $this->m_admin->get_sk();
		$this->load->view('v_form_pegawai', $data);
	}

	function form_user(){
		$data['pegawai']= $this->m_admin->get_pegawai();
		// var_dump($data);
		$this->load->view('v_form_user', $data);
	}
	function form_non(){
		$this->load->view('v_form_non');
	}


	function form_delete_pegawai(){
		$this->load->view('v_delete_pegawai');
	}

	function form_delete_user(){
		$this->load->view('v_delete_user');
	}

	function form_delete_non(){
		$this->load->view('v_delete_non');
	}


	function form_delete_rapat(){
		$this->load->view('v_delete_rapat');
	}
	function form_delete_peserta_rapat(){
		$this->load->view('v_delete_peserta_rapat');
	}

	function insert_pegawai(){
		$data['NIP'] = $this->input->post('nomor');
		$data['NAMA'] = $this->input->post('nama');
		$data['ID_SATKER'] = $this->input->post('satker');
		$data['STATUS'] = 1;
		$res = $this->m_admin->insert_pegawai($data);
		// var_dump($data);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}


	function insert_rapat(){
		$tanggal = $this->input->post('tanggal');
		$waktu = $this->input->post('waktu');
		$date=$tanggal." ".$waktu;

		$data['WAKTU_RAPAT'] =date('Y-m-d H:i',strtotime($date));
		// $data['WAKTU_RAPAT'] = DateTime::createFromFormat('d-m-Y H:i', $date)->format('d-m-Y H:i');
		// $data['WAKTU_RAPAT'] = DateTime::createFromFormat('d/m/Y H:i', $date);
		 // var_dump($data['WAKTU_RAPAT']);
		$data['JUDUL_RAPAT']=$this->input->post('judul');
		$data['ID_RUANG'] = $this->input->post('ruang');
		$data['ID_USER_INPUT']= $this->session->userdata('id_user');
		date_default_timezone_set('Asia/Jakarta');
		$data['DATE_MODIFIED']=date('Y-m-d H:i:s');

		//BELUM BISA GANTI STATUS OTOMATIS
		$data['STATUS']= 1;

		// Belum bisa nambah peserta. konfigurasi ulang database untuk nambah peserta pegawai maupun non pegawai
		// $data['PESERTA_RAPAT'] = $this->input->post('peserta');
		// $res2= $this->m_admin->insert_peserta($data);


		// var_dump($data);
		$res = $this->m_admin->insert_rapat($data);
		// var_dump($res);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function insert_peserta(){
		$id_peserta=$this->input->post('array_del');
		$id_rapat=$this->input->post('id_rapat');
		$res=$this->m_admin->insert_peserta($id_peserta,$id_rapat);
		if ($res) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}

	}

	function update_user(){
		$data['ID_USER'] = $this->input->post('id_user');
		// $data['ID_PEGAWAI'] = $this->input->post('pegawai');
		$data['PASSWORD'] = $this->input->post('password');
		$data['OTORITAS'] = $this->input->post('otoritas');
		$res = $this->m_admin->update_user($data);
		// var_dump($data);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function update_pegawai(){
		$data['ID_PEGAWAI'] = $this->input->post('id');
		$data['NIP'] = $this->input->post('nomor');
		$data['NAMA'] = $this->input->post('nama');
		$data['ID_SATKER'] = $this->input->post('satker');
		$res = $this->m_admin->update_pegawai($data);
		// var_dump($data);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function update_non(){
		$data['ID'] = $this->input->post('id');
		$data['NAMA'] = $this->input->post('nama');
		$data['INSTITUSI'] = $this->input->post('institusi');
		$res = $this->m_admin->update_non($data);
		// var_dump($data);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function update_rapat(){
		$data['ID_RAPAT'] = $this->input->post('id');
		$data['JUDUL_RAPAT'] = $this->input->post('judul');
		$date=$this->input->post('tanggal')." ".$this->input->post('waktu');
		$data['WAKTU_RAPAT'] =date('Y-m-d H:i',strtotime($date));
		$data['ID_RUANG'] = $this->input->post('ruang');
		date_default_timezone_set('Asia/Jakarta');
		$data['DATE_MODIFIED']=date('Y-m-d H:i:s');
		$res = $this->m_admin->update_rapat($data);
		// var_dump($data);
		if ($res) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}
	function insert_user(){

		$data['ID_PEGAWAI'] = $this->input->post('pegawai');
		$data['PASSWORD'] = $this->input->post('password');
		$data['OTORITAS'] = $this->input->post('otoritas');
		$data['STATUS'] = 1;
		$hasil = $this->m_admin->get_one_pegawai($data['ID_PEGAWAI']);
		$data['USERNAME'] = $hasil->NIP;
		// var_dump($data);
		$res = $this->m_admin->insert_user($data);
		// var_dump($res);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function insert_non(){

		$data['NAMA'] = $this->input->post('nama');
		$data['INSTITUSI'] = $this->input->post('institusi');
		// var_dump($hasil);
		$res = $this->m_admin->insert_non($data);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function delete_pegawai(){
		$array_del = $this->input->post('array_del');
		$res = $this->m_admin->delete_pegawai($array_del);

		if ($res>0) {
			$this->load->view('v_sukses_modal');
		}else{
			echo "Error";
		}
	}

	function delete_user(){
		$array_del = $this->input->post('array_del');
		// var_dump($array_del);
		$res = $this->m_admin->delete_user($array_del);
		if ($res>0) {
			$this->load->view('v_sukses_modal');
		}else{
			echo 'error';
		}

	}

	function delete_non(){
		$array_del = $this->input->post('array_del');
		$res = $this->m_admin->delete_non($array_del);
		if ($res>0) {
			$this->load->view('v_sukses_modal');
		}else{
			echo 'error';
		}


	}

	function delete_rapat(){
		$array_del = $this->input->post('array_del');
		$this->m_admin->delete_rapat($array_del);
		$this->load->view('v_sukses_modal');
	}

	function delete_peserta($id_rapat){
		$array_del = $this->input->post('array_del');
		$this->m_admin->delete_peserta($array_del,$id_rapat);
		$this->load->view('v_sukses_modal');
	}

	function edit_form_pegawai(){
		$id_pegawai = $this->input->post('id_edit');
		$data['satker'] = $this->m_admin->get_sk();
		$data['pegawai'] = $this->m_admin->get_one_pegawai($id_pegawai);
		// var_dump($data);
		$this->load->view('v_edit_pegawai', $data);
	}

	function edit_form_user(){
		$id_user = $this->input->post('id_edit');
		$data['user'] = $this->m_admin->get_one_user($id_user);
		$data['pegawai']= $this->m_admin->get_pegawai();

		$this->load->view('v_edit_user', $data);
	}

	function edit_form_non(){
		$id_non = $this->input->post('id_edit');

		$data['non'] = $this->m_admin->get_one_non($id_non);

		$this->load->view('v_edit_non', $data);
	}

	function edit_form_rapat(){
		$id_rapat = $this->input->post('id_edit');
		$data['rapat'] = $this->m_admin->get_one_rapat($id_rapat);
		$data['ruang']= $this->m_admin->get_ruang();

		//mengambil list seluruh peserta rapat
		//still work in progress
		// $data['rapat'] = $this->m_admin->get_peserta_rapat_by_id_rapat($id_rapat);


		// var_dump($data);
		$this->load->view('v_edit_rapat', $data);
	}


	function get_table_pegawai(){
		$data= $this->m_admin->get_pegawai();

		echo json_encode($data);
	}

	function get_table_user(){
		$data= $this->m_admin->get_user();

		echo json_encode($data);
	}

	function get_table_non(){
		$data= $this->m_admin->get_non();

		echo json_encode($data);
	}

	function get_table_rapat(){
		$data= $this->m_admin->get_rapat();
		//cara edit data untuk JS ke PHP, edit di url yang dipanggil ajax
//		foreach($data as $key=>$value){
			// $value->NAMA_RUANG="RUANG ".$value->NAMA_RUANG;
		// }
		// var_dump($data);
		echo json_encode($data);

	}
	function get_table_all_entitas($id_rapat){
		$data= $this->m_admin->get_all_entitas($id_rapat);
		echo json_encode($data);
	}

	function get_table_detail_peserta($id_rapat){
		$data= $this->m_admin->get_detail_peserta($id_rapat);
		echo json_encode($data);
	}

	function landing() {
		// $this->m_admin->update_status_rapat();
		// $dataRapat =$this->m_admin->get_rapat();
		// var_dump($dataRapat);
		$this->load->view('v_header_welcome');
		// foreach($dataRapat as $key =>$value){
		// 	$data['rapat'] = $value;
		// 	$data['peserta']=$this->m_admin->get_detail_peserta($value->ID_RAPAT);

		// 	$this->load->view('v_rapat',$data);
		// }
		// $this->load->view('v_landing_foot');
	}

	function form_verif(){

		// $waktu_rapat = $this->input->post('waktu_rapat');
		$id_rapat = $this->input->post('id_rapat');
		$waktu_rapat =$this->m_admin->get_waktu_by_id_rapat($id_rapat);
		foreach($waktu_rapat as $key =>$value){
			$data['waktu']=$this->m_admin->get_rapat_by_waktu($value->WAKTU_RAPAT);

			$data['tanggal']=date('Y-m-d',strtotime($value->WAKTU_RAPAT));
			$data['tanggal_lengkap']=$value->WAKTU_RAPAT;
			$data['id']=$id_rapat;
			$this->load->view('v_form_verif',$data);
		}
	}

	function verifikasi_rapat($id_rapat){
		$res=$this->m_admin->verifikasi_rapat($id_rapat);
		if ($res>0) {
			$this->load->view('v_sukses_modal_verif');
		}else{
			echo "Error";
		}

	}
	function test(){

		$this->load->library('Excelfile');

		$excelFile = "./uploads/tes.xlsx";

		$objPHPExcel = PHPExcel_IOFactory::load($excelFile);
		$objPHPExcel->getActiveSheet()->removeRow(1, 1);
		$objPHPExcel->getActiveSheet()->removeColumn('A');
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$arrayData = $worksheet->toArray();
		}
		echo "
			<table>

		";
		foreach ($arrayData as $key => $value) {
			// var_dump($value);
			if(ltrim($value[0]) == '' || ltrim($value[1]) == '' ) continue;
			// if(ltrim($value[1]) == '') continue;
			$tanggal=DateTime::createFromFormat('d/m/Y H:i', $value[1]);
			echo "
				<tr>
					<td>".$value[0]."</td>

					<td>".$tanggal->format('Y-m-d H:i')."</td>
				
				</tr>
			";
		}

		echo "</table>";

	}

	 public function do_upload()
        {
        	$id_bulan=$this->input->post('id_bulan');
	

        	date_default_timezone_set('Asia/Jakarta');
$date = date('mdYhis', time());

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'xls|xlsx';
                $config['max_size']             = 1500;
                $config['file_name']           = $this->session->userdata('id_user').'_'.$date;

                $this->load->library('Excelfile');


                $this->load->library('upload', $config);


                $this->load->view('v_header_presensi');

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('v_upload_gagal');
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());


//perlu metode buat menamdapatkan ekstensi dari file yang diupload. variabel dibawah masih menerima ekstensi xlsx saja
		$excelFile = "./uploads/".$config['file_name'].".xlsx";



		$objPHPExcel = PHPExcel_IOFactory::load($excelFile);
		$objPHPExcel->getActiveSheet()->removeRow(1, 1);
		$objPHPExcel->getActiveSheet()->removeColumn('A');
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$arrayData = $worksheet->toArray();
		}

		foreach ($arrayData as $key => $value) {
			// var_dump($value);
			if(ltrim($value[0]) == '' || ltrim($value[1]) == '' ) continue;
			// if(ltrim($value[1]) == '') continue;
			$tanggal=DateTime::createFromFormat('d/m/Y H:i', $value[1]);
			$dataAbs['ID_USER']=$value[0];
			$dataAbs['TANGGAL']=$tanggal->format('Y-m-d H:i');
			$dataAbs['ID_BULAN']=$id_bulan;
			$dataAbs['ID_USER_INPUT']=$this->session->userdata('id_user');
			$this->m_admin->insert_absen($dataAbs);
		}
		

                        $this->load->view('v_upload_sukses');
                       
                }
        }

        function rekap_absen(){
        	//parametrnya id_bulan untuk metod ini d
        	$id_bulan=$this->input->post('id_bulan2');
        	$this->load->view('v_header_presensi');
        	$this->load->view('v_header_rekap');
        	$id_absents=$this->m_admin->get_id_absen($id_bulan);//harus ada parameter bulan



        	//PREPARE FOR INSANITY, 3 TIMES FOREACH, 3 TIMES THE ITERATION, 3 TIMES THE CRAZINESS
        	foreach($id_absents as $key =>$value){
        		$tanggal_only=$this->m_admin->get_tanggal_absen($value->ID_USER,$id_bulan);
        	$counter_jam_lembur=0;
			foreach($tanggal_only as $key2 =>$value2){
        		$jamLembur=$this->m_admin->rekap_lembur($value2->ID_USER,$value2->TANGGAL,$id_bulan);
        		// var_dump($jamLembur);

        		foreach($jamLembur as $key3 =>$value3){
        			$jam=0;
        			if(($value3->JAM)<15){
        				$jam=15;
        			}
        			else { 
        				$jam=$value3->JAM;
        			}
        			$counter_jam_lembur=$counter_jam_lembur-15+$jam;
        		}
        		
        	}

        	    $data['lembur']=$counter_jam_lembur;
        		$data['absen']=$this->m_admin->rekap_absen($value->ID_USER,$id_bulan);
        		$this->load->view('v_rekap',$data);
        	}
        	$this->load->view('v_footer_rekap');

        }

}

