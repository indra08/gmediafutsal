<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="container-fluid">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <span class="bold"><?php echo isset($title) ? $title:'';?></span>
                </div>
                <!-- END PAGE TITLE -->
                <!-- BEGIN PAGE TOOLBAR -->
                
                <!-- END PAGE TOOLBAR -->
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content">
            <div class="container-fluid">
                <!-- BEGIN PAGE BREADCRUMBS -->
                
                <!-- END PAGE BREADCRUMBS -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light form-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject sbold uppercase"><?php echo isset($title2) ? $title2:'';?> - <?php echo isset($detail->nama_perusahaan) ? $detail->nama_perusahaan:'';?></span>
                                    </div>
                                    <div class="actions">
                                        <div class="btn-group btn-group-devided form-inline">
                                            <div class="form-group">
                                                <strong><?php echo isset($detail->status_verif) ? $detail->status_verif:'';?></strong>
                                            </div>
                                            &nbsp;
                                            <div class="form-group">
                                                <a class="btn btn-default btn-sm btn-circle" title="Kembali" href="<?php echo base_url()?>pendaftar/Futsal"><i class="fa fa-arrow-left"></i> Kembali</a>
                                            </div>
                                            &nbsp;
                                            <div class="form-group">
                                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                            </div>                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <div class="row number-stats margin-bottom-30">
                                        <div class="col-md-12">
                                            <input type="hidden" value="<?php echo isset($detail->id) ? $detail->id:'';?>" id="id">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <label class="bold">Perusahaan</label>
                                                    <div><?php echo isset($detail->nama_perusahaan) ? $detail->nama_perusahaan:'';?></div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="form-group">
                                                    <label class="bold">Brand</label>
                                                    <div><?php echo isset($detail->nama_brand) ? $detail->nama_brand:'';?></div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="form-group">
                                                    <label class="bold">Nama Tim</label>
                                                    <div><?php echo isset($detail->nama_tim) ? $detail->nama_tim:'';?></div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="form-group">
                                                    <label class="bold">Email</label>
                                                    <div><?php echo isset($detail->email) ? $detail->email:'';?></div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="form-group">
                                                    <label class="bold">PIC</label>
                                                    <div><?php echo isset($detail->pic) ? str_replace("<br>","",$detail->pic):'';?></div>
                                                </div>
                                                <br><br><br>
                                                <div class="form-group">
                                                    <label class="bold">Jumlah Official</label>
                                                    <div class="text-center"><?php echo isset($detail->jml_anggota) ? $detail->jml_anggota:'';?> Official</div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="form-group">
                                                    <label class="bold">Jumlah Pemain Inti</label>
                                                    <div class="text-center"><?php echo isset($detail->jml_pemain_inti) ? $detail->jml_pemain_inti:'';?> Pemain</div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="form-group">
                                                    <label class="bold">Jumlah Pemain Cadangan</label>
                                                    <div class="text-center"><?php echo isset($detail->jml_pemain_cadangan) ? $detail->jml_pemain_cadangan:'';?> Pemain</div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="tabbable-line">
                                                <ul class="nav nav-tabs ">
                                                    <li class="active">
                                                        <a href="#tab1" data-toggle="tab" onclick="loadOfficial()"> Official </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab2" data-toggle="tab" onclick="loadInti()"> Pemain Inti </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab3" data-toggle="tab" onclick="loadCadangan()"> Pemain Cadangan </a>
                                                    </li>
                                                </ul>
                                                <?php 
                                                    $username = $this->session->userdata('username');
                                                ?>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab1">
                                                        <table id="table-official" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th width="20%">Nama</th>
                                                                    <th>No. HP</th>
                                                                    <th>KTP</th>
                                                                    <th>Pas Foto</th>
                                                                    <th>BPJS Ketenagakerjaan</th>
                                                                    <th>BPJS Kesehatan / KIS</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <div class="tab-pane" id="tab2">
                                                        <?php if($username == 'akbar') { ?>
                                                        <button type="button" data-toggle="modal" data-target="#modal_form" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Pemain</button>
                                                        <?php } ?>
                                                        <table id="table-inti" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th width="20%">Nama</th>
                                                                    <th>KTP</th>
                                                                    <th>Pas Foto</th>
                                                                    <th>BPJS Ketenagakerjaan</th>
                                                                    <th>BPJS Kesehatan / KIS</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <div class="tab-pane" id="tab3">
                                                        <?php if($username == 'akbar') { ?>
                                                        <button type="button" data-toggle="modal" data-target="#modal_form" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Pemain</button>
                                                        <?php } ?>
                                                        <table id="table-cadangan" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th width="20%">Nama</th>
                                                                    <th>KTP</th>
                                                                    <th>Pas Foto</th>
                                                                    <th>BPJS Ketenagakerjaan</th>
                                                                    <th>BPJS Kesehatan / KIS</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
        <!-- END PAGE CONTENT BODY -->
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<div class="modal fade" id="modal_img" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 id="title-modal" class="bold">Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <img id="img_zoom" class="img-responsive"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-modal-lg" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 id="title-modal" class="bold">Form Tambah Pemain</h4>
            </div>
            <div class="modal-body">
                <form id="form-data">
                    <input type="hidden" readonly value="<?php echo isset($detail->id) ? $detail->id:'';?>" id="id_perusahaan" name="id_perusahaan">
                    <input type="hidden" readonly id="id_pemain" name="id_pemain">
                    <div class="row">
                        <div class="col-md-10 form-group">
                            <label>Nama Pemain</label>
                            <div>
                                <input type="text" class="form-control input-sm" name="nama" id="nama">
                            </div>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Kategori</label>
                            <div>
                                <select class="form-control input-sm" name="kategori" id="kategori">
                                    <option value="inti">Inti</option>
                                    <option value="cadangan">Cadangan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>KTP</label>
                            <div>
                                <input type="file" class="form-control" name="file_ektp" id="file_ektp">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>BPJS Ketenagakerjaan</label>
                            <div>
                                <input type="file" class="form-control" name="bpjs" id="bpjs">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>BPJS Kesehatan</label>
                            <div>
                                <input type="file" class="form-control" name="bpjs_sehat" id="bpjs_sehat">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Foto</label>
                            <div>
                                <input type="file" class="form-control" name="foto" id="foto">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" id="add" class="btn btn-primary btn-sm" onclick="addPemain()">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>