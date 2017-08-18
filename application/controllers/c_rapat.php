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
		$data = $this->m_rapat->getRapat();
		// $peserta = $this->m_rapat->getPeserta();

		echo json_encode($data);

	}
}