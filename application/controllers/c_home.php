<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class c_home extends CI_Controller {

	function index(){
		if ($this->session->userdata('otoritas')==1) {
			$this->load->view('v_admin_home');
		}elseif ($this->session->userdata('otoritas')==2) {
			$this->load->view('v_ver_home');

		}elseif ($this->session->userdata('otoritas')==3) {
			$this->load->view('v_user_home');
		}
	}
}
