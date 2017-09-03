<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class c_login extends CI_Controller {

	function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper(array('form','url'));

			// Load form validation library
		$this->load->library('form_validation');

			// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('m_login');
	}

	function index() {
		if($this->session->userdata('username')){
			$this->loginsuccess();
		}else{
			redirect('c_rapat/jadwal','refresh');
		}
	}

	// Check for user login process
	function user_login_process() {

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['authority'])){
				$this->loginsuccess();
				// $this->load->view('admin_page');
			}else{
				$this->load->view('v_login');
			}
		} else {
			$data = array(
				'USERNAME' => $this->input->post('username'),
				'PASSWORD' => $this->input->post('password')
				);
			$result = $this->m_login->login($data);

			if ($result!=false) {
				$result = $this->m_login->read_user_information($result);
				// var_dump($result);
				
				if ($result != false) {
					// var_dump($result);
					$session_data = array(
						'id_user' => $result->ID_USER,
						'id_pegawai' => $result->ID_PEGAWAI,
						'username' => $result->USERNAME,
						'otoritas' => $result->OTORITAS,
						'nama' => $result->NAMA,
						'nama_satker' => $result->NAMA_SATKER
						);
					// var_dump($session_data);

					// Add user data in session
					$this->session->set_userdata($session_data);
					$this->loginsuccess();
					// $this->load->view('admin_page');
				}
			} else {
				$data = array(
					'error_message' => 'Invalid Username or Password'
					);
				$this->load->view('v_login', $data);
			}
		}
	}

	function loginsuccess(){
		if ($this->session->userdata('otoritas')==1) {
			$this->load->view('v_admin_home');
		}elseif ($this->session->userdata('otoritas')==2) {
			$this->load->view('v_verifikator_home');
		}elseif ($this->session->userdata('otoritas')==3) {
			$this->load->view('v_user_home');
		}
	}

	// Logout from admin page
	function logout() {
		$this->session->sess_destroy();
		redirect('c_login/login_form','refresh');
	}

	function proses_login(){
		$data = $this->input->post();
		$res = $this->m_login->login($data);
		if ($res==false) {
			echo "0";
			return;
		}else{
			$res = $this->m_login->read_user_information($res);
			var_dump($res);
			$session_data = array(
				'id_user' => $res->ID_USER,
				'id_pegawai' => $res->ID_PEGAWAI,
				'username' => $res->USERNAME,
				'otoritas' => $res->OTORITAS,
				'nama' => $res->NAMA,
				'nama_satker' => $res->NAMA_SATKER
				);
			$this->session->set_userdata($session_data);
			echo "1";
		}
	}

	function error_authority(){
		$this->load->view('v_error_access');
	}

	function login_form(){
		$this->load->view('v_login');
	}
}