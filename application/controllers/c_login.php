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

	// Show login page
	function index() {
		// echo 'KWADOKAWOD';
		redirect('c_admin/landing','refresh');
		
	}
	function welcome(){
		$this->load->view('v_login');
	}

	// Show registration page
	// public function user_registration_show() {
	// 	$this->load->view('registration_form');
	// }

	// Validate and store registration data in database
	// public function new_user_registration() {

	// 	// Check validation for user input in SignUp form
	// 	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	// 	$this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean');
	// 	$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	// 	if ($this->form_validation->run() == FALSE) {
	// 	$this->load->view('registration_form');
	// 	} else {
	// 	$data = array(
	// 	'user_name' => $this->input->post('username'),
	// 	'user_email' => $this->input->post('email_value'),
	// 	'user_password' => $this->input->post('password')
	// 	);
	// 	$result = $this->login_database->registration_insert($data);
	// 	if ($result == TRUE) {
	// 	$data['message_display'] = 'Registration Successfully !';
	// 	$this->load->view('v_login', $data);
	// 	} else {
	// 	$data['message_display'] = 'Username already exist!';
	// 	$this->load->view('registration_form', $data);
	// 	}
	// 	}
	// }

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
			// echo "admin";
			redirect('c_admin', 'refresh');
		}elseif ($this->session->userdata('otoritas')==2) {
			redirect('c_admin/rapat','refresh');
		}elseif ($this->session->userdata('otoritas')==3) {
			echo "user";
		}
	}

	// Logout from admin page
	function logout() {
		// Removing session data
		$sess_array = array(
			'username' => ''
			);
		$this->session->unset_userdata('authority', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('v_login', $data);
	}
}