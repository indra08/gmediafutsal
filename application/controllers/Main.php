<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Pendaftar_model');
		$this->load->library('upload');
		ini_set('memory_limit', '-1');
	}
	  
	public function index()
	{
		$data['title'] 				= 'Gmedia Corporate Fun Futsal Competition';
		$data['rule_pertandingan'] 	= $this->Main_model->list_ketentuan_pertandingan();
		$data['rule_peserta'] 		= $this->Main_model->list_ketentuan_peserta();
		$data['pasal_bpjs'] 		= $this->Main_model->list_pasal_bpjs();
		$data['lokasi'] 			= $this->Main_model->get_lokasi_pertandingan();
		$data['list_hadiah'] 		= $this->Main_model->list_hadiah();
		$data['js'] 		 		= 'custom.js';
		$data['josb_id']			= $this->Main_model->random_word(8);
		$data['url_banner']         = base_url().'frontend/images/banner_futsal.jpg';
		$this->load->view('frontend/head', $data);
		$this->load->view('frontend/body', $data);
		$this->load->view('frontend/foot', $data);
	}

	function ajax_data_perusahaan()
	{
		$this->Main_model->ajax_function();
		$jobs_id = $this->input->get('q');
		$data = $this->Main_model->view_by_id('temp_tb_perusahaan', array('jobs_id'=>$jobs_id),'result');
			$arr = array();
			$no = 1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$arr[$row] = array(
									'nama' 	=> $val->nama_perusahaan,
									'brand' => $val->nama_brand,
									'tim'	=> $val->nama_tim,
									'email' => $val->email,
									'act' => '<a title="Edit" href="javascript:;" onclick="edt_1('.$val->id.')"><i class="fa fa-pencil"></i></a>'
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_data_official()
	{
		$this->Main_model->ajax_function();
		$jobs_id = $this->input->get('q');
		$data = $this->Main_model->view_by_id('temp_tb_anggota', array('jobs_id'=>$jobs_id),'result');
			$arr = array();
			$no = 1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$file_id_card = isset($val->file_id_card) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_bpjs    = isset($val->file_bpjs) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_pas_foto= isset($val->file_pas_foto) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_bpjs_sehat= isset($val->file_bpjs_kesehatan) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_ktp     = isset($val->file_ktp) ? '<b style="color:#19fc00;">V</b>':'-';
					$arr[$row] = array(
									'nama' 	 => $val->nama,
									// 'no_ktp' => $val->no_ktp,
									'no_hp'  => $val->no_hp,
									// 'no_bpjs'=> $val->no_bpjs,
									// 'no_bpjs_sehat'=> $val->no_bpjs_kesehatan,
									'file_ktp' => $file_ktp,
									'file_id_card' => $file_id_card,
									'file_bpjs'	   => $file_bpjs,
									'file_bpjs_sehat'=> $file_bpjs_sehat,
									'file_pas_foto'=> $file_pas_foto,
									'act'    => '<a title="Hapus" href="javascript:;" onclick="del_2('.$val->id.')"><i class="fa fa-trash"></i></a>'
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_data_inti()
	{
		$this->Main_model->ajax_function();
		$jobs_id = $this->input->get('q');
		$data = $this->Main_model->view_by_id('temp_tb_pemain', array('jobs_id'=>$jobs_id,'kategori'=>'inti'),'result');
			$arr = array();
			$no = 1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$file_id_card = isset($val->file_id_card) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_bpjs    = isset($val->file_bpjs) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_pas_foto= isset($val->file_pas_foto) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_bpjs_sehat = isset($val->file_bpjs_kesehatan) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_ktp     = isset($val->file_ktp) ? '<b style="color:#19fc00;">V</b>':'-';
					$arr[$row] = array(
									'nama' 	 => $val->nama,
									// 'no_ktp' => $val->no_ktp,
									// 'no_bpjs'=> $val->no_bpjs,
									// 'no_bpjs_kesehatan'=> $val->no_bpjs_kesehatan,
									'file_ktp' => $file_ktp,
									// 'file_id_card' => $file_id_card,
									'file_bpjs'	   => $file_bpjs,
									'file_bpjs_sehat' => $file_bpjs_sehat,
									'file_pas_foto'=> $file_pas_foto,
									'act'    => '<a title="Hapus" href="javascript:;" onclick="del_3('.$val->id.')"><i class="fa fa-trash"></i></a>'
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_data_cadangan()
	{
		$this->Main_model->ajax_function();
		$jobs_id = $this->input->get('q');
		$data = $this->Main_model->view_by_id('temp_tb_pemain', array('jobs_id'=>$jobs_id,'kategori'=>'cadangan'),'result');
			$arr = array();
			$no = 1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$file_id_card = isset($val->file_id_card) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_bpjs    = isset($val->file_bpjs) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_pas_foto= isset($val->file_pas_foto) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_bpjs_sehat= isset($val->file_bpjs_kesehatan) ? '<b style="color:#19fc00;">V</b>':'-';
					$file_ktp= isset($val->file_ktp) ? '<b style="color:#19fc00;">V</b>':'-';
					$arr[$row] = array(
									'nama' 	 => $val->nama,
									// 'no_ktp' => $val->no_ktp,
									// 'no_bpjs'=> $val->no_bpjs,
									// 'no_bpjs_kesehatan'=> $val->no_bpjs_kesehatan,
									'file_ktp' => $file_ktp,
									// 'file_id_card' => $file_id_card,
									'file_bpjs'	   => $file_bpjs,
									'file_bpjs_sehat'  => $file_bpjs_sehat,
									'file_pas_foto'=> $file_pas_foto,
									'act'    => '<a title="Hapus" href="javascript:;" onclick="del_4('.$val->id.')"><i class="fa fa-trash"></i></a>'
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_add_perusahaan()
	{
		$this->Main_model->ajax_function();
		$id  = $this->input->post('id_1');

		$jobs_id  = $this->input->post('jobs_id');
		$nama_perusahaan = $this->input->post('nama_perusahaan');
		$nama_tim = $this->input->post('nama_tim');
		$nama_brand = $this->input->post('nama_brand');
		$email = $this->input->post('email');

		if($nama_perusahaan == '' || $nama_tim == '' || $nama_brand == '' || $email == '') {
			$message = '<div class="alert alert-warning" role="alert">';
			if($nama_perusahaan == '') $message .= 'Form Nama Perusahaan harus di isi ! <br>';
			if($nama_tim == '') $message .= 'Form Nama Tim harus di isi ! <br>';
			if($nama_brand == '') $message .= 'Form Nama Brand Perusahaan harus di isi ! <br>';
			if($email == '') $message .= 'Form Email Perusahaan harus di isi ! <br>';
			$message.= '</div>';
			$respon  = array('status' => FALSE, 'message' => $message);
			echo json_encode($respon);exit;
		}

		if($id == '') {
			$check_temp = $this->Main_model->view_by_id('temp_tb_perusahaan', array('jobs_id'=>$jobs_id));
			if(!empty($check_temp)) {
				$respon  = array('status' => FALSE, 'message' => '<div class="alert alert-warning" role="alert">Data Perusahaan / Instansi berhasil anda sudah tersimpan. </div>');
				echo json_encode($respon);exit;
			}
		}

		$data = array(
					'nama_perusahaan' => $nama_perusahaan,
					'nama_brand' => $nama_brand,
					'nama_tim' => $nama_tim,
					'email' => $email,
					'jobs_id' => $jobs_id
				);
				
		if($id == '') {
			$this->Main_model->process_data('temp_tb_perusahaan', $data);
			$respon  = array('status' => TRUE, 
							'message' => '<div class="alert alert-success" role="alert">Data Perusahaan / Instansi berhasil di simpan. </div>');
			echo json_encode($respon);exit;
		} else {
			$this->Main_model->process_data('temp_tb_perusahaan', $data, array('id' => $id));
			$respon  = array('status' => TRUE, 
							'message' => '<div class="alert alert-success" role="alert">Data Perusahaan / Instansi berhasil di update. </div>');
			echo json_encode($respon);exit;
		}
	}

	function ajax_edit_perusahaan($id='')
	{
		$this->Main_model->ajax_function();
		$data = $this->Main_model->view_by_id('temp_tb_perusahaan', array('id'=>$id));
		echo json_encode($data);
	}

	function ajax_add_official()
	{
		$this->Main_model->ajax_function();
		$this->load->library('upload');
		$jobs_id  = $this->input->post('jobs_id');
		$id  = $this->input->post('id_2');

		$nama_lengkap  = $this->input->post('nama_lengkap1');
		$no_ktp    = $this->input->post('ektp1');
		$no_hp     = $this->input->post('no_hp1');
		$no_bpjs   = $this->input->post('no_bpjs1');
		$no_bpjs_sehat = $this->input->post('no_bpjs_sehat1');

		$dir_ktp   = "frontend/uploads/ktp/";
		$dir_idcard= "frontend/uploads/idcard/";
		$dir_bpjs  = "frontend/uploads/bpjs/";
		$dir_foto  = "frontend/uploads/foto/";
		
		$file_ktp  = $_FILES["file_ektp1"];
		// $file_idcard = $_FILES["id_card1"];
		$file_bpjs = $_FILES["bpjs1"];
		$file_foto = $_FILES["foto1"];
		$file_bpjs_sehat = $_FILES["bpjs_sehat1"];
		
		// validasi form kosong // 
		if($nama_lengkap == '' || $file_ktp["name"] == '' || $no_hp == '' || $file_bpjs["name"] == '' || $file_foto["name"] == '' || $file_bpjs_sehat["name"] == '') 
		{
			$message = '<div class="alert alert-warning" role="alert">';
			if($nama_lengkap == '') $message .= 'Form Nama Lengkap Anggota harus di isi ! <br>';
			if($file_ktp["name"] == '') $message .= 'Form File E-KTP Anggota harus di isi ! <br>';
			if($no_hp == '') $message .= 'Form Nomor Handphone Anggota harus di isi ! <br>';
			// if($no_bpjs == '') $message .= 'Form Nomor BPJS Ketenagakerjaan Anggota harus di isi ! <br>';
			// if($no_bpjs_sehat == '') $message .= 'Form Nomor BPJS Kesehatan Anggota harus di isi ! <br>';
			// if($file_idcard["name"] == '') $message .= 'Form File ID Card Anggota harus di isi ! <br>';
			if($file_bpjs["name"] == '') $message .= 'Form File BPJS Ketenagakerjaan Anggota harus di isi ! <br>';
			if($file_foto["name"] == '') $message .= 'Form File Pas Foto Anggota harus di isi ! <br>';
			if($file_bpjs_sehat["name"] == '') $message .= 'Form File BPJS Kesehatan Anggota harus di isi ! <br>';
			$message.= '</div>';
			$respon  = array('status' => FALSE, 'message' => $message);
			echo json_encode($respon);exit;
		}

		// validasi extension file //
		if($file_bpjs["name"] != '' || $file_foto["name"] != '' || $file_bpjs_sehat["name"] != '' || $file_ktp["name"] != '') {
			$message = '';
			// $message.= $this->validate_ext_upload($file_idcard, $dir_idcard, 'IDCARD');
			$message.= $this->validate_ext_upload($file_bpjs, $dir_bpjs, 'BPJS');
			$message.= $this->validate_ext_upload($file_foto, $dir_foto, 'FOTO');
			$message.= $this->validate_ext_upload($file_bpjs_sehat, $dir_bpjs, 'BPJS_SEHAT');
			$message.= $this->validate_ext_upload($file_ktp, $dir_ktp, 'KTP');
			if($message != '') {
				$respon  = array('status' => FALSE, 'message' => $message);
				echo json_encode($respon);exit;
			}
		}

		// validasi jumlah anggota official //
		$this->validate_rule($jobs_id, 'official');

		// upload to dir & rename file //
		// $up_idcard = $this->move_uploads_file($file_idcard, $dir_idcard, 'IDCARD');
		$up_bpjs   = $this->move_uploads_file($file_bpjs, $dir_bpjs, 'BPJS');
		$up_foto   = $this->move_uploads_file($file_foto, $dir_foto, 'FOTO');
		$up_bpjs_sehat = $this->move_uploads_file($file_bpjs_sehat, $dir_bpjs, 'BPJS_SEHAT');
		$up_ktp    = $this->move_uploads_file($file_ktp, $dir_ktp, 'KTP');
		
		$data = array(
					'nama' 		=> $nama_lengkap,
					// 'no_ktp' 	=> $no_ktp,
					// 'no_bpjs' 	=> $no_bpjs,
					// 'no_bpjs_kesehatan' => $no_bpjs_sehat,
					'no_hp' 	=> $no_hp,
					'jobs_id' 	=> $jobs_id
				);
		
		// if($up_idcard != '') {
		// 	$data['file_id_card'] = $up_idcard;
		// }

		if($up_bpjs != '') {
			$data['file_bpjs'] = $up_bpjs;
		}

		if($up_foto != '') {
			$data['file_pas_foto'] = $up_foto;
		}

		if($up_bpjs_sehat != '') {
			$data['file_bpjs_kesehatan'] = $up_bpjs_sehat;
		}

		if($up_ktp != '') {
			$data['file_ktp'] = $up_ktp;
		}

		if($id == '') {
			$this->Main_model->process_data('temp_tb_anggota', $data);
			$respon  = array('status' => TRUE, 
							'message' => '<div class="alert alert-success" role="alert">Data Anggota Official berhasil di simpan. </div>');
			echo json_encode($respon);exit;
		} else {
			$this->Main_model->process_data('temp_tb_anggota', $data, array('id' => $id));
			$respon  = array('status' => TRUE, 
							'message' => '<div class="alert alert-success" role="alert">Data Anggota Official berhasil di update. </div>');
			echo json_encode($respon);exit;
		}
	}

	function ajax_del_official($id='')
	{
		$this->Main_model->ajax_function();
		$this->Main_model->delete_data('temp_tb_anggota', array('id'=>$id));
		$respon  = array('status' => TRUE, 'message' => '<div class="alert alert-danger" role="alert">Data Anggota Official berhasil di hapus. </div>');
		echo json_encode($respon);exit;
	}

	function ajax_add_inti()
	{
		$this->Main_model->ajax_function();
		$this->load->library('upload');
		$jobs_id  = $this->input->post('jobs_id');
		$id  = $this->input->post('id_3');

		$nama_lengkap = $this->input->post('nama_lengkap2');
		$no_ktp    = $this->input->post('ektp2');
		$no_bpjs   = $this->input->post('no_bpjs2');
		$no_bpjs_sehat = $this->input->post('no_bpjs_sehat2');

		$dir_ktp   = "frontend/uploads/ktp/";
		$dir_idcard= "frontend/uploads/idcard/";
		$dir_bpjs  = "frontend/uploads/bpjs/";
		$dir_foto  = "frontend/uploads/foto/";

		$file_ktp  = $_FILES["file_ektp2"];
		// $file_idcard = $_FILES["id_card2"];
		$file_bpjs = $_FILES["bpjs2"];
		$file_foto = $_FILES["foto2"];
		$file_bpjs_sehat = $_FILES["bpjs_sehat2"];

		// validasi form kosong // 
		if($nama_lengkap == '' || $file_ktp["name"] == '' || $file_bpjs["name"] == '' || $file_foto["name"] == '' || $file_bpjs_sehat["name"] == '') 
		{
			$message = '<div class="alert alert-warning" role="alert">';
			if($nama_lengkap == '') $message .= 'Form Nama Lengkap Pemain Inti harus di isi ! <br>';
			if($file_ktp["name"] == '') $message .= 'Form File E-KTP Pemain Inti harus di isi ! <br>';
			// if($no_bpjs == '') $message .= 'Form Nomor BPJS Ketenagakerjaan Pemain Inti harus di isi ! <br>';
			// if($no_bpjs_sehat == '') $message .= 'Form Nomor BPJS Kesehatan Pemain Inti harus di isi ! <br>';
			// if($file_idcard["name"] == '') $message .= 'Form File ID Card Pemain Inti harus di isi ! <br>';
			if($file_bpjs["name"] == '') $message .= 'Form File BPJS Ketenagakerjaan Pemain Inti harus di isi ! <br>';
			if($file_foto["name"] == '') $message .= 'Form File Pas Foto Pemain Inti harus di isi ! <br>';
			if($file_bpjs_sehat["name"] == '') $message .= 'Form File BPJS Kesehatan Pemain Inti harus di isi ! <br>';
			$message.= '</div>';
			$respon  = array('status' => FALSE, 'message' => $message);
			echo json_encode($respon);exit;
		}

		// validasi jumlah pemain inti //
		$this->validate_rule($jobs_id, 'inti');

		// validasi extension file //
		if($file_bpjs["name"] != '' || $file_foto["name"] != '' || $file_bpjs_sehat["name"] != '' || $file_ktp["name"] != '') {
			$message = '';
			// $message.= $this->validate_ext_upload($file_idcard, $dir_idcard, 'IDCARD');
			$message.= $this->validate_ext_upload($file_bpjs, $dir_bpjs, 'BPJS');
			$message.= $this->validate_ext_upload($file_foto, $dir_foto, 'FOTO');
			$message.= $this->validate_ext_upload($file_bpjs_sehat, $dir_bpjs, 'BPJS_SEHAT');
			$message.= $this->validate_ext_upload($file_ktp, $dir_ktp, 'KTP');
			if($message != '') {
				$respon  = array('status' => FALSE, 'message' => $message);
				echo json_encode($respon);exit;
			}
		}

		// upload to dir & rename file //
		// $up_idcard = $this->move_uploads_file($file_idcard, $dir_idcard, 'IDCARD');
		$up_bpjs   = $this->move_uploads_file($file_bpjs, $dir_bpjs, 'BPJS');
		$up_foto   = $this->move_uploads_file($file_foto, $dir_foto, 'FOTO');
		$up_bpjs_sehat = $this->move_uploads_file($file_bpjs_sehat, $dir_bpjs, 'BPJS_SEHAT');
		$up_ktp    = $this->move_uploads_file($file_ktp, $dir_ktp, 'KTP');

		$data = array(
					'nama' 		=> $nama_lengkap,
					// 'no_ktp' 	=> $no_ktp,
					// 'no_bpjs' 	=> $no_bpjs,
					// 'no_bpjs_kesehatan' => $no_bpjs_sehat,
					'jobs_id' 	=> $jobs_id,
					'kategori'	=> 'inti'
				);

		// if($up_idcard != '') {
		// 	$data['file_id_card'] = $up_idcard;
		// }

		if($up_bpjs != '') {
			$data['file_bpjs'] = $up_bpjs;
		}

		if($up_foto != '') {
			$data['file_pas_foto'] = $up_foto;
		}

		if($up_bpjs_sehat != '') {
			$data['file_bpjs_kesehatan'] = $up_bpjs_sehat;
		}

		if($up_ktp != '') {
			$data['file_ktp'] = $up_ktp;
		}

		if($id == '') {
			$this->Main_model->process_data('temp_tb_pemain', $data);
			$respon  = array('status' => TRUE, 
							'message' => '<div class="alert alert-success" role="alert">Data Pemain Inti berhasil di simpan. </div>');
			echo json_encode($respon);exit;
		} else {
			$this->Main_model->process_data('temp_tb_pemain', $data, array('id' => $id));
			$respon  = array('status' => TRUE, 
							'message' => '<div class="alert alert-success" role="alert">Data Pemain Inti berhasil di update. </div>');
			echo json_encode($respon);exit;
		}
	}

	function ajax_del_inti($id='')
	{
		$this->Main_model->ajax_function();
		$this->Main_model->delete_data('temp_tb_pemain', array('id'=>$id));
		$respon  = array('status' => TRUE, 'message' => '<div class="alert alert-danger" role="alert">Data Pemain Inti berhasil di hapus. </div>');
		echo json_encode($respon);exit;
	}

	function ajax_add_cadangan()
	{
		$this->Main_model->ajax_function();
		$this->load->library('upload');
		$jobs_id  = $this->input->post('jobs_id');
		$id  = $this->input->post('id_4');

		$nama_lengkap = $this->input->post('nama_lengkap3');
		$no_ktp    = $this->input->post('ektp3');
		$no_bpjs   = $this->input->post('no_bpjs3');
		$no_bpjs_sehat = $this->input->post('no_bpjs_sehat3');

		$dir_ktp   = "frontend/uploads/ktp/";
		$dir_idcard= "frontend/uploads/idcard/";
		$dir_bpjs  = "frontend/uploads/bpjs/";
		$dir_foto  = "frontend/uploads/foto/";

		$file_ktp  = $_FILES["file_ektp3"];
		// $file_idcard = $_FILES["id_card3"];
		$file_bpjs = $_FILES["bpjs3"];
		$file_foto = $_FILES["foto3"];
		$file_bpjs_sehat = $_FILES["bpjs_sehat3"];

		// validasi form kosong // 
		if($nama_lengkap == '' || $file_ktp["name"] == '' || $file_bpjs["name"] == '' || $file_foto["name"] == '' || $file_bpjs_sehat["name"] == '') 
		{
			$message = '<div class="alert alert-warning" role="alert">';
			if($nama_lengkap == '') $message .= 'Form Nama Lengkap Pemain Cadangan harus di isi ! <br>';
			if($file_ktp["name"] == '') $message .= 'Form File E-KTP Pemain Cadangan harus di isi ! <br>';
			// if($no_bpjs == '') $message .= 'Form Nomor BPJS Ketenagakerjaan Pemain Cadangan harus di isi ! <br>';
			// if($no_bpjs_sehat == '') $message .= 'Form Nomor BPJS Kesehatan Pemain Cadangan harus di isi ! <br>';
			// if($file_idcard["name"] == '') $message .= 'Form File ID Card Pemain Cadangan harus di isi ! <br>';
			if($file_bpjs["name"] == '') $message .= 'Form File BPJS Ketenagakerjaan Pemain Cadangan harus di isi ! <br>';
			if($file_foto["name"] == '') $message .= 'Form File Pas Foto Pemain Cadangan harus di isi ! <br>';
			if($file_bpjs_sehat["name"] == '') $message .= 'Form File BPJS Kesehatan Pemain Cadangan harus di isi ! <br>';
			$message.= '</div>';
			$respon  = array('status' => FALSE, 'message' => $message);
			echo json_encode($respon);exit;
		}

		// validasi jumlah pemain cadangan //
		$this->validate_rule($jobs_id, 'cadangan');

		// validasi extension file //
		if($file_bpjs["name"] != '' || $file_foto["name"] != '' || $file_bpjs_sehat["name"] != '' || $file_ktp["name"] != '') {
			$message = '';
			// $message.= $this->validate_ext_upload($file_idcard, $dir_idcard, 'IDCARD');
			$message.= $this->validate_ext_upload($file_bpjs, $dir_bpjs, 'BPJS');
			$message.= $this->validate_ext_upload($file_foto, $dir_foto, 'FOTO');
			$message.= $this->validate_ext_upload($file_bpjs_sehat, $dir_bpjs, 'BPJS_SEHAT');
			$message.= $this->validate_ext_upload($file_ktp, $dir_ktp, 'KTP');
			if($message != '') {
				$respon  = array('status' => FALSE, 'message' => $message);
				echo json_encode($respon);exit;
			}
		}

		// upload to dir & rename file //
		// $up_idcard = $this->move_uploads_file($file_idcard, $dir_idcard, 'IDCARD');
		$up_bpjs   = $this->move_uploads_file($file_bpjs, $dir_bpjs, 'BPJS');
		$up_foto   = $this->move_uploads_file($file_foto, $dir_foto, 'FOTO');
		$up_bpjs_sehat = $this->move_uploads_file($file_bpjs_sehat, $dir_bpjs, 'BPJS_SEHAT');
		$up_ktp    = $this->move_uploads_file($file_ktp, $dir_ktp, 'KTP');

		$data = array(
					'nama' 		=> $nama_lengkap,
					// 'no_ktp' 	=> $no_ktp,
					// 'no_bpjs' 	=> $no_bpjs,
					// 'no_bpjs_kesehatan' => $no_bpjs_sehat,
					'jobs_id' 	=> $jobs_id,
					'kategori'	=> 'cadangan'
				);

		// if($up_idcard != '') {
		// 	$data['file_id_card'] = $up_idcard;
		// }

		if($up_bpjs != '') {
			$data['file_bpjs'] = $up_bpjs;
		}

		if($up_foto != '') {
			$data['file_pas_foto'] = $up_foto;
		}

		if($up_bpjs_sehat != '') {
			$data['file_bpjs_kesehatan'] = $up_bpjs_sehat;
		}

		if($up_ktp != '') {
			$data['file_ktp'] = $up_ktp;
		}

		if($id == '') {
			$this->Main_model->process_data('temp_tb_pemain', $data);
			$respon  = array('status' => TRUE, 
							'message' => '<div class="alert alert-success" role="alert">Data Pemain Cadangan berhasil di simpan. </div>');
			echo json_encode($respon);exit;
		} else {
			$this->Main_model->process_data('temp_tb_pemain', $data, array('id' => $id));
			$respon  = array('status' => TRUE, 
							'message' => '<div class="alert alert-success" role="alert">Data Pemain Cadangan berhasil di update. </div>');
			echo json_encode($respon);exit;
		}
	}

	function ajax_del_cadangan($id='')
	{
		$this->Main_model->ajax_function();
		$this->Main_model->delete_data('temp_tb_pemain', array('id'=>$id));
		$respon  = array('status' => TRUE, 'message' => '<div class="alert alert-danger" role="alert">Data Pemain Cadangan berhasil di hapus. </div>');
		echo json_encode($respon);exit;
	}

	function ajax_proses_daftar()
	{
		$this->Main_model->ajax_function();
		$jobs_id = $this->input->post('jobs_id');
		$file_bukti = $_FILES["bukti"];

		$check_perusahaan = $this->Main_model->view_by_id('temp_tb_perusahaan',array('jobs_id'=>$jobs_id));
		$check_anggota    = $this->Main_model->view_by_id('temp_tb_anggota',array('jobs_id'=>$jobs_id));
		$check_inti 	  = $this->Main_model->view_by_id('temp_tb_pemain',array('jobs_id'=>$jobs_id,'kategori'=>'inti'));
		$check_cadangan   = $this->Main_model->view_by_id('temp_tb_pemain',array('jobs_id'=>$jobs_id,'kategori'=>'cadangan'));

		if(empty($check_perusahaan) || empty($check_anggota) || empty($check_inti) || empty($check_cadangan) 
			|| $file_bukti['name'] == '') {
			$message = '';
			if(empty($check_perusahaan)) $message .='Data Perusahaan perlu di lengkapi <br>';
			if(empty($check_anggota)) $message .='Data Anggota Official perlu di lengkapi <br>';
			if(empty($check_inti)) $message .='Data Pemain Inti perlu di lengkapi <br>';
			if(empty($check_cadangan)) $message .='Data Pemain Cadangan perlu di lengkapi <br>';
			if($file_bukti['name'] == '') $message .='Form Bukti Transfer Registrasi belum di lengkapi <br>';
			$respon  = array('status' => FALSE, 'message' => $message);
			echo json_encode($respon);exit;
		}

		// validasi extension // 
		if($file_bukti["name"] != '') {
			$message = '';
			$message.= $this->validate_ext_upload($file_bukti, 'frontend/uploads/bukti/', 'BUKTI');
			if($message != '') {
				$respon  = array('status' => FALSE, 'message' => $message);
				echo json_encode($respon);exit;
			}
		}

		// validasi captcha //
		$secret_key = "6Lfz1LcUAAAAAOAryxtOfo51X4-LlXjjjeAkVDpq";
		$res_captcha= $_POST['g-recaptcha-response'];
		$url    	= 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$res_captcha;
		$rest_api 	= $this->validasi_captcha($url);
		$rest_api   = json_decode($rest_api);
		$success    = isset($rest_api->success) ? $rest_api->success:'';
		if($success != TRUE) {
			$respon  = array('status' => FALSE, 'message' => 'Please Check The Captcha');
			echo json_encode($respon);exit;
		}

		// upload to dir & rename file //
		$up_bukti = $this->move_uploads_file($file_bukti, 'frontend/uploads/bukti/', 'BUKTI');

		// unset values // 
		unset($check_perusahaan->id);
		unset($check_perusahaan->jobs_id);
		unset($check_perusahaan->tanggal_insert);
		$data_perusahaan = $check_perusahaan;
		// push values //
		$data_perusahaan->user_insert = $jobs_id;
		if($up_bukti != '') {
			$data_perusahaan->file_bukti = $up_bukti;
		}

		$respon = $this->Main_model->transaksi_proses_daftar_futsal($data_perusahaan, $jobs_id);
		if($respon['status'] == TRUE) {
			$id = $respon['id'];
			// kirim email //
			$this->kirim_invoice_futsal($id);
		}
		echo json_encode($respon);
	}

	function file_pdf()
	{
		$this->load->library('pdfgenerator');

		$data['detail'] = $this->Pendaftar_model->data_pendaftar_futsal_id(1);
		$this->load->view('frontend/invoice/invoice_futsal', $data);

		$html = $this->output->get_output();
		$this->load->library('pdfgenerator');
		$this->pdfgenerator->generate($html, 'test', true, 'a4', 'portrait');
	}

	function kirim_invoice_futsal($id='')
    {
        $this->load->library('pdfgenerator');
        $get = $this->Main_model->view_by_id('tb_perusahaan', array('id' => $id));
        $nomor = isset($get->nomor) ? $get->nomor:'';
        $nama_perusahaan = isset($get->nama_perusahaan) ? $get->nama_perusahaan:'';
        $to  = isset($get->email) ? $get->email:'';

        $from    = 'marcomm.smg@gmedia.co.id';
        $subject = 'Invoice '.$nomor.' Registrasi - Corporate Fun Futsal Competition 2019';
        $message = '';

        $this->load->library('email');

        $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.gmedia.net.id',
            // 'smtp_host' => '111.68.27.2',
            // 'smtp_host' => 'smtp.gmail.com',
            // 'smtp_port' => 465,
            'smtp_port' => 25,
            'smtp_user' => '', 
            'smtp_pass' => '', 
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );

        $this->email->initialize($config);

        $data['detail'] = $this->Pendaftar_model->data_pendaftar_futsal_id($id);
        $html     = $this->load->view('frontend/invoice/invoice_futsal', $data,true);           
        $filename = strtolower($nama_perusahaan);
        $output   = $this->pdfgenerator->generate($html,$filename,false,'a4','portrait');
		$filename = 'invoice_'.str_replace(' ', '_', $filename);
        // save to directory
        $dir_name = './frontend/uploads/invoice/'.$filename.'.pdf';
        file_put_contents($dir_name, $output);

        $this->email->set_newline("\r\n");
        $this->email->from($from,'Marcomm Gmedia Semarang');
        $this->email->to($to);
        $this->email->bcc('akbar.muchamad@gmedia.co.id');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($dir_name);

		$this->email->send();
	}
	
	function blast_emailss()
	{
		$this->load->library('pdfgenerator');
		$data = $this->Main_model->view_by_id('tb_email', '', 'result');
		print_r(count($data));exit;
		
        $from    = 'marcomm.smg@gmedia.co.id';
        $subject = 'Gmedia - Kompetisi Futsal Antar Perusahaan';
		
		
		$this->load->library('email');

        $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.gmedia.net.id',
            // 'smtp_host' => '111.68.27.2',
            // 'smtp_host' => 'smtp.gmail.com',
            // 'smtp_port' => 465,
            'smtp_port' => 25,
            'smtp_user' => '', 
            'smtp_pass' => '', 
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );

		$this->email->initialize($config);
		
		$dir_name = './frontend/undangan/Surat_undagan_futsal_Gmedia.pdf';
		$dir_poster = './frontend/undangan/Proposal_Futsal_Koni_+_Price List.pdf';
		$dir_img  = './frontend/images/poster.jpg';

		if(!empty($data)) {
			foreach ($data as $val) {
				$to  = isset($val->email) ? $val->email:'';
				
				$this->email->set_newline("\r\n");
				$this->email->from($from,'Marcomm Gmedia Semarang');
				// $this->email->to('adzan.muchamad@gmail.com');
				$this->email->to($to);
				$this->email->bcc('akbar.muchamad@gmedia.co.id,yunita.fidelia@gmedia.co.id,testergmedia@gmail.com');
				$this->email->subject($subject);
				// $this->email->message('Corporate Fun Futsal Competition <br>
				// Piala Walikota Semarang 2019
				// <br><br>
				// Pada tahun kedua Coorporate Fun Futsal Competition, Gmedia kembali bekerjasama dengan Pemerintah Kota Semarang & Kadin Kota Semarang menghadirkan Kompetisi Futsal antar perusahaan TERBESAR di Semarang, dengan slot 64 peserta untuk memperebutkan Piala Walikota Semarang!
				// <br><br>
				// Event ini adalah kompetisi "fun" antar perusahaan dengan menjunjung tinggi rasa sportifitas dan solidaritas. Peserta diwajibkan memiliki BPJS Ketenagakerjaan untuk membuktikan kebenaran status karyawan disetiap perusahaan, tanpa pemain sewaan.
				// <br><br>
				// Corporate Fun Futsal Competition 2019
				// 9-10 November 2019
				// <br><br>
				// Sumber Waras Stadium (Ex. Gor Knight)
				// Semarang
				// <br><br>
				// Registrasi Online :
				// gmedia.net.id/futsal
				// <br><br>
				// Pendaftaran : Rp 500.000,-/tim
				// <br><br>
				// TOTAL HADIAH SENILAI
				// 10 Juta Rupiah
				// <br><br>
				// Informasi :<br>
				// Satria  0812 2647 9093 <br>
				// Adhit   0852 9066 4046
				// <br><br>
				// Organized by:
				// - Gmedia
				// <br><br>
				// Supported by :
				// - Kadin Kota Semarang');
				$this->email->message('Yth.<br>

				Pimpinan Perusahaan<br>
				
				Di Semarang
				<br><br><br>
				 
				
				Dengan hormat,
				<br><br>
				PT Media Sarana Data (Gmedia), bekerjasama dengan KADIN Kota Semarang, bermaksud menyelenggarakan Event : <b><i>Futsal Fun Corporate Competition vol 2 tahun 2019</i></b>  dengan menyertakan Piala Walikota Semarang 2019. <br>
				Kami bermaksud mengundang Club/Tim Futsal dari Perusahaan yang Bapak/Ibu pimpin untuk berpartisipasi dalam event tersebut
				<br><br>
				terlampir :
				undangan partisipasi
				proposal sponsor
				<br><br>
				Demikian surat undangan ini kami sampaikan, atas segala perhatian dan kehadirannya kami ucapkan terima kasih
				<br>
				<img src="https://gmedia.net.id/futsal/frontend/images/poster.jpg" alt="Flyer Futsal Competition.jpeg" width="310" height="452"> ');
				$this->email->attach($dir_name);
				$this->email->attach($dir_poster);
		
				$this->email->send();
				$this->email->clear(true);
				sleep(2);
			}
		}
	}

	// ========== Function Global ========== //
	function validasi_captcha($url='')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch); 
		curl_close($ch);
		return $output;
	}

	function validate_ext_upload($file, $dirTo="", $prefix="")
	{
		$message = '';
			$name_file = $file["name"];
			$base_file = $dirTo .basename($name_file);
			$file_ext  = strtolower(pathinfo($base_file,PATHINFO_EXTENSION));

			if($file_ext != 'jpg' && $file_ext != 'png' && $file_ext != 'jpeg') {
				$message .= '<div class="alert alert-warning" role="alert">';
				$message .= 'File '.$prefix.' tidak sesuai format (png,jpg,jpeg) ? <br>';
				$message .= '</div>';
			}

		return $message;
	}

	function move_uploads_file($file, $dirTo="", $prefix="")
	{
		$result    = '';
		
		$name_file = $file["name"];
		$type_file = $file["type"];

		if($name_file != "" && $type_file != "") {
			// rename file // 
			$explode   = explode(".", $name_file);
			$new_name  = $prefix.'_'.time().'.'.end($explode);
			
			// move to directory // 
			move_uploaded_file($file["tmp_name"], $dirTo.basename($new_name));

			//  return name file // 
			$result    = base_url().$dirTo.$new_name;
		}

		return $result;
	}

	function validate_rule($jobs_id='', $tipe='')
	{
		$get = $this->Main_model->view_by_id('tb_rule_futsal', array('tipe'=>$tipe));
		$max = isset($get->jumlah) ? $get->jumlah:'';
		if($tipe == 'official') {
			$data = $this->Main_model->jumlah_official($jobs_id);
			if($data == $max) {
				$respon  = array('status' => FALSE, 
							'message' => '<div class="alert alert-danger" role="alert">Maksimal Anggota Official '.$max.' orang.</div>');
				echo json_encode($respon);exit;
			}
		}

		if($tipe == 'inti') {
			$data = $this->Main_model->jumlah_inti($jobs_id);
			if($data == $max) {
				$respon  = array('status' => FALSE, 
							'message' => '<div class="alert alert-danger" role="alert">Maksimal Pemain Inti '.$max.' orang.</div>');
				echo json_encode($respon);exit;
			}
		}

		if($tipe == 'cadangan') {
			$data = $this->Main_model->jumlah_cadangan($jobs_id);
			if($data == $max) {
				$respon  = array('status' => FALSE, 
							'message' => '<div class="alert alert-danger" role="alert">Maksimal Pemain Cadangan '.$max.' orang.</div>');
				echo json_encode($respon);exit;
			}
		}
	}
	// ========== End Function Global ========== //

	// ========== Function Login Admin ========== //
	public function panel()
	{
		$this->load->view('admin/login');
	}

	function login_process()
	{
		$this->Main_model->ajax_function();
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5($password);

		$username = htmlentities($username, ENT_QUOTES);
        $password = htmlentities($password, ENT_QUOTES);

        $notif ='<div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> Masukkan username and password. </span>
                </div>';

        if($username == '' || $password == '') {
        	$respon = array('status' => FALSE,'notif'=> $notif);
        	echo json_encode($respon);exit;
        }

        $notif ='<div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> Username atau password anda salah </span>
                </div>';
        $status= FALSE;

		$cek = $this->Main_model->cek_user($username, $password); 
		   
        if(!empty($cek)) {
        	$sess_array = array(
							'id'  => $cek->id,
							'nip' => $cek->id_employee,
							'username' => $cek->username,
							'nama' => $cek->keterangan
						);
        	$this->session->set_userdata($sess_array);
        	$notif ='<div class="alert alert-success">
	                    <button class="close" data-close="alert"></button>
	                    <span> Login Berhasil ... </span>
	                </div>';
	        $status= TRUE;
        }
        $respon = array('status'=> $status,'notif'=> $notif);
        echo json_encode($respon);
	}

	function logout_process()
	{
		$this->session->sess_destroy();
        redirect('', 'refresh');
	}
	// ========== End Function Login Admin ========== //
}