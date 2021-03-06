<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_rapat extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_rapat');
	}

	function index(){
		if ($this->session->userdata('otoritas')==1) {
			$this->load->view('v_admin_rapat');
		}elseif ($this->session->userdata('otoritas')==2) {
			$this->load->view('v_verifikator_rapat');
		}elseif ($this->session->userdata('otoritas')==3) {
			$this->load->view('v_user_rapat');
		}else{
			redirect('c_login/error_authority/','refresh');
		}
	}

	function get_table_rapat(){
		$data = $this->m_rapat->get_rapat();
		echo json_encode($data);
	}

	function form_rapat(){
		$data['ruang'] = $this->m_rapat->get_ruang();
		// var_dump($data);
		$this->load->view('v_form_rapat',$data);
	}


	function insert_rapat(){
		$waktu = $this->input->post('tanggal').' '.$this->input->post('waktu');

		$waktu = date_create_from_format('d/m/Y H:i', $waktu);
		$waktu = date_format($waktu,'Y-m-d H:i:s');

		$data['JUDUL_RAPAT'] = $this->input->post('judul');
		$data['WAKTU_RAPAT'] = $waktu;
		$data['ID_RUANG'] = $this->input->post('ruang');
		$data['ID_USER_INPUT'] = $this->session->userdata('id_user');

		$result = $this->m_rapat->insert_rapat($data);
		if ($result>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function edit_form_rapat(){
		$id_rapat = $this->input->post('id_edit');
		$data['rapat'] = $this->m_rapat->get_one_rapat($id_rapat);

		$waktu = $data['rapat']->WAKTU_RAPAT;
		$waktu = date_create_from_format('Y-m-d H:i:s', $waktu);
		$waktu = date_format($waktu,'d/m/Y H:i');
		$data['rapat']->WAKTU_RAPAT = $waktu;

		$data['ruang']= $this->m_rapat->get_ruang();

		$this->load->view('v_edit_rapat', $data);
	}

	function delete_peserta(){
		$id_delete = $this->input->post('array_del');
		$res= $this->m_rapat->delete_peserta($id_delete);
	}

	function update_rapat(){
		$waktu = $this->input->post('tanggal').' '.$this->input->post('waktu');
		$waktu = date_create_from_format('d/m/Y H:i', $waktu);
		$waktu = date_format($waktu,'Y-m-d H:i:s');

		$data['ID_RAPAT'] = $this->input->post('id');
		$data['JUDUL_RAPAT'] = $this->input->post('judul');
		$data['WAKTU_RAPAT'] = $waktu;
		$data['ID_RUANG'] = $this->input->post('ruang');
		$data['ID_USER_INPUT'] = $this->session->userdata('id_user');;
		// $data['STATUS_AKTIVASI'] = $this->input->post('verif');

		$res = $this->m_rapat->update_rapat($data);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function form_peserta(){
		$data['id_rapat'] = $this->input->post('id_edit');
		$this->load->view('v_form_peserta', $data);
	}

	function get_table_peserta(){
		$id_rapat = $this->input->post('id_edit');
		$data = $this->m_rapat->get_peserta_by_rapat($id_rapat);
		echo json_encode($data);
	}

	function get_table_all_peserta_pegawai(){
		$id_rapat = $this->input->post('id_edit');
		$data = $this->m_rapat->get_all_pegawai($id_rapat);
		echo json_encode($data);
	}

	function tambah_peserta_pegawai(){
		$id_pegawai = $this->input->post('id_pegawai');
		$id_rapat = $this->input->post('id_rapat');
		$res= $this->m_rapat->tambah_peserta_pegawai($id_pegawai,$id_rapat);
	}

	function get_table_all_peserta_non(){
		$id_rapat = $this->input->post('id_edit');
		$data = $this->m_rapat->get_all_non($id_rapat);
		echo json_encode($data);
	}

	function tambah_peserta_non(){
		$id_non = $this->input->post('id_non');
		$id_rapat = $this->input->post('id_rapat');
		$res= $this->m_rapat->tambah_peserta_non($id_non,$id_rapat);
	}

	function form_delete_rapat(){
		$this->load->view('v_delete_rapat');
	}

	function delete_rapat(){
		$id_rapat = $this->input->post('array_del');
		$res = $this->m_rapat->delete_rapat($id_rapat);
		if ($res>0) {
			$this->load->view('v_sukses_modal');
		}else{
			echo "Error";
		}
	}

	function form_verif(){
		$id_rapat = $this->input->post('id_rapat');
		$status = (int)$this->m_rapat->get_rapat_status_by_id($id_rapat);
		if ($status==1) {
			echo '<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	
</div>

<div class="modal-body">

	<form id="formModalDelete"class="form-horizontal" action="">
		
		<h3> Rapat sudah diverifikasi</h3>
		
	</div>
	<div class="modal-footer">
		
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	</form>

</div>';
		}else{
			$waktu_rapat = $this->m_rapat->get_waktu_by_id_rapat($id_rapat);
			$tanggal_rapat = explode(' ',$waktu_rapat)[0];

			$data['waktu'] = $this->m_rapat->get_rapat_by_waktu($tanggal_rapat);
			$data['tanggal']=$tanggal_rapat;
			$data['tanggal_lengkap']=$waktu_rapat;
			$data['id']=$id_rapat;
			$this->load->view('v_form_verif',$data);
		}
	}

	function verifikasi_rapat($id_rapat){
		$res=$this->m_rapat->verifikasi_rapat($id_rapat);
		if ($res>0) {
			$this->load->view('v_sukses_modal_verif');
		}else{
			echo "Error";
		}
	}

	function guest_data_peserta($id_rapat){
		$res = $this->m_rapat->get_peserta_by_rapat($id_rapat);
		echo json_encode($res);
	}

	function guest_data_rapat(){
		$res = $this->m_rapat->get_rapat_guest();
		// var_dump($res);
		foreach ($res as $key => $value) {
			$date = date_create_from_format('Y-m-d H:i:s', $value->WAKTU_RAPAT);
			// $tanggal = date_format($date,'d');
			// $bulan = date_format($date,'F');
			// $tahun = date_format($date,'Y');
			$tmp = date_format($date,'d F Y');
			$tmp = $tmp.', pukul '.date_format($date,'H:i');
			$res[$key]->WAKTU_RAPAT = $tmp;
		}
		echo json_encode($res);
	}

	function jadwal(){
		$this->load->view('v_guest');
	}
	function jadwal_detail(){
		$this->load->view('v_guest_detail');
	}
}