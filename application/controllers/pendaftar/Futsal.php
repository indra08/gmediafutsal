<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Futsal extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Pendaftar_model');
		$this->load->library('upload');
		$this->Main_model->get_login();
	}
	  
	public function index()
	{
		$data['title']  = 'Pendaftar Futsal';
        $data['title2'] = 'Data Pendaftar Futsal';
        $data['app']    = 'pendaftar/data_pendaftar_futsal.js';
		$this->load->view('admin/head', $data);
		$this->load->view('admin/menu', $this->Main_model->menu());
		$this->load->view('admin/pendaftar/data_pendaftar', $data);
		$this->load->view('admin/footer', $data);
	}

	public function detail_data()
	{
		$id = $this->input->get('q');
		$data['title']  = 'Detail Pendaftar Futsal';
		$data['title2'] = 'Data Detail Pendaftar Futsal';
		$data['detail'] = $this->Pendaftar_model->data_pendaftar_futsal_id($id);
        $data['app']    = 'pendaftar/detail_pendaftar_futsal.js';
		$this->load->view('admin/head', $data);
		$this->load->view('admin/menu', $this->Main_model->menu());
		$this->load->view('admin/pendaftar/detail_pendaftar', $data);
		$this->load->view('admin/footer', $data);
	}

	function ajax_data_pendaftar()
	{
		$this->Main_model->ajax_function();
		$data = $this->Pendaftar_model->data_pendaftar_futsal();
			$arr = array();
			$no  = 1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$url_img    = "'".$val->file_bukti."'";
					$nama_perusahaan = "'".$val->nama_perusahaan."'";
					$invoice    = "invoice_".str_replace(" ","_",strtolower($val->nama_perusahaan)).".pdf";
					$btn_action = '<div class="btn-group">
	                                    <button class="btn blue dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action
	                                        <i class="fa fa-angle-down"></i>
	                                    </button>
	                                    <ul class="dropdown-menu">
	                                        <li>
	                                            <a href="'.base_url().'pendaftar/Futsal/detail_data?q='.$val->id.'"> Detail Data</a>
											</li>
											<li>
	                                            <a onclick="kirim_invoice('.$val->id.')" href="javascript:;"> Kirim Invoice</a>
											</li>
											<li>
	                                            <a target="_blank" href="'.base_url().'frontend/uploads/invoice/'.$invoice.'"> Download Invoice</a>
											</li>
											<li>
	                                            <a target="_blank" href="'.$val->file_bukti.'"> Download Bukti Transfer</a>
	                                        </li>';
						if($val->verif == '0') {
							$btn_action .=	'<li>
												<a onclick="verif('.$val->id.')" href="javascript:;"> Verifikasi </a>
											</li>';
						}
					$btn_action .='</ul>
							</div>';
					
					$arr[$row] = array(
									'no' => $no++,
									'nomor' => $val->nomor,
									'tanggal' => $this->Main_model->tanggal_slash($val->tanggal),
									'perusahaan' => $val->nama_perusahaan,
									'brand' => $val->nama_brand,
									'tim' => $val->nama_tim,
									'email' => $val->email,
									'bukti' => '<img onclick="zoom('.$url_img.','.$nama_perusahaan.')" width="100px" style="cursor:pointer;" src="'.$val->file_bukti.'">',
									'pic' => $val->pic,
									'status_verif' => $val->status_verif,
									'aksi' => $btn_action
								);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_verifikasi_data($id='')
	{
		$this->Main_model->ajax_function();
		$username = $this->session->userdata('username');
		$check = $this->Main_model->view_by_id('tb_perusahaan', array('id'=>$id,'verif'=>'1'));
		if(!empty($check)) {
			$verif_user = isset($check->verif_user) ? $check->verif_user:'';
			$verif_date = isset($check->verif_date) ? $check->verif_date:'';
			$respon = array('status'=>FALSE, 'message'=>'Data sudah di verifikasi oleh '.$verif_user.' at '.$verif_date);
			echo json_encode($respon);exit;
		}

		$data_update= array(
						'verif' => '1',
						'verif_user' => $username,
						'verif_date' => $this->Main_model->time_server()
					);
		
		// Update verifikasi //
		$this->Main_model->process_data('tb_perusahaan', $data_update, array('id'=>$id));
		$respon = array('status'=>TRUE, 'message'=>'Data berhasil diverifikasi');
		echo json_encode($respon);exit;
	}

	function ajax_kirim_invoice($id='')
	{
		$this->Main_model->ajax_function();
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
		
		$error = $this->email->print_debugger();
		$error = preg_replace('/<(pre)(?:(?!<\/\1).)*?<\/\1>/s','',$error);
		if (!empty($error)) {
			$respon = array('status'=>FALSE, 'message'=>'Gagal mengirim invoice','err'=>$error);
			echo json_encode($respon);exit;
		}

		$respon = array('status'=>TRUE, 'message'=>'Invoice berhasil terkirim');
		echo json_encode($respon);
	}

	function ajax_data_official()
	{
		$this->Main_model->ajax_function();
		$id_perusahaan = $this->input->get('id');
		$data = $this->Pendaftar_model->data_anggota_futsal($id_perusahaan);
			$arr = array();
			$no=1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$url_ktp        = "'".$val->file_ktp."'";
					$url_pas_foto   = "'".$val->file_pas_foto."'";
					$url_bpjs       = "'".$val->file_bpjs."'";
					$url_bpjs_sehat = "'".$val->file_bpjs_kesehatan."'";
					$arr[$row] = array(
									'no' => $no++,
									'nama' => $val->nama,
									'no_hp' => $val->no_hp,
									'file_ktp' => '<img onclick="zoom('.$url_ktp.')" width="125px" src="'.$val->file_ktp.'" style="cursor:pointer;">',
									'file_pas_foto' => '<img onclick="zoom('.$url_pas_foto.')" width="125px" src="'.$val->file_pas_foto.'" style="cursor:pointer;">',
									'file_bpjs' => '<img onclick="zoom('.$url_bpjs.')" width="125px" src="'.$val->file_bpjs.'" style="cursor:pointer;">',
									'file_bpjs_kesehatan' => '<img onclick="zoom('.$url_bpjs_sehat.')" width="125px" src="'.$val->file_bpjs_kesehatan.'" style="cursor:pointer;">'
								);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_data_inti()
	{
		$this->Main_model->ajax_function();
		$id_perusahaan = $this->input->get('id');
		$data = $this->Pendaftar_model->data_pemain_inti($id_perusahaan);
			$arr = array();
			$no=1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$url_ktp        = "'".$val->file_ktp."'";
					$url_pas_foto   = "'".$val->file_pas_foto."'";
					$url_bpjs       = "'".$val->file_bpjs."'";
					$url_bpjs_sehat = "'".$val->file_bpjs_kesehatan."'";
					$arr[$row] = array(
									'no' => $no++,
									'nama' => $val->nama,
									'file_ktp' => '<img onclick="zoom('.$url_ktp.')" width="125px" src="'.$val->file_ktp.'" style="cursor:pointer;">',
									'file_pas_foto' => '<img onclick="zoom('.$url_pas_foto.')" width="125px" src="'.$val->file_pas_foto.'" style="cursor:pointer;">',
									'file_bpjs' => '<img onclick="zoom('.$url_bpjs.')" width="125px" src="'.$val->file_bpjs.'" style="cursor:pointer;">',
									'file_bpjs_kesehatan' => '<img onclick="zoom('.$url_bpjs_sehat.')" width="125px" src="'.$val->file_bpjs_kesehatan.'" style="cursor:pointer;">'
								);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_data_cadangan()
	{
		$this->Main_model->ajax_function();
		$id_perusahaan = $this->input->get('id');
		$data = $this->Pendaftar_model->data_pemain_cadangan($id_perusahaan);
			$arr = array();
			$no=1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$url_ktp        = "'".$val->file_ktp."'";
					$url_pas_foto   = "'".$val->file_pas_foto."'";
					$url_bpjs       = "'".$val->file_bpjs."'";
					$url_bpjs_sehat = "'".$val->file_bpjs_kesehatan."'";
					$arr[$row] = array(
									'no' => $no++,
									'nama' => $val->nama,
									'file_ktp' => '<img onclick="zoom('.$url_ktp.')" width="125px" src="'.$val->file_ktp.'" style="cursor:pointer;">',
									'file_pas_foto' => '<img onclick="zoom('.$url_pas_foto.')" width="125px" src="'.$val->file_pas_foto.'" style="cursor:pointer;">',
									'file_bpjs' => '<img onclick="zoom('.$url_bpjs.')" width="125px" src="'.$val->file_bpjs.'" style="cursor:pointer;">',
									'file_bpjs_kesehatan' => '<img onclick="zoom('.$url_bpjs_sehat.')" width="125px" src="'.$val->file_bpjs_kesehatan.'" style="cursor:pointer;">'
								);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

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

	function ajax_add_pemain()
	{
		$this->Main_model->ajax_function();
		$this->load->library('upload');
		$id = $this->input->post('id_pemain');
		$id_perusahaan = $this->input->post('id_perusahaan');

		$nama_lengkap  = $this->input->post('nama');
		$kategori  = $this->input->post('kategori');

		$dir_ktp   = "frontend/uploads/ktp/";
		$dir_idcard= "frontend/uploads/idcard/";
		$dir_bpjs  = "frontend/uploads/bpjs/";
		$dir_foto  = "frontend/uploads/foto/";

		$file_ktp  = $_FILES["file_ektp"];
		$file_bpjs = $_FILES["bpjs"];
		$file_foto = $_FILES["foto"];
		$file_bpjs_sehat = $_FILES["bpjs_sehat"];

		if($nama_lengkap == '' || $file_ktp["name"] == '' || $file_bpjs["name"] == '' || $file_foto["name"] == '' || $file_bpjs_sehat["name"] == '') 
		{
			$message = '';
			if($nama_lengkap == '') $message .= 'Form Nama Lengkap Pemain Inti harus di isi ! <br>';
			if($file_ktp["name"] == '') $message .= 'Form File E-KTP Pemain Inti harus di isi ! <br>';
			if($file_bpjs["name"] == '') $message .= 'Form File BPJS Ketenagakerjaan Pemain Inti harus di isi ! <br>';
			if($file_foto["name"] == '') $message .= 'Form File Pas Foto Pemain Inti harus di isi ! <br>';
			if($file_bpjs_sehat["name"] == '') $message .= 'Form File BPJS Kesehatan Pemain Inti harus di isi ! <br>';
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

		// upload to dir & rename file //
		$up_bpjs   = $this->move_uploads_file($file_bpjs, $dir_bpjs, 'BPJS');
		$up_foto   = $this->move_uploads_file($file_foto, $dir_foto, 'FOTO');
		$up_bpjs_sehat = $this->move_uploads_file($file_bpjs_sehat, $dir_bpjs, 'BPJS_SEHAT');
		$up_ktp    = $this->move_uploads_file($file_ktp, $dir_ktp, 'KTP');

		$data = array(
			'id_perusahaan'	=> $id_perusahaan,
			'nama' 		=> $nama_lengkap,
			'kategori'	=> $kategori
		);

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
			$this->Main_model->process_data('tb_pemain', $data);
			$respon  = array('status' => TRUE, 
							'message' => 'Data Pemain Inti berhasil di simpan.');
			echo json_encode($respon);exit;
		} else {
			$this->Main_model->process_data('tb_pemain', $data, array('id' => $id));
			$respon  = array('status' => TRUE, 
							'message' => 'Data Pemain Inti berhasil di update.');
			echo json_encode($respon);exit;
		}
	}
}