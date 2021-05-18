<div class="row">
    <div class="col-md-12 form-group" style="text-align:center;">
        <img src="<?= base_url()?>frontend/images/tebak_skor.png" class="img-responsive" style="margin: 0 auto;">
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"> 
            <div id="alert_1" style="display:none;"></div>
        </div> 
    </div>
    <div class="row">
    <!--<form id="form-data">-->
    <!--    <div class="col-md-1"></div>-->
    <!--    <div class="col-md-5 col-sm-5 col-xs-6">-->
    <!--        <input type="number" min="0" class="form-control" name="skor1" id="skor1" placeholder="Tim Bergerak Bersama">-->
    <!--    </div>-->
    <!--    <div class="col-md-5 col-sm-5 col-xs-6">-->
    <!--        <input type="number" min="0" class="form-control" name="skor2" id="skor2" placeholder="Tim Semarang Hebat">-->
    <!--    </div>-->
    <!--    <div class="col-md-1"></div>-->
    <!--</div>-->
    <!--<br>-->
    <!--<div class="row">-->
    <!--    <div class="col-md-1"></div>-->
    <!--    <div class="col-md-4 form-group" style="text-align:center;">-->
    <!--        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">-->
    <!--    </div>-->
    <!--    <div class="col-md-3 form-group" style="text-align:center;">-->
    <!--        <input type="number" min="0" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor Handphone">-->
    <!--    </div>-->
    <!--    <div class="col-md-3 form-group" style="text-align:center;">-->
    <!--        <button type="button" id="add-tebak" class="btn btn-primary btn-block">Simpan</button>-->
    <!--    </div>-->
    <!--    <div class="col-md-1"></div>-->
    <!--</div>-->
    <!--</form>-->
    <br>
    <div class="row hidden">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <button id="refresh" class="btn btn-default"><i class="fa fa-refresh"></i> Reload
        </button>
    </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <table id="table-tebakskor" class="table table-bordered table-hover table-striped" style="width:100%;">
                <thead>
                    <tr bgcolor="#FFC500">
                        <th>#</th>
                        <th>Nama</th>
                        <th>Skor</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
    <br>
</div>