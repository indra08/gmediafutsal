msg= '<img src="'+base_url+'assets/global/img/loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;LOADING...</span>';
id = $("#id").val();
function loadOfficial() {
    tabel_official = $("#table-official").DataTable({
        ajax:{
            url:base_url+"pendaftar/Futsal/ajax_data_official?id="+id,
            type:"GET"
        },
        responsive:true,
        processing:true,
        bDestroy:true,
        columns:[
            {data:'no'},
            {data:'nama'},
            {data:'no_hp'},
            {data:'file_ktp',class:'text-center'},
            {data:'file_pas_foto',class:'text-center'},
            {data:'file_bpjs',class:'text-center'},
            {data:'file_bpjs_kesehatan',class:'text-center'},
        ],
        scrollY:"300px",
        iDisplayLength: 100
    });
} loadOfficial();

function loadInti() {
    tabel_official = $("#table-inti").DataTable({
        ajax:{
            url:base_url+"pendaftar/Futsal/ajax_data_inti?id="+id,
            type:"GET"
        },
        responsive:true,
        processing:true,
        bDestroy:true,
        columns:[
            {data:'no'},
            {data:'nama'},
            {data:'file_ktp',class:'text-center'},
            {data:'file_pas_foto',class:'text-center'},
            {data:'file_bpjs',class:'text-center'},
            {data:'file_bpjs_kesehatan',class:'text-center'},
        ],
        scrollY:"300px",
        iDisplayLength: 100
    });
} 

function loadCadangan() {
    tabel_official = $("#table-cadangan").DataTable({
        ajax:{
            url:base_url+"pendaftar/Futsal/ajax_data_cadangan?id="+id,
            type:"GET"
        },
        responsive:true,
        processing:true,
        bDestroy:true,
        columns:[
            {data:'no'},
            {data:'nama'},
            {data:'file_ktp',class:'text-center'},
            {data:'file_pas_foto',class:'text-center'},
            {data:'file_bpjs',class:'text-center'},
            {data:'file_bpjs_kesehatan',class:'text-center'},
        ],
        scrollY:"300px",
        iDisplayLength: 100
    });
} 

function zoom(url) {
    $("#modal_img").modal('show');
    $("#img_zoom").attr("src",url);
}

function addPemain() {
    $.ajax({
        url:base_url+"pendaftar/Futsal/ajax_add_pemain",
        type:"POST",
        data:new FormData($("#form-data")[0]),
        dataType:"JSON",
        cache:false,
        async : true,
        contentType: false,
        processData: false,
        beforeSend:function() {
            $("#add").attr("disabled", true).html('Menyimpan ...');
        },
        complete:function() {
            $("#add").attr("disabled", false).html('Simpan');
        },
        success:function(r) {
            $("#modal_form").modal('hide');
            if(r.status == true) {
                loadInti();
                loadCadangan();
                alert(r.message);
                $("#id").val("");
                $("#nama").val("");
                $("#bpjs").val("");
                $("#foto").val("");
                $("#file_ektp").val("");
                $("#bpjs_sehat").val("");
            } else {
                loadInti();
                loadCadangan();
                alert(r.message);
            }
        },
        error:function(err) {
            console.log(err);
        }
    });
}