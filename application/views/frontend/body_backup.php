    <div class="rule-wrapper">
        <h3 class="title-wrap">
            GMEDIA CORPORATE FUN FUTSAL COMPETITION 2019 <br>
            SUMBER WARAS STADIUM 9 - 10 NOVEMBER 2019
        </h3>
        <div id="rule" class="rule-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-rule">
                        <span class="title-rule">Ketentuan Pertandingan</span>
                        <div class="body-rule">
                            <?php echo isset($rule_pertandingan) ? $rule_pertandingan:'';?>
                        </div>
                        <br>
                        <span class="title-rule">Ketentuan Peserta</span>
                        <div class="body-rule">
                            <?php echo isset($rule_peserta) ? $rule_peserta:'';?>
                        </div>
                        <br>
                        <span class="title-rule">Pasal tentang Keselamatan dan Kesehatan Peserta</span>
                        <div class="body-rule">
                            <?php echo isset($pasal_bpjs) ? $pasal_bpjs:'';?>
                        </div>
                        <br>
                        <span class="title-rule">Pelaksanaan Pertandingan</span>
                        <div class="body-rule">
                            <table class="bold">
                                <tr>
                                    <td width="25%" valign="top">Hari / tanggal</td>
                                    <td width="3%" valign="top">:</td>
                                    <td valign="top"><?php echo isset($lokasi->hari_tanggal) ? $lokasi->hari_tanggal:'';?></td>
                                </tr>
                                <tr>
                                    <td valign="top">Lokasi</td>
                                    <td valign="top">:</td>
                                    <td valign="top"><?php echo isset($lokasi->lokasi) ? $lokasi->lokasi:'';?></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <span class="title-rule">Total Hadiah Senilai 10 juta rupiah</span>
                        <div class="body-rule">
                            <?php echo isset($list_hadiah) ? $list_hadiah:'';?>
                        </div>
                        <br>
                        <span class="title-rule">HADIAH TAMBAHAN<br>
                        Jika pemenang adalah CUSTOMER GMEDIA</span>
                        <div class="body-rule">
                            <table class="bold">
                                <tr>
                                    <td valign="top">JUARA 1</td>
                                    <td width="3%" valign="top">&nbsp;:&nbsp;</td>
                                    <td valign="top">Tambahan Rp 2.000.000,-</td>
                                </tr><tr>
                                    <td valign="top">JUARA 2</td>
                                    <td width="3%" valign="top">&nbsp;:&nbsp;</td>
                                    <td valign="top">Tambahan Rp 1.000.000,-</td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <span class="title-rule">Informasi</span>
                        <div class="body-rule">
                            <table>
                                <tr>
                                    <td class="bold">Satria</td>
                                    <td>&nbsp;</td>
                                    <td class="bold">0812-2647-9093</td>
                                </tr>
                                <tr>
                                    <td class="bold">Adhit</td>
                                    <td>&nbsp;</td>
                                    <td class="bold">0852-9066-4046</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div id="register" class="register-wrapper">
        <h3 class="title-wrap">
            REGISTRASI
        </h3>
        <div class="container">
            <form id="form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-register">
                            <div class="row">
                                <input type="text" readonly class="hidden" value="<?php echo isset($josb_id) ? $josb_id:'';?>" name="jobs_id" id="jobs_id">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title tipe-cursor" data-toggle="collapse" data-parent="#accordion" href="#data-perusahaan" aria-expanded="true" aria-controls="data-perusahaan">
                                                    <a class="bold">
                                                    Masukkan Data Perusahaan
                                                    </a>
                                                    <span class="caret pull-right"></span>
                                                </h4>
                                            </div>
                                            <div id="data-perusahaan" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <div id="alert_1" style="display:none;"></div>
                                                    <input type="text" class="hidden" name="id_1" id="id_1" readonly>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NAMA PERUSAHAAN*</label>
                                                                <input type="text" class="form-control"name="nama_perusahaan" id="nama_perusahaan" placeholder="example : PT Media Sarana Data">
                                                                <span class="text_error" id="error_perusahaan"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NAMA TEAM*</label>
                                                                <input type="text" class="form-control" name="nama_tim" id="nama_tim" placeholder="example : Gmedia Cyber Football">
                                                                <span class="text_error" id="error_tim"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NAMA BRAND PERUSAHAAN*</label>
                                                                <input type="text" class="form-control" name="nama_brand" id="nama_brand" placeholder="example : Gmedia">
                                                                <span class="text_error" id="error_brand"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>EMAIL*</label>
                                                                <input type="text" class="form-control" name="email" id="email" placeholder="example : gmedia@gmail.com">
                                                                <span class="text_error" id="error_email"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-primary btn-sm" id="add-1">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="tabel-perusahaan" style="width:100%;">
                                                                    <thead>
                                                                        <tr bgcolor="#FFC500">
                                                                            <th>Nama</th>
                                                                            <th>Brand</th>
                                                                            <th>Tim</th>
                                                                            <th>Email</th>
                                                                            <th width="3%">#</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title tipe-cursor" data-toggle="collapse" data-parent="#accordion" href="#data-official" aria-expanded="true" aria-controls="data-official">
                                                    <a class="bold">
                                                    Masukkan 2 Data Anggota Official
                                                    </a>
                                                    <span class="caret pull-right"></span>
                                                </h4>
                                            </div>
                                            <div id="data-official" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <div id="alert_2" style="display:none;"></div>
                                                    <input type="text" class="hidden" name="id_2" id="id_2" readonly>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NAMA LENGKAP*</label>
                                                                <input type="text" class="form-control" name="nama_lengkap1" id="nama_lengkap1">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO E-KTP* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="file_ektp1" id="file_ektp1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NO HANDPHONE*</label>
                                                                <input type="text" class="form-control" name="no_hp1" id="no_hp1">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>PAS FOTO* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="foto1" id="foto1">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>NO BPJS KETENAGAKERJAAN*</label>
                                                                <input type="text" class="form-control" name="no_bpjs1" id="no_bpjs1">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>NO BPJS KESEHATAN*</label>
                                                                <input type="text" class="form-control" name="no_bpjs_sehat1" id="no_bpjs_sehat1">
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO ID CARD PERUSAHAAN* <sup>(png,jpg,jpeg)</sup></label>
                                                                <input type="file" class="form-control" name="id_card1" id="id_card1">
                                                            </div>
                                                        </div> -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO BPJS KETENAGAKERJAAN* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="bpjs1" id="bpjs1">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO BPJS KESEHATAN / KIS* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="bpjs_sehat1" id="bpjs_sehat1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary btn-sm" type="button" id="add-2">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="tabel-official" style="width:100%;">
                                                                    <thead>
                                                                        <tr bgcolor="#FFC500">
                                                                            <th>Nama</th>
                                                                            <!-- <th>KTP</th> -->
                                                                            <th>No HP</th>
                                                                            <!-- <th>No BPJS KETENAGAKERJAAN</th>
                                                                            <th>No BPJS KESEHATAN</th> -->
                                                                            <th class="text-center">File E-KTP</th>
                                                                            <!-- <th class="text-center">File ID Card</th> -->
                                                                            <th class="text-center">File BPJS KETENAGAKERJAAN</th>
                                                                            <th class="text-center">File BPJS KESEHATAN</th>
                                                                            <th class="text-center">File Foto</th>
                                                                            <th width="3%">#</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title tipe-cursor" data-toggle="collapse" data-parent="#accordion" href="#data-inti" aria-expanded="true" aria-controls="data-inti">
                                                    <a class="bold">
                                                    Masukkan 5 Data Pemain Inti
                                                    </a>
                                                    <span class="caret pull-right"></span>
                                                </h4>
                                            </div>
                                            <div id="data-inti" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <div id="alert_3" style="display:none;"></div>
                                                    <input type="text" class="hidden" name="id_3" id="id_3" readonly>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NAMA LENGKAP*</label>
                                                                <input type="text" class="form-control" name="nama_lengkap2" id="nama_lengkap2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO E-KTP* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="file_ektp2" id="file_ektp2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NO BPJS KETENAGAKERJAAN*</label>
                                                                <input type="text" class="form-control" name="no_bpjs2" id="no_bpjs2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NO BPJS KESEHATAN*</label>
                                                                <input type="text" class="form-control" name="no_bpjs_sehat2" id="no_bpjs_sehat2">
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="row">
                                                        <!-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO ID CARD PERUSAHAAN* <sup>(png,jpg,jpeg)</sup></label>
                                                                <input type="file" class="form-control" name="id_card2" id="id_card2">
                                                            </div>
                                                        </div> -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO BPJS KETENAGAKERJAAN* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="bpjs2" id="bpjs2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO BPJS KESEHATAN / KIS* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="bpjs_sehat2" id="bpjs_sehat2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>PAS FOTO* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="foto2" id="foto2">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary btn-sm" type="button" id="add-3">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="tabel-inti" style="width:100%;">
                                                                    <thead>
                                                                        <tr bgcolor="#FFC500">
                                                                            <th>Nama</th>
                                                                            <th class="text-center">FILE E-KTP</th>
                                                                            <!-- <th>No BPJS KETENAGAKERJAAN</th>
                                                                            <th>No BPJS KESEHATAN</th> -->
                                                                            <!-- <th class="text-center">File ID Card</th> -->
                                                                            <th class="text-center">File BPJS KETENAGAKERJAAN</th>
                                                                            <th class="text-center">File BPJS KESEHATAN</th>
                                                                            <th class="text-center">File Foto</th>
                                                                            <th width="3%">#</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title tipe-cursor" data-toggle="collapse" data-parent="#accordion" href="#data-cadangan" aria-expanded="true" aria-controls="data-cadangan">
                                                    <a class="bold">
                                                    Masukkan 5 Data Pemain Cadangan
                                                    </a>
                                                    <span class="caret pull-right"></span>
                                                </h4>
                                            </div>
                                            <div id="data-cadangan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <div id="alert_4" style="display:none;"></div>
                                                    <input type="text" class="hidden" name="id_4" id="id_4" readonly>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NAMA LENGKAP*</label>
                                                                <input type="text" class="form-control" name="nama_lengkap3" id="nama_lengkap3">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO E-KTP* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="file_ektp3" id="file_ektp3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NO BPJS KETENAGAKERJAAN*</label>
                                                                <input type="text" class="form-control" name="no_bpjs3" id="no_bpjs3">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NO BPJS KESEHATAN*</label>
                                                                <input type="text" class="form-control" name="no_bpjs_sehat3" id="no_bpjs_sehat3">
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="row">
                                                        <!-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO ID CARD PERUSAHAAN* <sup>(png,jpg,jpeg)</sup></label>
                                                                <input type="file" class="form-control" name="id_card3" id="id_card3">
                                                            </div>
                                                        </div> -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO BPJS KETENAGAKERJAAN* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="bpjs3" id="bpjs3">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>FOTO BPJS KESEHATAN / KIS* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="bpjs_sehat3" id="bpjs_sehat3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>PAS FOTO* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                                                <input type="file" class="form-control" name="foto3" id="foto3">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary btn-sm" type="button" id="add-4">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped" id="tabel-cadangan" style="width:100%;">
                                                                    <thead>
                                                                        <tr bgcolor="#FFC500">
                                                                            <th>Nama</th>
                                                                            <!-- <th>KTP</th> -->
                                                                            <!-- <th>No BPJS KETENAGAKERJAAN</th>
                                                                            <th>No BPJS KESEHATAN</th> -->
                                                                            <th class="text-center">File E-KTP</th>
                                                                            <!-- <th class="text-center">File ID Card</th> -->
                                                                            <th class="text-center">File BPJS KETENAGAKERJAAN</th>
                                                                            <th class="text-center">File BPJS KESEHATAN</th>
                                                                            <th class="text-center">File Foto</th>
                                                                            <th width="3%">#</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Bukti Registrasi* <sup>(png,jpg,jpeg) Maks. 1MB</sup></label>
                                        <div>
                                            <input type="file" class="form-control" name="bukti" id="bukti">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="captcha_el" class="g-recaptcha" data-sitekey="6Lfz1LcUAAAAAPIx6KW33lR1vMpFlT_826O6NLFO"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-warning btn-block font-black bold" id="btn-daftar">Daftar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="img-bottom-wrapper text-center">
        <br>
        <h3 class="bold">Supported By</h3>
        <img class="img-supported" style="position: relative;z-index:-1;margin-top:-2%;" src="<?php echo base_url()?>frontend/images/Besar-Logo.jpg" alt="img-bottom">
        <img class="" style="width: 100%;position: relative;z-index:-1;margin-top:-1%;" src="<?php echo base_url()?>frontend/images/picture2.jpg" alt="img-bottom">
    </div>