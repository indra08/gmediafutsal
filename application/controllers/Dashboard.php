<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->library('upload');
	}
	  
	public function index()
	{
        $this->Main_model->get_login();
		$data['title']  = 'Dashboard';
		$data['jml_futsal'] = $this->Main_model->jumlah_pendaftar_futsal();
		$data['jml_cheers'] = $this->Main_model->jumlah_pendaftar_cheer();
		$this->load->view('admin/head', $data);
		$this->load->view('admin/menu', $this->Main_model->menu());
		$this->load->view('admin/body', $data);
	}
}