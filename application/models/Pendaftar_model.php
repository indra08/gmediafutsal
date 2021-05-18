<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pendaftar_model extends CI_Model
{    
    // ===== Function Futsal ===== //
    function data_pendaftar_futsal()
    {
        return $this->db->query("SELECT p.*, CAST(p.tanggal_insert AS DATE) AS tanggal, 
                                    IFNULL(a.jml_anggota,0) AS jml_anggota,
                                    IFNULL(i.jml_pemain_inti,0) AS jml_pemain_inti,
                                    IFNULL(c.jml_pemain_cadangan,0) AS jml_pemain_cadangan,
                                    IF(p.verif = '0','Not Verified','Verified') AS status_verif,
                                    a.pic
                                    FROM tb_perusahaan p
                                    LEFT JOIN (
                                        SELECT id_perusahaan, GROUP_CONCAT('<br>',nama,' - ',no_hp) AS pic, 
                                            COUNT(*) AS jml_anggota
                                            FROM tb_anggota
                                            WHERE `status`=1
                                            GROUP BY id_perusahaan
                                    ) a ON p.id=a.id_perusahaan
                                    LEFT JOIN (
                                        SELECT id_perusahaan, COUNT(*) AS jml_pemain_inti
                                            FROM tb_pemain
                                            WHERE `status`=1
                                            AND kategori='inti'
                                            GROUP BY id_perusahaan
                                    ) i ON p.id=i.id_perusahaan
                                    LEFT JOIN (
                                        SELECT id_perusahaan, COUNT(*) AS jml_pemain_cadangan
                                            FROM tb_pemain
                                            WHERE `status`=1
                                            AND kategori='cadangan'
                                            GROUP BY id_perusahaan
                                    ) c ON p.id=c.id_perusahaan
                                    WHERE p.status=1")->result();
    }

    function data_pendaftar_futsal_id($id='')
    {
        return $this->db->query("SELECT p.*, CAST(p.tanggal_insert AS DATE) AS tanggal, 
                                    IFNULL(a.jml_anggota,0) AS jml_anggota,
                                    IFNULL(i.jml_pemain_inti,0) AS jml_pemain_inti,
                                    IFNULL(c.jml_pemain_cadangan,0) AS jml_pemain_cadangan,
                                    IF(p.verif = '0','Not Verified','Verified') AS status_verif,
                                    a.pic
                                    FROM tb_perusahaan p
                                    LEFT JOIN (
                                        SELECT id_perusahaan, GROUP_CONCAT('<br> ',nama,' - ',no_hp) AS pic, 
                                            COUNT(*) AS jml_anggota
                                            FROM tb_anggota
                                            GROUP BY id_perusahaan
                                    ) a ON p.id=a.id_perusahaan
                                    LEFT JOIN (
                                        SELECT id_perusahaan, COUNT(*) AS jml_pemain_inti
                                            FROM tb_pemain
                                            WHERE kategori='inti'
                                            GROUP BY id_perusahaan
                                    ) i ON p.id=i.id_perusahaan
                                    LEFT JOIN (
                                        SELECT id_perusahaan, COUNT(*) AS jml_pemain_cadangan
                                            FROM tb_pemain
                                            WHERE kategori='cadangan'
                                            GROUP BY id_perusahaan
                                    ) c ON p.id=c.id_perusahaan
                                    WHERE p.status=1
                                    AND p.id='$id'")->row();
    }

    function data_anggota_futsal($id_perusahaan='')
    {
        return $this->db->query("SELECT * FROM tb_anggota
                                    WHERE `status`=1
                                    AND id_perusahaan='$id_perusahaan'")->result();
    }

    function data_pemain_inti($id_perusahaan='')
    {
        return $this->db->query("SELECT * FROM tb_pemain
                                    WHERE `status`=1
                                    AND kategori='inti'
                                    AND id_perusahaan='$id_perusahaan'")->result();
    }

    function data_pemain_cadangan($id_perusahaan='')
    {
        return $this->db->query("SELECT * FROM tb_pemain
                                    WHERE `status`=1
                                    AND kategori='cadangan'
                                    AND id_perusahaan='$id_perusahaan'")->result();
    }
    // ===== End Function Futsal ===== //

    // ===== Function Cheers ===== //
    function data_pendaftar_cheer()
    {
        return $this->db->query("SELECT o.*, CAST(o.tanggal_insert AS DATE) AS tanggal, 
                                    IFNULL(a.jml_anggota,0) AS jml_anggota,
                                    IFNULL(p.jml_pelatih,0) AS jml_pelatih,
                                    IFNULL(c.jml_pemain,0) AS jml_pemain,
                                    IF(o.kategori_tim = 'coed','Coed','All Girl') AS divisi,
                                    IF(o.verif = '0','Not Verified','Verified') AS status_verif, a.pic
                                    FROM cheer_tb_organisasi o
                                    LEFT JOIN (
                                        SELECT id_organisasi, GROUP_CONCAT('<br>',nama,' - ',no_hp) AS pic, COUNT(*) AS jml_anggota 
                                            FROM cheer_tb_anggota
                                            WHERE `status`=1
                                            GROUP BY id_organisasi
                                    ) a ON o.id=a.id_organisasi
                                    LEFT JOIN (
                                        SELECT id_organisasi, COUNT(*) AS jml_pelatih
                                            FROM cheer_tb_pelatih
                                            WHERE `status`=1
                                            GROUP BY id_organisasi
                                    ) p ON o.id=p.id_organisasi
                                    LEFT JOIN (
                                        SELECT id_organisasi, COUNT(*) AS jml_pemain
                                            FROM cheer_tb_pemain
                                            WHERE `status`=1
                                            GROUP BY id_organisasi
                                    ) c ON o.id=c.id_organisasi
                                    WHERE o.`status`=1")->result();
    }

    function data_pendaftar_cheer_id($id='')
    {
        return $this->db->query("SELECT o.*, CAST(o.tanggal_insert AS DATE) AS tanggal,
                                    IFNULL(a.jml_anggota,0) AS jml_anggota,
                                    IFNULL(p.jml_pelatih,0) AS jml_pelatih,
                                    IFNULL(c.jml_pemain,0) AS jml_pemain,
                                    IF(o.kategori_tim = 'coed','Coed','All Girl') AS divisi,
                                    IF(o.verif = '0','Not Verified','Verified') AS status_verif, a.pic
                                    FROM cheer_tb_organisasi o
                                    LEFT JOIN (
                                        SELECT id_organisasi, GROUP_CONCAT('<br> ',nama,' - ',no_hp) AS pic, COUNT(*) AS jml_anggota 
                                            FROM cheer_tb_anggota
                                            WHERE `status`=1
                                            GROUP BY id_organisasi
                                    ) a ON o.id=a.id_organisasi
                                    LEFT JOIN (
                                        SELECT id_organisasi, COUNT(*) AS jml_pelatih
                                            FROM cheer_tb_pelatih
                                            WHERE `status`=1
                                            GROUP BY id_organisasi
                                    ) p ON o.id=p.id_organisasi
                                    LEFT JOIN (
                                        SELECT id_organisasi, COUNT(*) AS jml_pemain
                                            FROM cheer_tb_pemain
                                            WHERE `status`=1
                                            GROUP BY id_organisasi
                                    ) c ON o.id=c.id_organisasi
                                    WHERE o.`status`=1
                                    AND o.`id`='$id'")->row();
    }

    function data_anggota_cheer($id_organisasi='')
    {
        return $this->db->query("SELECT * FROM cheer_tb_anggota
                                    WHERE `status`=1
                                    AND id_organisasi='$id_organisasi'")->result();
    }

    function data_pelatih_cheer($id_organisasi='')
    {
        return $this->db->query("SELECT * FROM cheer_tb_pelatih
                                    WHERE `status`=1
                                    AND id_organisasi='$id_organisasi'")->result();
    }

    function data_pemain_cheer($id_organisasi='')
    {
        return $this->db->query("SELECT *, IF(kelamin = 'L', 'Laki-laki','Perempuan') AS jenis_kelamin,
                                    TIMESTAMPDIFF(YEAR, tanggal_lahir, NOW()) AS usia 
                                    FROM cheer_tb_pemain
                                    WHERE `status`=1
                                    AND id_organisasi='$id_organisasi'")->result();
    }
    // ===== End Function Cheers ===== //
}
?>