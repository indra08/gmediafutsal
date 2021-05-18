<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="Corporate Fun Futsal Competition di Semarang" name="description" />
    <meta content="PT Media Sarana Data" name="author" />
    <meta name="theme-color" content="#ffffff">
    <title><?php echo isset($title) ? $title:'';?></title>
    <link rel="icon" href="<?php echo base_url()?>frontend/images/icon.png" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>frontend/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>frontend/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>frontend/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>frontend/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>frontend/datatable/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>frontend/css/custom.css<?php echo '?v='.rand();?>" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" id="btn-toggle" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="background:#ededed;">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand " href="#">
                        <img width="40px" src="frontend/images/PIP.png" />
                    </a>
                    <a class="navbar-brand " href="#">
                        <img width="35px" src="frontend/images/kadin.png" />
                    </a> -->
                    <a class="navbar-brand" href="#">
                        <img class="logo-gmedia" src="<?php echo base_url()?>frontend/images/gmedia-outer-glow.png" />
                    </a>
                    <a class="navbar-brand" href="#">
                        <img class="logo-kadin" src="<?php echo base_url()?>frontend/images/kadin-semarang-hitam.png" />
                    </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse" style="font-size:18px;">
                    <ul class="nav navbar-nav">
                        <!-- <li class="active">
                            <a href="#" class="font-black bold">Home</a>
                        </li> -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle font-black bold" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >Futsal Competition <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url()?>Main#rule" id="btn-ketentuan">Ketentuan</a></li>
                                <li><a href="<?php echo base_url()?>Main#register" id="btn-register">Registrasi</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="font-black bold" class="dropdown-toggle font-black bold" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cheerleading Contest <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url()?>Cheer#rule" id="btn-ketentuan">Ketentuan</a></li>
                                <li><a href="<?php echo base_url()?>Cheer#register" id="btn-register">Registrasi</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="font-black bold" class="dropdown-toggle font-black bold" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download Poster <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="<?php echo base_url()?>frontend/images/poster.jpg">Poster Futsal</a></li>
                                <li><a target="_blank" href="<?php echo base_url()?>frontend/images/chearleading_contest_poster.jpg">Poster Cheerleading</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <div class="nav navbar-nav navbar-center">
                        <div style="padding:10px;">
                            <a href="frontend/images/poster.jpg" target="_blank" class="btn btn-warning font-black bold" title="Download Poster">Download Poster</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </nav>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <!-- <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            </ol> -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img width="100%" src="<?php echo isset($url_banner) ? $url_banner:'';?>" alt="Banner">
                    <div class="carousel-caption custom_carousel_caption">
                        <!-- <button type="button" onclick="alert('coming soon')" class="btn btn-warning font-black bold" title="Download Poster">Download Poster</button> -->
                    </div>
                </div>
                <!-- <div class="item">
                    <img width="100%" src="<?php // echo base_url()?>frontend/images/slide2.jpg" alt="Cheer">
                    <div class="carousel-caption">
                        
                    </div>
                </div> -->
            </div>

            <!-- Controls -->
            <!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev" style="background-image: none;">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next" style="background-image: none;">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> -->
        </div>