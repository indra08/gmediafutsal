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
                <div class="page-toolbar">
                    <div class="page-title">
                        <?php echo $this->Main_model->tanggal_indo(date('Y-m-d'));?>
                    </div>
                </div>
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
                            <h2> Selamat Datang di Sistem FUTSAL </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="<?php echo isset($jml_futsal) ? $jml_futsal:0;?>">0</span>
                                            <small class="font-green-sharp"></small>
                                        </h3>
                                        <small>PENDAFTAR FUTSAL</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only"></span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> <a href="<?php echo base_url()?>pendaftar/Futsal"> Lihat Semua</a> </div>
                                        <div class="status-number"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="<?php echo isset($jml_cheers) ? $jml_cheers:0;?>">0</span>
                                            <small class="font-green-sharp"></small>
                                        </h3>
                                        <small>PENDAFTAR CHEERLEADING</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only"></span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> <a href="<?php echo base_url()?>pendaftar/Cheers"> Lihat Semua</a> </div>
                                        <div class="status-number"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            
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
<!-- END CONTAINER-->
<?php $this->load->view('admin/footer');?>
<script>
    msg ='<img src="'+base_url+'assets/global/img/loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;LOADING...</span>';
</script>