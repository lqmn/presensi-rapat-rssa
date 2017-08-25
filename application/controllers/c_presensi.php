<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_presensi extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_rapat');
	}
	function test(){

	}
}