let url, stok_masuk = $("#stok_masuk").DataTable({
    responsive: true,
    scrollX: true,
    ajax: readUrl,
    columnDefs: [{
        searcable: false,
        orderable: false,
        targets: 0
    }],
    order: [
        [1, "desc"]
    ],
    columns: [{
        data: null
    }, {
        data: function(row) {
            // Memisahkan tanggal ke tiga baris dengan judul
            return `
                <div><strong>Tanggal Input :</strong> ${row.tanggal}</div>
                <div><strong>Tanggal Masuk Frezer:</strong> ${row.tanggal_frezer}</div>
                <div><strong>Tanggal Expired:</strong> ${row.tanggal_expired}</div>
            `;
        }
    }, {
        data: "barcode"
    }, {
        data: "nama_produk"
    }, {
        data: "jumlah"
    }, {
        data: "satuan", 
    },{
        data: "harga"
    }, {
        data: "total"
    }, {
        data: "status",
    }, {
        data: "keterangan", 
    }, 

]
});

function reloadTable() {
    stok_masuk.ajax.reload()
}

function checkKeterangan(obj) {
    if (obj.value == "lain") {
        $(".supplier").hide();
        $("#supplier").attr("disabled", "disabled");
        $(".lain").removeClass("d-none") 
    } else {
        $(".lain").addClass("d-none");
        $("#supplier").removeAttr("disabled");
        $(".supplier").show()
    }
}

function addData() {
    $.ajax({
        url: addUrl,
        type: "post",
        dataType: "json",
        data: $("#form").serialize(),
        success: () => {
            $(".modal").modal("hide");
            Swal.fire("Sukses", "Sukses Menambahkan Data", "success");
            reloadTable()
        },
        error: err => {
            console.log(err)
        }
    })
}

function updateData() {
    $.ajax({
        url: updateUrl,
        type: "post",
        dataType: "json",
        data: $("#formUpdate").serialize(),
        success: () => {
            $(".modal").modal("hide");
            Swal.fire("Sukses", "Sukses Mengedit Data", "success");
            reloadTable()
        },
        error: err => {
            console.log(err)
        }
    })
}

function update(id) {
    Swal.fire({
        title: "Update",
        text: "Update data ini?",
        type: "warning",
        showCancelButton: true
    }).then(() => {
        $.ajax({
            url: updateUrl,
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: a => {
                Swal.fire("Sukses", "Sukses Update Data", "success");
                reloadTable()
            },
            error: a => {
                console.log(a)
            }
        })
    })
}

stok_masuk.on("order.dt search.dt", () => {
    stok_masuk.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    })
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

$("#tanggal").datetimepicker({
    format: "dd-mm-yyyy h:ii:ss"
});

$("#expired").datetimepicker({
    format: "dd-mm-yyyy h:ii:ss"
});


$("#freezer").datetimepicker({
    format: "dd-mm-yyyy h:ii:ss"
});

$("#barcode").select2({
    placeholder: "Barcode",
    ajax: {
        url: getBarcodeUrl,
        type: "post",
        dataType: "json",
        data: params => ({
            barcode: params.term
        }),
        processResults: res => ({
            results: res
        }),
        cache: true
    }
});
$("#supplier").select2({
    placeholder: "Supplier",
    ajax: {
        url: supplierSearchUrl,
        type: "post",
        dataType: "json",
        data: params => ({
            supplier: params.term
        }),
        processResults: res => ({
            results: res
        }),
        cache: true
    }
});
$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
})
$(".modal").on("show.bs.modal", () => {
    let a = moment().format("D-MM-Y H:mm:ss");
    $("#tanggal").val(a)
});