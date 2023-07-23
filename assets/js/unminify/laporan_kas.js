let laporan_kas = $("#laporan_kas").DataTable( {
    responsive:true,
    scrollX:true,
    ajax:readUrl,
    columnDefs:[{
        searcable: false,
        orderable: false,
        targets: 0
    }],
    order:[
        [1, "Desc"]],
        columns:[ {
            data: null
        }
        , {
            data: "tanggal"
        }
        , {
            data: "total_masuk"
        }
        , {
            data: "total_keluar"
        }
        ]
}

);
function reloadTable() {
    laporan_kas.ajax.reload()
}

laporan_kas.on("order.dt search.dt", ()=> {
    laporan_kas.column(0, {
        search: "applied", order: "applied"
    }).nodes().each((el, err)=> {
        el.innerHTML=err+1
    })
});
$(".modal").on("hidden.bs.modal", ()=> {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
});