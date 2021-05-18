<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main_model extends CI_Model
{    
    // Login //
    function cek_user($username='', $password='')
    {
        return $this->db->query("SELECT * FROM ms_user
                                        WHERE username='$username'
                                        AND `password`='$password'
                                        AND `status` !='0'")->row();
    }

    function get_login()
    {
        if ($this->session->userdata('username') == '') {            
            $this->session->set_flashdata('message', '<div class="alert alert-danger">
                                                        <button class="close" data-close="alert"></button>
                                                        <span> Anda harus login dulu </span>
                                                    </div>');
            $this->session->set_flashdata('notifikasi', 'error');
            redirect('');
        } else {
            $this->get_username($this->session->userdata('username'));
        }
    }

    function get_username($username='') 
    {
        $q = $this->db->query("SELECT * FROM ms_user
                                    WHERE username='$username'
                                    AND `status` !='0'")->row();

        if(empty($q)) {
            redirect('Main/logout_process','refresh');
        }
    }
    // End login //
    // Menu //
    function menu()
    {
        $mainmenu  = $this->get_mainmenu()->result();
        $a = 0;
        foreach($mainmenu as $row)
        {
            $data['default']['main_menu'.$a]  = $row->title;
            $data['default']['main_link'.$a]  = $row->link;
            $data['default']['main_note'.$a]  = $row->note;
            $submenu        = $this->get_submenu($row->id);
            $data['default']['main_row'.$a]  = $submenu->num_rows();
            $b = 0;
            foreach($submenu->result() as $rows)
            {
                $data['default']['sub_menu'.$a.$b]  = $rows->title;
                $data['default']['sub_link'.$a.$b]  = $rows->link;
                $supersubmenu    = $this->get_submenu($rows->id);
                $data['default']['sub_row'.$a.$b]     = $supersubmenu->num_rows();
                $c = 0;
                foreach($supersubmenu->result() as $rowss)
                {
                    $data['default']['sub_menuu'.$a.$b.$c]  = $rowss->title;
                    $data['default']['sub_linkk'.$a.$b.$c]  = $rowss->link;
                    $c++;
                }
                $b++;
            }
            $a++;
        }            
        $data['menu'] = $a;
        return $data;
    }

    function get_mainmenu()
    {
        $this->db->from('menu');
        $this->db->where('status ', 1);
        $this->db->where('parent', 0);
        $this->db->where('user', 1);
        return $this->db->get();
    }

    function get_submenu($parent='')
    {
        $this->db->from('menu');
        $this->db->where('status ', 1);
        $this->db->where('parent', $parent);
        $this->db->order_by("sort_by", "asc");
        return $this->db->get();
    }
    // End Menu //

	//global function
	function view_by_id($table='',$condition='',$row='row')
    {
        if($row == 'row') {
            if($condition) {
                return $this->db->where($condition)->get($table)->row();
            } else {
                return $this->db->get($table)->row();
            }
        } else if($row == 'result') {
            if($condition) {
                return $this->db->where($condition)->get($table)->result();
            } else {
                return $this->db->get($table)->result();
            }
        } else if($row == 'num_rows') {
            if($condition) {
                return $this->db->where($condition)->get($table)->num_rows();
            } else {
                return $this->db->get($table)->num_rows();
            }
        }
    }

    function process_data($table='', $data='', $condition='') 
    {
        if($condition) {
            $this->db->where($condition)->update($table, $data);
            return $this->db->affected_rows();
        } else {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }

    function delete_data($table='', $condition='')
    {
        $this->db->where($condition)->delete($table);
        return $this->db->affected_rows();
    }
    //global function

    function tanggal_indo($tgl, $a = 0)
    {     
        $hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
        $hr         = date('w', strtotime($tgl));
        $hari       = $hari_array[$hr];
        $tanggal    = substr($tgl, 8, 2);
        $bulan      = $this->getBulan(substr($tgl, 5, 2));
        $tahun      = substr($tgl, 0, 4);
        $hr_tgl     = "$hari, $tanggal $bulan $tahun";
        if($a > 0) {
            $hr_tgl     = "$tanggal $bulan $tahun";
        }
        return $hr_tgl;
    }

    function getBulan($bln)
    {
        switch ($bln){
            case '01': 
                    return "Januari";
                    break;
            case '02':
                    return "Februari";
                    break;
            case '03':
                    return "Maret";
                    break;
            case '04':
                    return "April";
                    break;
            case '05':
                    return "Mei";
                    break;
            case '06':
                    return "Juni";
                    break;
            case '07':
                    return "Juli";
                    break;
            case '08':
                    return "Agustus";
                    break;
            case '09':
                    return "September";
                    break;
            case '10':
                    return "Oktober";
                    break;
            case '11':
                    return "November";
                    break;
            case '12':
                    return "Desember";
                    break;
        }
    }

    function time_server()
    {
        $query = $this->db->query("SELECT NOW() AS time")->row();
        return isset($query->time) ? $query->time : '';
    }

    function unique_code()
    {
        $date = date_create();
        $timestamp = date_timestamp_get($date);
        $unique = $this->encrypt_unique($timestamp);
        return $unique;
    }

    function encrypt_unique($value='')
    {
        $method   = 'aes-256-cbc';
        $password = substr(hash('sha256', '3sc3RLrpd17', true), 0, 32);
        $iv = chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0).chr(0x0) .chr(0x0).chr(0x0).chr(0x0);
        $encrypted = base64_encode(openssl_encrypt($value, $method, $password, OPENSSL_RAW_DATA, $iv));
        return $encrypted;
    }
    
    function tanggal($tanggal="")
    {
        $create = date_create($tanggal);
        return date_format($create, "Y-m-d");
    }
    
    function convert_tgl($tanggal='')
    {
        $tgl_ex = explode("/", $tanggal);
        return $tgl_ex[2] . "-" . $tgl_ex[1] . "-" . $tgl_ex[0];
    }

    function format_tgl($tanggal='')
    {
        $create = date_create($tanggal);
        if($tanggal != '')
        {
            return date_format($create, "d F Y");
        }
        else
        {
            return '';
        }
    }

    function tanggal_slash($tanggal='')
    {
        if($tanggal != '' && $tanggal != '0000-00-00') {
            $create = date_create($tanggal);
            $result = date_format($create, "d/m/Y");
        } else {
            $result = '';
        }

        return $result;
    }

    function ajax_function()
    {
        $is_ajax = $this->input->is_ajax_request();
        if($is_ajax == TRUE) {
            return TRUE;
        } else {
            show_404();
        }
    }

    function get_counter($kode="")
    {
        $date1 = date("y-m-d");
        $date = date_create($date1);
        $y    = date_format($date, "y");
        $m    = date_format($date, "m");

        $no_nota = "";
        $set_no = "";
        
        $bln = "";
        $thn = "";

        //Cek Nomor Counter
        $cek = $this->view_by_id('counter_nota', array('kode' => $kode));

        if ($cek->bulan != $m || $cek->tahun !=$y) {
            $set_no = 1;
            $bln = $m;
            $thn = $y;
            $no_nota = "0000" . $set_no;
        } else {
            $bln = $m;
            $thn = $y;
            $set_no = $cek->counter + 1;

            if (strlen($set_no) == 1) {
                $no_nota = "0000" . $set_no;
            } elseif (strlen($set_no) == 2) {
                $no_nota = "000" . $set_no;
            } elseif (strlen($set_no) == 3) {
                $no_nota = "00" . $set_no;
            } elseif (strlen($set_no) == 4) {
                $no_nota = "0" . $set_no;
            } else {
                $no_nota = $set_no;
            }
        }
        // === Output nomor nota === //
        $auto_no_nota = $kode . $thn . $bln ."/". $no_nota;
        $data = array(
          'no_nota'   => $auto_no_nota,
          'set_nomor' => $set_no,
          'bulan' => $bln,
          'tahun' => $thn);
        return $data;
    }

    function update_counter($kode='', $data)
    {
        $this->process_data('counter_nota', $data, array('kode' => $kode));
    }

    function random_word($id = 10)
    {
        $pool = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $word = '';
        for ($i = 0; $i < $id; $i++){
            $word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
        }
        return $word; 
    }

    function kirim_email($from='', $to='', $cc='', $bcc='', $subject='', $email='', $attch = '', $flag = 0)
    {
        $this->load->library('email');
        $this->email->clear(TRUE); 

        $config['protocol']     = 'smtp';
        $config['smtp_host']    = '111.68.27.2';
        // $config['smtp_host']    = 'smtpsmg.gmedia.net.id';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = '';
        $config['smtp_pass']    = '';
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['wordwrap']     = true;
      
        $this->email->initialize($config);
        $this->email->from($from, 'CV. Primar Agro Lancar');
        $this->email->to($to);

        if($cc != '' || $bcc != '') {
            $this->email->cc($cc);
            $this->email->bcc($bcc);
        }
            $this->email->subject($subject);
            $this->email->message($email);
            // $this->email->reply_to('pal@gmail.com', 'CV. Primar Agro Lancar');

        if($attch != '') 
        {
            if($flag > 0) 
            {
                foreach ($attch as $row) {
                    if (file_exists($row)) {
                        $this->email->attach($row);
                    }    
                }
            } else {
                if (file_exists($attch)) {
                    $this->email->attach($attch);
                }
            }
        }

        $this->email->send();
        // $res = $this->email->print_debugger();echo json_encode($res);exit;
        return TRUE; 
    }

    function list_ketentuan_pertandingan()
    {
        $data = $this->db->query("SELECT * FROM tb_aturan 
                                    WHERE `status`=1
                                    AND tipe = 'pertandingan'")->result();
        $html = '<ol>';
        foreach ($data as $val) {
            $html .= '<li>'.$val->keterangan.'</li>';
        }
        $html .='</ol>';
        return $html;
    }

    function list_pasal_bpjs()
    {
        $data = $this->db->query("SELECT * FROM tb_aturan 
                                    WHERE `status`=1
                                    AND tipe = 'bpjs'")->result();
        $html = '<ol>';
        foreach ($data as $val) {
            $html .= '<li>'.$val->keterangan.'</li>';
        }
        $html .='</ol>';
        return $html;
    }

    function list_ketentuan_peserta()
    {
        $data = $this->db->query("SELECT * FROM tb_aturan 
                                    WHERE `status`=1
                                    AND tipe = 'peserta'")->result();
        $html = '<ol>';
        foreach ($data as $val) {
            $html .= '<li>'.$val->keterangan.'</li>';
        }
        $html .='</ol>';
        return $html;
    }

    function get_lokasi_pertandingan()
    {
        return $this->db->query("SELECT * FROM tb_lokasi
                                    WHERE `status`=1")->row();
    }

    function list_hadiah()
    {
        $data = $this->db->query("SELECT * FROM tb_hadiah
                                    WHERE `status`=1")->result();
        $html = '<table class="bold">';
        foreach ($data as $val) {
            $html .='<tr>
                        <td valign="top">'.$val->judul.'</td>
                        <td width="3%" valign="top">:</td>
                        <td valign="top">Rp '.uang($val->hadiah).',-</td>
                    </tr>';
        }
        $html .= '</table>';
        return $html;
    }

    function jumlah_official($jobs_id='')
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah 
                                    FROM temp_tb_anggota 
                                    WHERE jobs_id='$jobs_id'")->row();
        $jumlah = isset($get->jumlah) ? $get->jumlah:0;
        return $jumlah;
    }

    function jumlah_inti($jobs_id='')
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah 
                                    FROM temp_tb_pemain 
                                    WHERE kategori='inti'
                                    AND jobs_id='$jobs_id'")->row();
        $jumlah = isset($get->jumlah) ? $get->jumlah:0;
        return $jumlah;
    }

    function jumlah_cadangan($jobs_id='')
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah 
                                    FROM temp_tb_pemain 
                                    WHERE kategori='cadangan'
                                    AND jobs_id='$jobs_id'")->row();
        $jumlah = isset($get->jumlah) ? $get->jumlah:0;
        return $jumlah;
    }

    function transaksi_proses_daftar_futsal($data_perusahaan, $jobs_id='')
    {
        $respon = array();
            // transaction begin
            $this->db->trans_begin();

            $get_no  = $this->get_counter('INV');
            $nomor   = $get_no['no_nota'];
            $data_counter = array(
                            'counter'=> $get_no['set_nomor'],
                            'bulan'  => $get_no['bulan'],
                            'tahun'  => $get_no['tahun']
                        );
            // update counter
            $this->update_counter('INV', $data_counter);
            // push value //
            $data_perusahaan->nomor = $nomor;

            // insert data perusahaan //
            $id_perusahaan = $this->process_data('tb_perusahaan', $data_perusahaan);

            // insert data anggota //
            $this->db->query("INSERT INTO tb_anggota(`id_perusahaan`,`nama`,`no_ktp`,`no_bpjs`,`no_bpjs_kesehatan`,`no_hp`,
                            `file_ktp`,`file_pas_foto`,`file_id_card`,`file_bpjs`,`file_bpjs_kesehatan`,`status`,`user_insert`)
                            SELECT '$id_perusahaan' AS id_perusahaan, nama, no_ktp, no_bpjs, no_bpjs_kesehatan, no_hp, 
                                file_ktp, file_pas_foto, file_id_card, file_bpjs, file_bpjs_kesehatan, `status`, '$jobs_id' AS user_insert
                                FROM temp_tb_anggota
                                WHERE jobs_id='$jobs_id'");

            // insert data pemain inti //
            $this->db->query("INSERT INTO tb_pemain(`id_perusahaan`,`nama`,`no_ktp`,`no_bpjs`,`no_bpjs_kesehatan`,
                            `file_ktp`,`file_pas_foto`,`file_id_card`,`file_bpjs`,`file_bpjs_kesehatan`,`kategori`,`status`,`user_insert`)
                            SELECT '$id_perusahaan' AS id_perusahaan, nama, no_ktp, no_bpjs, no_bpjs_kesehatan, 
                                file_ktp, file_pas_foto, file_id_card, file_bpjs, file_bpjs_kesehatan, kategori, `status`, '$jobs_id' AS user_insert 
                                FROM temp_tb_pemain
                                WHERE kategori='inti'
                                AND jobs_id='$jobs_id'");

            // insert data pemain cadangan //
            $this->db->query("INSERT INTO tb_pemain(`id_perusahaan`,`nama`,`no_ktp`,`no_bpjs`,`no_bpjs_kesehatan`,
                            `file_ktp`,`file_pas_foto`,`file_id_card`,`file_bpjs`,`file_bpjs_kesehatan`,`kategori`,`status`,`user_insert`)
                            SELECT '$id_perusahaan' AS id_perusahaan, nama, no_ktp, no_bpjs, no_bpjs_kesehatan,
                                file_ktp, file_pas_foto, file_id_card, file_bpjs, file_bpjs_kesehatan, kategori, `status`, '$jobs_id' AS user_insert 
                                FROM temp_tb_pemain
                                WHERE kategori='cadangan'
                                AND jobs_id='$jobs_id'");

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();

                $respon = array('status'=>FALSE, 'message'=>'Proses Pendaftaran gagal');
            } else {
                $this->db->trans_commit();

                $respon = array('status'=>TRUE, 'message'=>'Proses Pendaftaran berhasil, Terima kasih telah melakukan registrasi. <br> Mohon di tunggu konfirmasi dari pihak admin Gmedia.','id'=>$id_perusahaan);
            }
        return $respon;
    }

    // =============== Function form cheerleader =============== //
    function list_ketentuan_pertandingan_cheer()
    {
        $data = $this->db->query("SELECT * FROM cheer_tb_aturan 
                                    WHERE `status`=1
                                    AND tipe = 'pertandingan'")->result();
        $html = '<ol>';
        foreach ($data as $val) {
            $html .= '<li>'.$val->keterangan.'</li>';
        }
        $html .='</ol>';
        return $html;
    }

    function list_ketentuan_peserta_cheer()
    {
        $data = $this->db->query("SELECT * FROM cheer_tb_aturan 
                                    WHERE `status`=1
                                    AND tipe = 'peserta'")->result();
        $html = '<ol>';
        foreach ($data as $val) {
            $html .= '<li>'.$val->keterangan.'</li>';
        }
        $html .='</ol>';
        return $html;
    }

    function list_hadiah_cheer()
    {
        $data = $this->db->query("SELECT * FROM cheer_tb_hadiah
                                    WHERE `status`=1")->result();
        $html = '<table>';
        foreach ($data as $val) {
            $html .='<tr>
                        <td valign="top" class="bold">'.$val->judul.'</td>
                        <td width="3%" valign="top">&nbsp;:&nbsp;</td>
                        <td valign="top">Rp '.uang($val->hadiah).',- + Thropy + Sertifikat</td>
                    </tr>';
        }
        $html .= '</table>';
        return $html;
    }

    function get_lokasi_pertandingan_cheer()
    {
        return $this->db->query("SELECT * FROM cheer_tb_lokasi
                                    WHERE `status`=1")->row();
    }

    function data_organisasi($jobs_id='')
    {
        return $this->db->query("SELECT *, IF(kategori_tim = 'coed','COED','ALL GIRLS') AS kategori 
                                    FROM temp_cheer_tb_organisasi
                                    WHERE jobs_id='$jobs_id'")->result();
    }

    function data_pelatih($jobs_id='')
    {
        return $this->db->query("SELECT * FROM temp_cheer_tb_pelatih
                                    WHERE jobs_id='$jobs_id'")->result();
    }

    function data_official_cheer($jobs_id='')
    {
        return $this->db->query("SELECT * FROM temp_cheer_tb_anggota
                                    WHERE jobs_id='$jobs_id'")->result();
    }

    function data_pemain_cheer($jobs_id='')
    {
        return $this->db->query("SELECT *, IF(kelamin = 'L', 'Laki-laki','Perempuan') AS jenis_kelamin,
                                    TIMESTAMPDIFF(YEAR, tanggal_lahir, NOW()) AS usia  
                                    FROM temp_cheer_tb_pemain
                                    WHERE jobs_id='$jobs_id'")->result();
    }

    function jumlah_official_cheer($jobs_id='')
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah 
                                    FROM temp_cheer_tb_anggota 
                                    WHERE jobs_id='$jobs_id'")->row();
        $jumlah = isset($get->jumlah) ? $get->jumlah:0;
        return $jumlah;
    }

    function jumlah_pelatih($jobs_id='')
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah 
                                    FROM temp_cheer_tb_pelatih 
                                    WHERE jobs_id='$jobs_id'")->row();
        $jumlah = isset($get->jumlah) ? $get->jumlah:0;
        return $jumlah;
    }

    function jumlah_pemain_cheer($jobs_id='')
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah 
                                    FROM temp_cheer_tb_pemain 
                                    WHERE jobs_id='$jobs_id'")->row();
        $jumlah = isset($get->jumlah) ? $get->jumlah:0;
        return $jumlah;
    }

    function transaksi_proses_daftar_cheer($data_organisasi, $jobs_id='')
    {
        $respon = array();
            // transaction begin
            $this->db->trans_begin();

            $get_no  = $this->get_counter('INV');
            $nomor   = $get_no['no_nota'];
            $data_counter = array(
                            'counter'=> $get_no['set_nomor'],
                            'bulan'  => $get_no['bulan'],
                            'tahun'  => $get_no['tahun']
                        );
            // update counter
            $this->update_counter('INV', $data_counter);
            // push value //
            $data_organisasi->nomor = $nomor;

            // insert data organisasi //
            $id_organisasi = $this->process_data('cheer_tb_organisasi', $data_organisasi);

            // insert data pelatih //
            $this->db->query("INSERT INTO cheer_tb_pelatih(`id_organisasi`,`nama`,`no_hp`,`status`,`user_insert`)
                            SELECT '$id_organisasi' AS id_organisasi, nama, no_hp, `status`, '$jobs_id' AS user_insert
                                FROM temp_cheer_tb_pelatih
                                WHERE jobs_id='$jobs_id'");

            // insert data anggota //
            $this->db->query("INSERT INTO cheer_tb_anggota(`id_organisasi`,`nama`,`no_hp`,`no_ktp`,`file_ktp`,`status`,`user_insert`)
                            SELECT '$id_organisasi' AS id_organisasi, nama, no_hp, no_ktp, file_ktp, `status`, '$jobs_id' AS user_insert
                                FROM temp_cheer_tb_anggota
                                WHERE jobs_id='$jobs_id'");

            // insert data pemain cheer //
            $this->db->query("INSERT INTO cheer_tb_pemain (`id_organisasi`,`nama`,`kelamin`,`umur`,`tanggal_lahir`,
                            `nomor_identitas`,`file_id`,`status`,`user_insert`)
                            SELECT '$id_organisasi' AS id_organisasi, nama, kelamin, umur, tanggal_lahir, 
                                nomor_identitas, `file_id`, `status`, '$jobs_id' AS user_insert
                                FROM temp_cheer_tb_pemain
                                WHERE jobs_id='$jobs_id'");

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();

                $respon = array('status'=>FALSE, 'message'=>'Proses Pendaftaran gagal');
            } else {
                $this->db->trans_commit();

                $respon = array('status'=>TRUE, 'message'=>'Proses Pendaftaran berhasil, Terima kasih telah melakukan registrasi. <br> Mohon di tunggu konfirmasi dari pihak admin Gmedia.','id'=>$id_organisasi);
            }
        return $respon;
    }

    function jumlah_pendaftar_futsal()
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah 
                                    FROM tb_perusahaan
                                    WHERE `status`=1")->row();
        $result = isset($get->jumlah) ? $get->jumlah:0;
        return $result;
    }

    function jumlah_pendaftar_cheer()
    {
        $get = $this->db->query("SELECT COUNT(*) AS jumlah
                                    FROM cheer_tb_organisasi
                                    WHERE `status`=1")->row();
        $result = isset($get->jumlah) ? $get->jumlah:0;
        return $result;
    }
    
    function data_tebak_skor_view()
    {
        return $this->db->query("SELECT * FROM tb_tebak_skor WHERE `status`=1")->result();
    }
}
?>