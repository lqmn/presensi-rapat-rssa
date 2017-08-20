<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_rapat extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_rapat');
	}

	function index(){
		$this->load->view('v_admin_rapat');
	}

	function get_table_rapat(){
		$data = $this->m_rapat->get_rapat();
		echo json_encode($data);
	}

	function form_rapat(){
		$data['ruang'] = $this->m_rapat->get_ruang();
		$this->load->view('v_form_rapat',$data);
	}

	function insert_rapat(){
		$waktu = $this->input->post('waktu');
		$waktu = date_create_from_format('d/m/Y H:i', $waktu);
		$waktu = date_format($waktu,'Y-m-d H:i:s');

		$data['JUDUL_RAPAT'] = $this->input->post('judul');
		$data['WAKTU_RAPAT'] = $waktu;
		$data['ID_RUANG'] = $this->input->post('ruang');
		$data['ID_USER_INPUT'] = 1;

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


	function update_rapat(){
		$waktu = $this->input->post('waktu');
		$waktu = date_create_from_format('d/m/Y H:i', $waktu);
		$waktu = date_format($waktu,'Y-m-d H:i:s');

		$data['ID_RAPAT'] = $this->input->post('id');
		$data['JUDUL_RAPAT'] = $this->input->post('judul');
		$data['WAKTU_RAPAT'] = $waktu;
		$data['ID_RUANG'] = $this->input->post('ruang');
		$data['ID_USER_INPUT'] = 1;
		$data['STATUS_AKTIVASI'] = $this->input->post('verif');

		$res = $this->m_rapat->update_rapat($data);
		if ($res>0) {
			$this->load->view('v_sukses_modal_insert');
		}else{
			echo "Error";
		}
	}

	function form_peserta(){
		$data['id_rapat'] = $this->input->post('id_edit');
		// $data['peserta'] = $this->m_rapat->get_peserta_by_rapat($id_rapat);
		// var_dump($data);
		$this->load->view('v_form_peserta', $data);
	}

	function get_table_peserta(){
		$id_rapat = $this->input->post('id_edit');
		$data = $this->m_rapat->get_peserta_by_rapat($id_rapat);
		echo json_encode($data);
	}
}