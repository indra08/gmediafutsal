msg= '<img src="'+base_url+'assets/global/img/loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;LOADING...</span>';
id = $("#id").val();
function loadOfficial() {
    tabel_official = $("#table-official").DataTable({
        ajax:{
            url:base_url+"pendaftar/Cheers/ajax_data_official?id="+id,
            type:"GET"
        },
        responsive:true,
        processing:true,
        bDestroy:true,
        columns:[
            {data:'no'},
            {data:'nama'},
            {data:'no_hp'},
            {data:'file_ktp',class:'text-center'}
        ],
        scrollY:"300px",
        iDisplayLength: 100
    });
} loadOfficial();

function loadPelatih() {
    tabel_official = $("#table-pelatih").DataTable({
        ajax:{
            url:base_url+"pendaftar/Cheers/ajax_data_pelatih?id="+id,
            type:"GET"
        },
        responsive:true,
        processing:true,
        bDestroy:true,
        columns:[
            {data:'no'},
            {data:'nama'},
            {data:'no_hp'},
        ],
        scrollY:"300px",
        iDisplayLength: 100
    });
} 

function loadAtlet() {
    tabel_official = $("#table-atlet").DataTable({
        ajax:{
            url:base_url+"pendaftar/Cheers/ajax_data_atlet?id="+id,
            type:"GET"
        },
        responsive:true,
        processing:true,
        bDestroy:true,
        columns:[
            {data:'no'},
            {data:'nama'},
            {data:'jenis_kelamin'},
            {data:'tanggal_lahir'},
            {data:'usia',class:'text-center'},
            {data:'file_id',class:'text-center'},
        ],
        scrollY:"300px",
        iDisplayLength: 100
    });
} 

function zoom(url) {
    $("#modal_img").modal('show');
    $("#img_zoom").attr("src",url);
}