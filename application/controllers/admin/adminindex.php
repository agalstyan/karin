<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminIndex extends CI_Controller
{
	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/footer');
	}
}
