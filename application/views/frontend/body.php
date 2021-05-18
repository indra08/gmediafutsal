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
            SCORE
        </h3>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="text-center">
                        <h3 class="title-wrap">
                            
                        </h3>
                    </span>
                    <br>
                    <div id="score">
                        <div style="padding: 0px;">
                            <div style="height:420px;overflow-y:hidden;">
                                <iframe id="challonge_frame" src="https://challonge.com/GCFFC19/module" width="100%" height="500" frameborder="0" scrolling="auto" allowtransparency="true"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="img-bottom-wrapper text-center">
        <br>
        <h3 class="bold">Supported By</h3>
        <img class="img-supported" style="position: relative;z-index:-1;margin-top:-2%;" src="<?php echo base_url()?>frontend/images/Besar-Logo.jpg" alt="img-bottom">
        <img class="" style="width: 100%;position: relative;z-index:-1;margin-top:-1%;" src="<?php echo base_url()?>frontend/images/picture2.jpg" alt="img-bottom">
    </div>