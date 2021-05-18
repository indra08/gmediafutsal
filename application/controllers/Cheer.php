<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cheer extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Pendaftar_model');
		$this->load->library('upload');
	}
	  
	public function index()
	{
        $data['title']              = 'Gmedia Cheerleading Contest';
        $data['js'] 		 		= 'custom.js';
        $data['josb_id']			= $this->Main_model->random_word(8);
        $data['lokasi'] 			= $this->Main_model->get_lokasi_pertandingan_cheer();
        $data['rule_pertandingan']  = $this->Main_model->list_ketentuan_pertandingan_cheer();
        $data['rule_peserta']       = $this->Main_model->list_ketentuan_peserta_cheer();
        $data['list_hadiah']        = $this->Main_model->list_hadiah_cheer();
        $data['url_banner']         = base_url().'frontend/images/banner_cheerleading.jpg';
		$this->load->view('frontend/head', $data);
		$this->load->view('frontend/cheer', $data);
		$this->load->view('frontend/foot', $data);
	}

	function ajax_data_organisasi()
	{
		$this->Main_model->ajax_function();
		$jobs_id = $this->input->get('q');
		$data = $this->Main_model->data_organisasi($jobs_id);
			$arr = array();
			$no = 1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$arr[$row] = array(
									'nama' 	=> $val->nama_organisasi,
									'tim'	=> $val->nama_tim,
									'kategori' => $val->kategori,
									'email' => $val->email,
									'act' => '<a title="Edit" href="javascript:;" onclick="edt_organisasi('.$val->id.')"><i class="fa fa-pencil"></i></a>'
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
    }
    
    function ajax_data_pelatih()
    {
        $this->Main_model->ajax_function();
        $jobs_id = $this->input->get('q');
		$data = $this->Main_model->data_pelatih($jobs_id);
			$arr = array();
            $no = 1;
            if(!empty($data)) {
				foreach ($data as $row => $val) {
					$arr[$row] = array(
									'nama' 	=> $val->nama,
									'no_hp' => $val->no_hp,
									'act' => '<a title="Hapus" href="javascript:;" onclick="del_pelatih('.$val->id.')"><i class="fa fa-trash"></i></a>'
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
    }

    function ajax_data_official_cheer()
    {
        $this->Main_model->ajax_function();
        $jobs_id = $this->input->get('q');
		$data = $this->Main_model->data_official_cheer($jobs_id);
			$arr = array();
            $no = 1;
            if(!empty($data)) {
				foreach ($data as $row => $val) {
                    $file_ktp  = isset($val->file_ktp) ? '<b style="color:#19fc00;">V</b>':'-';
					$arr[$row] = array(
									'nama' 	=> $val->nama,
									'no_hp' => $val->no_hp,
									// 'no_ktp' => $val->no_ktp,
									'file_ktp' => $file_ktp,
									'act' => '<a title="Hapus" href="javascript:;" onclick="del_official_cheer('.$val->id.')"><i class="fa fa-trash"></i></a>'
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
    }

    function ajax_data_pemain_cheer()
    {
        $this->Main_model->ajax_function();
        $jobs_id = $this->input->get('q');
		$data = $this->Main_model->data_pemain_cheer($jobs_id);
			$arr = array();
            $no = 1;
            if(!empty($data)) {
				foreach ($data as $row => $val) {
                    $file_id  = isset($val->file_id) ? '<b style="color:#19fc00;">V</b>':'-';
					$arr[$row] = array(
									'nama' 	=> $val->nama,
									// 'nomor_identitas' => $val->nomor_identitas,
									'jenis_kelamin' => $val->jenis_kelamin,
									'umur' 	=> $val->usia,
									'tgl_lahir' => $this->Main_model->tanggal_slash($val->tanggal_lahir),
									'file_id' 	=> $file_id,
									'act' => '<a title="Hapus" href="javascript:;" onclick="del_pemain_cheer('.$val->id.')"><i class="fa fa-trash"></i></a>'
					);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
    }

    function ajax_add_organisasi()
    {
        $this->Main_model->ajax_function();
        $jobs_id  = $this->input->post('jobs_id');
        $id  = $this->input->post('idc_1');

        $nama_organisasi = $this->input->post('nama_organisasi');
        $nama_tim = $this->input->post('nama_tim');
        $email = $this->input->post('email');
        $kategori_tim = $this->input->post('kategori_tim');

        if($nama_organisasi == '' || $nama_tim == '' || $email == '' || $kategori_tim == '')
        {
            $message = '<div class="alert alert-warning" role="alert">';
            if($nama_organisasi == '') $message.='Form Nama Organisasi / Sekolah harus di isi ! <br>';
            if($nama_tim == '') $message.='Form Nama Group / Tim harus di isi ! <br>';
            if($email == '') $message.='Form Email harus di isi ! <br>';
            if($kategori_tim == '') $message.='Form Divisi Group Stunt harus di isi ! <br>';
            $message.= '</div>';
            $respon  = array('status'=>FALSE,'message'=>$message);
            echo json_encode($respon);exit;
        }

        if($id == '') {
			$check_temp = $this->Main_model->view_by_id('temp_cheer_tb_organisasi', array('jobs_id'=>$jobs_id));
			if(!empty($check_temp)) {
				$respon  = array('status' => FALSE, 'message' => '<div class="alert alert-warning" role="alert">Data Organisasi / Sekolah anda sudah tersimpan. </div>');
				echo json_encode($respon);exit;
			}
		}

        $data = array(
                    'nama_organisasi' => $nama_organisasi,
                    'nama_tim' => $nama_tim,
                    'kategori_tim' => $kategori_tim,
                    'email' => $email,
					'jobs_id' => $jobs_id
                );

        if($id == '') {
            $this->Main_model->process_data('temp_cheer_tb_organisasi', $data);
            $respon  = array('status' => TRUE, 
                            'message' => '<div class="alert alert-success" role="alert">Data Organisasi / Sekolah berhasil di simpan. </div>');
            echo json_encode($respon);exit;
        } else {
            $this->Main_model->process_data('temp_cheer_tb_organisasi', $data, array('id' => $id));
            $respon  = array('status' => TRUE, 
                            'message' => '<div class="alert alert-success" role="alert">Data Organisasi / Sekolah berhasil di update. </div>');
            echo json_encode($respon);exit;
        }
    }

    function ajax_edit_organisasi($id='')
    {
        $this->Main_model->ajax_function();
		$data = $this->Main_model->view_by_id('temp_cheer_tb_organisasi', array('id'=>$id));
		echo json_encode($data);
    }

    function ajax_add_pelatih()
    {
        $this->Main_model->ajax_function();
        $jobs_id  = $this->input->post('jobs_id');
        $id  = $this->input->post('idc_2');

        $nama  = $this->input->post('nama_pelatih1');
        $no_hp = $this->input->post('no_hp1');

        if($nama == '' || $no_hp == '') {
            $message = '<div class="alert alert-warning" role="alert">';
            if($nama == '') $message.='Form Nama Pelatih harus di isi ! <br>';
            if($no_hp == '') $message.='Form Np. Handphone Pelatih harus di isi ! <br>';
            $message.= '</div>';
            $respon  = array('status'=>FALSE,'message'=>$message);
            echo json_encode($respon);exit;
        }

        // validasi jumlah pelatih //
        $this->validate_rule($jobs_id, 'pelatih');

        $data = array(
                    'nama' => $nama,
                    'no_hp' => $no_hp,
                    'jobs_id' => $jobs_id
                );

        if($id == '') {
            $this->Main_model->process_data('temp_cheer_tb_pelatih', $data);
            $respon  = array('status' => TRUE, 
                            'message' => '<div class="alert alert-success" role="alert">Data Pelatih berhasil di simpan. </div>');
            echo json_encode($respon);exit;
        } else {
            $this->Main_model->process_data('temp_cheer_tb_pelatih', $data, array('id' => $id));
            $respon  = array('status' => TRUE, 
                            'message' => '<div class="alert alert-success" role="alert">Data Pelatih berhasil di update. </div>');
            echo json_encode($respon);exit;
        }
    }

    function ajax_del_pelatih($id='')
	{
		$this->Main_model->ajax_function();
		$this->Main_model->delete_data('temp_cheer_tb_pelatih', array('id'=>$id));
		$respon  = array('status' => TRUE, 'message' => '<div class="alert alert-danger" role="alert">Data Pelatih berhasil di hapus. </div>');
		echo json_encode($respon);exit;
    }
    
    function ajax_add_official_cheer()
    {
        $this->Main_model->ajax_function();
        $jobs_id = $this->input->post('jobs_id');
        $id = $this->input->post('idc_3');

        $nama   = $this->input->post('nama_lengkap2');
        $no_ktp = $this->input->post('ektp2');
        $no_hp  = $this->input->post('no_hp2');

        $dir_ktp   = "frontend/uploads/ktp/";

        $file_ktp  = $_FILES["file_ektp2"];

        if($nama == '' || $file_ktp["name"] == '' || $no_hp == '') {
            $message = '<div class="alert alert-warning" role="alert">';
            if($nama == '') $message.='Form Nama Lengkap Anggota Official harus di isi ! <br>';
            if($file_ktp["name"] == '') $message.='Form File ID / KTP Anggota Official harus di isi ! <br>';
            if($no_hp == '') $message.='Form No. Handphone Anggota Official harus di isi ! <br>';
            $message.= '</div>';
            $respon  = array('status'=>FALSE,'message'=>$message);
            echo json_encode($respon);exit;
        }

        // validasi extension file //
		if($file_ktp["name"] != '') {
			$message = '';
			$message.= $this->validate_ext_upload($file_ktp, $dir_ktp, 'KTP');
			if($message != '') {
				$respon  = array('status' => FALSE, 'message' => $message);
				echo json_encode($respon);exit;
			}
		}

        // validasi jumlah official //
        $this->validate_rule($jobs_id, 'official');

        $up_ktp    = $this->move_uploads_file($file_ktp, $dir_ktp, 'KTP');

        $data = array(
                    'nama' => $nama,
                    'no_ktp' => $no_ktp,
                    'no_hp' => $no_hp,
                    'jobs_id' => $jobs_id
                );

        if($up_ktp != '') {
            $data['file_ktp'] = $up_ktp;
        }

        if($id == '') {
            $this->Main_model->process_data('temp_cheer_tb_anggota', $data);
            $respon  = array('status' => TRUE, 
                            'message' => '<div class="alert alert-success" role="alert">Data Anggota Official berhasil di simpan. </div>');
            echo json_encode($respon);exit;
        } else {
            $this->Main_model->process_data('temp_cheer_tb_anggota', $data, array('id' => $id));
            $respon  = array('status' => TRUE, 
                            'message' => '<div class="alert alert-success" role="alert">Data Anggota Official berhasil di update. </div>');
            echo json_encode($respon);exit;
        }
    }

    function ajax_del_official($id='')
	{
		$this->Main_model->ajax_function();
		$this->Main_model->delete_data('temp_cheer_tb_anggota', array('id'=>$id));
		$respon  = array('status' => TRUE, 'message' => '<div class="alert alert-danger" role="alert">Data Anggota Official berhasil di hapus. </div>');
		echo json_encode($respon);exit;
    }

    function ajax_add_pemain_cheer()
    {
        $this->Main_model->ajax_function();
        $jobs_id = $this->input->post('jobs_id');
        $id = $this->input->post('idc_4');

        $nama = $this->input->post('nama_lengkap3');
        $noid = $this->input->post('noid2');
        $kelamin = $this->input->post('kelamin');
        $usia = $this->input->post('usia');
        $tgl_lahir = $this->input->post('tgl_lahir');

        $dir_id  = "frontend/uploads/idcard/";

        $file_id = $_FILES["file_id2"];

        if($nama == '' || $file_id["name"] == '' || $kelamin == '' || $tgl_lahir == '') {
            $message = '<div class="alert alert-warning" role="alert">';
            if($nama == '') $message.='Form Nama Lengkap Atlet harus di isi ! <br>';
            if($file_id["name"] == '') $message.='Form File Identitas / Kartu Pelajar / KTP Atlet harus di isi ! <br>';
            if($kelamin == '') $message.='Form Jenis Kelamin Atlet harus di isi ! <br>';
            // if($usia == '') $message.='Form Usia Atlet harus di isi ! <br>';
            if($tgl_lahir == '') $message.='Form Tanggal Lahir Atlet harus di isi ! <br>';
            $message.= '</div>';
            $respon  = array('status'=>FALSE,'message'=>$message);
            echo json_encode($respon);exit;
        }

        // validasi extension file //
		if($file_id["name"] != '') {
			$message = '';
			$message.= $this->validate_ext_upload($file_id, $dir_id, 'IDCARD');
			if($message != '') {
				$respon  = array('status' => FALSE, 'message' => $message);
				echo json_encode($respon);exit;
			}
		}

        $now       = date_create(date('Y-m-d'));
        $tgl_lahir = date_create($this->Main_model->convert_tgl($tgl_lahir));
        $diff_tl   = date_diff($tgl_lahir, $now, true);
        $usia      = $diff_tl->y;
        
        if($usia < '13') {
            $respon  = array('status'=>FALSE,'message'=>'<div class="alert alert-warning" role="alert">Usia dan Tanggal lahir tidak memenuhi syarat, minimal 13 tahun.</div>');
            echo json_encode($respon);exit;
        }
        
        // validasi jumlah official //
        $this->validate_rule($jobs_id, 'pemain');

        $up_id = $this->move_uploads_file($file_id, $dir_id, 'IDCARD');

        $tgl_lahir = date_format($tgl_lahir, "Y-m-d");
        $data = array(
                    'nama' => $nama,
                    'kelamin' => $kelamin,
                    'umur' => $usia,
                    'nomor_identitas' => $noid,
                    'tanggal_lahir' => $tgl_lahir,
                    'jobs_id' => $jobs_id
                );

        if($up_id != '') {
            $data['file_id'] = $up_id;
        }

        if($id == '') {
            $this->Main_model->process_data('temp_cheer_tb_pemain', $data);
            $respon  = array('status' => TRUE, 
                            'message' => '<div class="alert alert-success" role="alert">Data Atlet berhasil di simpan. </div>');
            echo json_encode($respon);exit;
        } else {
            $this->Main_model->process_data('temp_cheer_tb_pemain', $data, array('id' => $id));
            $respon  = array('status' => TRUE, 
                            'message' => '<div class="alert alert-success" role="alert">Data Atlet berhasil di update. </div>');
            echo json_encode($respon);exit;
        }
    }

    function ajax_del_pemain_cheer($id='')
	{
		$this->Main_model->ajax_function();
		$this->Main_model->delete_data('temp_cheer_tb_pemain', array('id'=>$id));
		$respon  = array('status' => TRUE, 'message' => '<div class="alert alert-danger" role="alert">Data Atlet berhasil di hapus. </div>');
		echo json_encode($respon);exit;
    }

    function ajax_proses_daftar()
    {
        $this->Main_model->ajax_function();
        $jobs_id = $this->input->post('jobs_id');
        $file_bukti = $_FILES["bukti"];
        
        $check_organisasi = $this->Main_model->view_by_id('temp_cheer_tb_organisasi',array('jobs_id'=>$jobs_id));
		$check_pelatih    = $this->Main_model->view_by_id('temp_cheer_tb_pelatih',array('jobs_id'=>$jobs_id));
		$check_anggota    = $this->Main_model->view_by_id('temp_cheer_tb_anggota',array('jobs_id'=>$jobs_id));
        $check_pemain     = $this->Main_model->view_by_id('temp_cheer_tb_pemain',array('jobs_id'=>$jobs_id));
        
        if(empty($check_organisasi) || empty($check_pelatih) || empty($check_anggota) || empty($check_pemain)
            || $file_bukti['name'] == '') {
			$message = '';
			if(empty($check_organisasi)) $message .='Data Organisasi / Sekolah perlu di lengkapi <br>';
			if(empty($check_pelatih)) $message .='Data Pelatih perlu di lengkapi <br>';
			if(empty($check_anggota)) $message .='Data Anggota Official perlu di lengkapi <br>';
			if(empty($check_pemain)) $message .='Data Atlet perlu di lengkapi <br>';
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
		unset($check_organisasi->id);
		unset($check_organisasi->jobs_id);
		unset($check_organisasi->tanggal_insert);
		$data_organisasi = $check_organisasi;
		// push values //
		$data_organisasi->user_insert = $jobs_id;
		if($up_bukti != '') {
			$data_organisasi->file_bukti = $up_bukti;
        }
        
        $respon = $this->Main_model->transaksi_proses_daftar_cheer($data_organisasi, $jobs_id);
        if($respon['status'] == TRUE) {
			$id = $respon['id'];
			// kirim email //
			$this->kirim_invoice_cheer($id);
		}
		echo json_encode($respon);
    }

    function file_pdf()
	{
		$this->load->library('pdfgenerator');

		$data['detail'] = $this->Pendaftar_model->data_pendaftar_cheer_id(1);
		$this->load->view('frontend/invoice/invoice_cheer', $data);

		$html = $this->output->get_output();
		$this->load->library('pdfgenerator');
		$this->pdfgenerator->generate($html, 'test', true, 'a4', 'portrait');
    }
    
    function kirim_invoice_cheer($id='')
    {
        $this->load->library('pdfgenerator');
        $get = $this->Main_model->view_by_id('cheer_tb_organisasi', array('id' => $id));
        $nomor = isset($get->nomor) ? $get->nomor:'';
        $nama_organisasi = isset($get->nama_organisasi) ? $get->nama_organisasi:'';
        $to  = isset($get->email) ? $get->email:'';

        $from    = 'marcomm.smg@gmedia.co.id';
        $subject = 'Invoice '.$nomor.' Registrasi - Gmedia Cheerleading Contest';
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

        $data['detail'] = $this->Pendaftar_model->data_pendaftar_cheer_id($id);
        $html     = $this->load->view('frontend/invoice/invoice_cheer', $data,true);           
        $filename = strtolower($nama_organisasi);
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
		$get = $this->Main_model->view_by_id('cheer_tb_rule', array('tipe'=>$tipe));
		$max = isset($get->jumlah) ? $get->jumlah:'';
		if($tipe == 'official') {
			$data = $this->Main_model->jumlah_official_cheer($jobs_id);
			if($data == $max) {
				$respon  = array('status' => FALSE, 
							'message' => '<div class="alert alert-danger" role="alert">Maksimal Anggota Official '.$max.' orang.</div>');
				echo json_encode($respon);exit;
			}
		}

		if($tipe == 'pelatih') {
			$data = $this->Main_model->jumlah_pelatih($jobs_id);
			if($data == $max) {
				$respon  = array('status' => FALSE, 
							'message' => '<div class="alert alert-danger" role="alert">Maksimal Pelatih '.$max.' orang.</div>');
				echo json_encode($respon);exit;
			}
		}

		if($tipe == 'pemain') {
			$data = $this->Main_model->jumlah_pemain_cheer($jobs_id);
			if($data == $max) {
				$respon  = array('status' => FALSE, 
							'message' => '<div class="alert alert-danger" role="alert">Maksimal Atlet '.$max.' orang.</div>');
				echo json_encode($respon);exit;
			}
		}
	}
	// ========== End Function Global ========== //
}