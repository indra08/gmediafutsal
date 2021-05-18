<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cheers extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Pendaftar_model');
		$this->load->library('upload');
		$this->Main_model->get_login();
	}
	  
	public function index()
	{
		$data['title']  = 'Pendaftar Cheerleader';
        $data['title2'] = 'Data Pendaftar Cheerleader';
        $data['app']    = 'pendaftar/data_pendaftar_cheer.js';
		$this->load->view('admin/head', $data);
		$this->load->view('admin/menu', $this->Main_model->menu());
		$this->load->view('admin/pendaftar/cheer_data_pendaftar', $data);
		$this->load->view('admin/footer', $data);
	}

	public function detail_data()
	{
		$id = $this->input->get('q');
		$data['title']  = 'Detail Pendaftar Cheerleader';
		$data['title2'] = 'Data Detail Pendaftar Cheerleader';
		$data['detail'] = $this->Pendaftar_model->data_pendaftar_cheer_id($id);
        $data['app']    = 'pendaftar/detail_pendaftar_cheer.js';
		$this->load->view('admin/head', $data);
		$this->load->view('admin/menu', $this->Main_model->menu());
		$this->load->view('admin/pendaftar/cheer_detail_pendaftar', $data);
		$this->load->view('admin/footer', $data);
    }
    
    function ajax_data_pendaftar()
	{
		$this->Main_model->ajax_function();
		$data = $this->Pendaftar_model->data_pendaftar_cheer();
			$arr = array();
			$no  = 1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$url_img    = "'".$val->file_bukti."'";
					$nama_organisasi = "'".$val->nama_organisasi."'";
					$invoice    = "invoice_".str_replace(" ","_",strtolower($val->nama_organisasi)).".pdf";
					$btn_action = '<div class="btn-group">
	                                    <button class="btn blue dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action
	                                        <i class="fa fa-angle-down"></i>
	                                    </button>
	                                    <ul class="dropdown-menu">
	                                        <li>
	                                            <a href="'.base_url().'pendaftar/Cheers/detail_data?q='.$val->id.'"> Detail Data</a>
											</li>
											<li>
	                                            <a href=""> Kirim Invoice</a>
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
									'organisasi' => $val->nama_organisasi,
									'tim' => $val->nama_tim,
									'divisi' => $val->divisi,
									'email' => $val->email,
									'bukti' => '<img onclick="zoom('.$url_img.','.$nama_organisasi.')" width="100px" style="cursor:pointer;" src="'.$val->file_bukti.'">',
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
		$check = $this->Main_model->view_by_id('cheer_tb_organisasi', array('id'=>$id,'verif'=>'1'));
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
		$this->Main_model->process_data('cheer_tb_organisasi', $data_update, array('id'=>$id));
		$respon = array('status'=>TRUE, 'message'=>'Data berhasil diverifikasi');
		echo json_encode($respon);exit;
    }
    
    function ajax_kirim_invoice($id='')
	{
		$this->Main_model->ajax_function();
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
		$id_organisasi = $this->input->get('id');
		$data = $this->Pendaftar_model->data_anggota_cheer($id_organisasi);
			$arr = array();
			$no=1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$url_ktp   = "'".$val->file_ktp."'";
					$arr[$row] = array(
									'no' => $no++,
									'nama' => $val->nama,
									'no_hp' => $val->no_hp,
									'file_ktp' => '<img onclick="zoom('.$url_ktp.')" width="125px" src="'.$val->file_ktp.'" style="cursor:pointer;">'
								);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_data_pelatih()
	{
		$this->Main_model->ajax_function();
		$id_organisasi = $this->input->get('id');
		$data = $this->Pendaftar_model->data_pelatih_cheer($id_organisasi);
			$arr = array();
			$no=1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$arr[$row] = array(
									'no' => $no++,
									'nama' => $val->nama,
									'no_hp' => $val->no_hp
								);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}

	function ajax_data_atlet()
	{
		$this->Main_model->ajax_function();
		$id_organisasi = $this->input->get('id');
		$data = $this->Pendaftar_model->data_pemain_cheer($id_organisasi);
			$arr = array();
			$no=1;
			if(!empty($data)) {
				foreach ($data as $row => $val) {
					$url_id    = "'".$val->file_id."'";
					$arr[$row] = array(
									'no' => $no++,
									'nama' => $val->nama,
									'jenis_kelamin' => $val->jenis_kelamin,
									'tanggal_lahir' => $this->Main_model->tanggal_slash($val->tanggal_lahir),
									'usia' => $val->usia.' Tahun',
									'file_id' => '<img onclick="zoom('.$url_id.')" width="125px" src="'.$val->file_id.'" style="cursor:pointer;">'
								);
				}
			}
			$json = array('data'=>$arr);
		echo json_encode($json);
	}
}