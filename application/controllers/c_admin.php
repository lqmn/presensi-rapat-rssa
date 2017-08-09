<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		// Load form validation library
		// $this->load->library('form_validation');

		// Load session library
		// $this->load->library('session');

		// Load database
		$this->load->model('m_admin');
	}

	function index() {
		$this->load->view('v_admin_home');
	}

	function pegawai(){
		// $data1['dataPegawai']= $this->m_admin->get_pegawai();
		// $data2['v_table_pegawai'] = $this->load->view('v_table_pegawai', $data1, true);
		$this->load->view('v_admin_pegawai');
		// $this->load->view('v_admin_non');
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

	function form_pegawai(){
		$data['satker'] = $this->m_admin->get_sk();
		$this->load->view('v_form_pegawai', $data);
	}

	function form_user(){
		$this->load->view('v_form_user');
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

	function insert_pegawai(){
		$data['NIP'] = $this->input->post('nomor');
		$data['NAMA'] = $this->input->post('nama');
		$data['ID_SATKER'] = $this->input->post('satker');
		$data['STATUS'] = 1;
		$res = $this->m_admin->insert_pegawai($data);
		// var_dump($data);
		if ($res) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function update_user(){
		$data['ID_USER'] = $this->input->post('id');
		$data['NIP_PEGAWAI'] = $this->input->post('nip');
		$data['NAMA_USER'] = $this->input->post('nama');
		$data['PASSWORD'] = $this->input->post('password');
		$data['OTORITAS'] = $this->input->post('otoritas');
		$data['STATUS'] = $this->input->post('status');
		$res = $this->m_admin->update_user($data);
		// var_dump($data);
		if ($res) {
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
		if ($res) {
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
		if ($res) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}
	function insert_user(){
		
		$data['NIP_PEGAWAI'] = $this->input->post('nip');
		
		$data['PASSWORD'] = $this->input->post('password');
		$data['OTORITAS'] = $this->input->post('otoritas');
		$data['STATUS'] = 1;
		$hasil = $this->m_admin->get_one_pegawai_nip($data['NIP_PEGAWAI']);
		$data['ID_USER'] = $hasil->ID_PEGAWAI;
		$data['NAMA_USER'] = $hasil->NAMA;
		// var_dump($hasil);
		$res = $this->m_admin->insert_user($data);
		if ($res) {
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
		if ($res) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function delete_pegawai(){
		// $array_del = filter_input(INPUT_POST, 'array_del', FILTER_SANITIZE_STRING);
		$array_del = $this->input->post('array_del');
		// var_dump($array_del);
		$this->m_admin->delete_pegawai($array_del);
		// var_dump($data);
		// if ($res) {
		$this->load->view('v_sukses_modal');
		// }else{
		// 	echo "Error";
		// }
	}

	function delete_user(){
		$array_del = $this->input->post('array_del');
		// var_dump($array_del);
		$this->m_admin->delete_user($array_del);
		$this->load->view('v_sukses_modal');

	}

	function delete_non(){
		$array_del = $this->input->post('array_del');
		$this->m_admin->delete_non($array_del);
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
		
		$this->load->view('v_edit_user', $data);
	}
	
	function edit_form_non(){
		$id_non = $this->input->post('id_edit');
		
		$data['non'] = $this->m_admin->get_one_non($id_non);
		
		$this->load->view('v_edit_non', $data);
	}
	function get_table_pegawai(){
		$data= $this->m_admin->get_pegawai();

		echo json_encode($data);
	}


	function get_table_pegawai_test(){
		$data= $this->m_admin->get_pegawai();
		$data->check_box = '<input type="checkbox" class="select" name="id[]" value="$data->ID_PEGAWAI">';
		var_dump($data);
		// echo json_encode($data);
	}

	function get_table_user(){
		$data= $this->m_admin->get_user();
		
		

		echo json_encode($data);
	}
	
	function get_table_non(){
		$data= $this->m_admin->get_non();
		
		

		echo json_encode($data);
	}
}