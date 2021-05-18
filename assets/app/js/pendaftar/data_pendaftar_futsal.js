msg= '<img src="'+base_url+'assets/global/img/loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;LOADING...</span>';

tabel_data = $("#tabel_data").DataTable({
    ajax:{
        url:base_url+"pendaftar/Futsal/ajax_data_pendaftar",
        type:"GET"
    },
    responsive:true,
    processing:true,
    bDestroy:true,
    columns:[
        {data:'no'},
        {data:'nomor'},
        {data:'tanggal'},
        {data:'perusahaan'},
        {data:'brand'},
        {data:'tim'},
        {data:'email'},
        {data:'bukti',class:'text-center'},
        {data:'pic'},
        {data:'status_verif',class:'text-center bold'},
        {data:'aksi'}
    ],
    scrollY:"400px",
    iDisplayLength: 100
});

function zoom(url,nama) {
    $("#modal_img").modal('show');
    $("#img_zoom").attr("src",url);
    $("#title-modal").text("File Bukti Transfer - "+nama);
}

function verif(id) {
    bootbox.confirm({ 
        size: "small",
        message: "Anda akan memverifikasi data ini ?", 
        callback: function(result) { 
            if (result) {
                $.ajax({
                    url :base_url+"pendaftar/Futsal/ajax_verifikasi_data/"+id,
                    type : "GET",
                    dataType : "JSON",
                    beforeSend:function() {
                        App.blockUI({boxed:!0,message:msg,textOnly:!0});
                    },
                    complete:function() {
                        App.unblockUI();
                    },
                    success:function(data) {
                        if(data.status == true) {
                            toast_success(data.message);
                            tabel_data.ajax.url(base_url+'pendaftar/Futsal/ajax_data_pendaftar').load();
                        } else {
                            toast_error(data.message);
                        }
                    },
                    error:function(error) {
                        console.log(error);
                    }
                });                          
            }  
        }
    });
}

function kirim_invoice(id) {
    $.ajax({
        url :base_url+"pendaftar/Futsal/ajax_kirim_invoice/"+id,
        type : "GET",
        dataType : "JSON",
        beforeSend:function() {
            App.blockUI({boxed:!0,message:msg,textOnly:!0});
        },
        complete:function() {
            App.unblockUI();
        },
        success:function(data) {
            if(data.status == true) {
                toast_success(data.message);
            } else {
                toast_error(data.message);
            }
        },
        error:function(error) {
            console.log(error);
        }
    });
}