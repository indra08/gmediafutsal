<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tebakskor extends CI_Controller {
    public function __construct(){
		parent::__construct();
		$this->load->model('Main_model');
		ini_set('memory_limit', '-1');
	}
	
    public function index() {
        $data['js'] = 'custom.js';
		$data['url_banner']         = base_url().'frontend/images/banner_futsal.jpg';
		$this->load->view('frontend/head', $data);
		$this->load->view('frontend/tebak_skor', $data);
		$this->load->view('frontend/foot', $data);
    }
    
    function ajax_data_tebak_skor()
    {
        $this->Main_model->ajax_function();
        $data = $this->Main_model->data_tebak_skor_view();
            $arr = array();
			$no = 1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$arr[$row] = array(
									'no' 	=> $no++,
									'nama' => $val->nama,
									'skor'	=> $val->skor1.' - '.$val->skor2,
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
    }
    
    function ajax_add_tebak_skor()
    {
        $this->Main_model->ajax_function();
        $skor_tim_1 = $this->input->post('skor1');
		$skor_tim_2 = $this->input->post('skor2');
		$nama = $this->input->post('nama');
		$no_hp = $this->input->post('no_hp');
		
		if($skor_tim_1 == '' || $skor_tim_2 == '' || $nama == '' || $no_hp == '') {
			$message = '<div class="alert alert-warning" role="alert">';
			if($skor_tim_1 == '') $message .= 'Skor Tim Bergerak Bersama harus diisi <br>';
			if($skor_tim_2 == '') $message .= 'Skor Tim Semarang Hebat  harus diisi <br>';
			if($nama == '') $message .= 'Nama harus diisi <br>';
			if($no_hp == '') $message .= 'Nomor Handphone harus diisi <br>';
			$message.= '</div>';
			$respon  = array('status' => FALSE, 'message' => $message);
			echo json_encode($respon);exit;
		}
		
		$data = array(
		    'nama' => $nama,
		    'no_hp' => $no_hp,
		    'skor1' => $skor_tim_1,
		    'skor2' => $skor_tim_2
		);
		
		$this->Main_model->process_data('tb_tebak_skor', $data);
		$respon  = array(
		          'status' => TRUE, 
				  'message' => '<div class="alert alert-success" role="alert">Tebak Skor berhasil disimpan. </div>'
		);
		
		echo json_encode($respon);

    }
    

}
?>