let url;
let detail_stokmasuk = $("#detail_stokmasuk").DataTable({
    responsive: true,
    scrollX: true,
    ajax: readUrl,
    columnDefs: [{
        searcable: false,
        orderable: false,
        targets: 0
    }],
    order: [
        [1, "asc"]
    ],
    columns: [
        { data: null }, 
        { data: "id_stokmasuk" },
        { data: "nama_produk" },
        { data: "tanggal" },
        { data: "harga_jual" },
        { data: "jumlah" },
        { data: "dp" },
        { data: "kekurangan" },
        { data: "keterangan" }
    ]
});

function reloadTable() {
    detail_stokmasuk.ajax.reload()
}

function addData() {
    $.ajax({
        url: addUrl,
        type: "post",
        dataType: "json",
        data: $("#form").serialize(),
        success: res => {
            $(".modal").modal("hide");
            Swal.fire("Sukses", "Sukses Menambahkan Data", "success");
            reloadTable();
        },
        error: res => {
            console.log(res);
        }
    })
}

function add() {
    url = "add";
    $(".modal-title").html("Add Data");
    $('.modal button[type="submit"]').html("Add");
}

function getNama() {
    $.ajax({
        url: produkGetNamaUrl,
        type: "post",
        dataType: "json",
        data: {
            id: $("#id").val()
        },
        success: res => {
            $("#nama_produk").html(res.nama_produk);
            checkEmpty()
        },
        error: err => {
            console.log(err)
        }
    })
}

detail_stokmasuk.on("order.dt search.dt", () => {
    detail_stokmasuk.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    });
});

$("#form").validate({
    errorElement: "span",
    errorPlacement: (err, el) => {
        err.addClass("invalid-feedback"), el.closest(".form-group").append(err)
    },
    submitHandler: () => {
        "edit" == url ? updateData() : addData()
    }
});

$("#id").select2({
    placeholder: "ID Stok Masuk",
    ajax: {
        url: getIdStokMasukUrl,
        type: "post",
        dataType: "json",
        data: paras => ({
            id: paras.term
        }),
        processResults: data => ({
            results: data
        }),
        cache: true
    }
});
$("#tanggal").datetimepicker({
    format: "dd-mm-yyyy h:ii:ss"
});
$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm();
});
$(".modal").on("show.bs.modal", () => {
    let a = moment().format("D-MM-Y H:mm:ss");
    $("#tanggal").val(a)
});