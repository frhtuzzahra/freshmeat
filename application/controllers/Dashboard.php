<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('status') == 'login') {
			$this->load->view('dashboard');
		} else {
			// $this->load->view('login');
			$this->load->view('landing');
		}
	}
}
