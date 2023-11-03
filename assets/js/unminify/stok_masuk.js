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
            return `
                <div><strong>Tanggal Input :</strong> ${row.tanggal}</div>
                <div><strong>Tanggal Masuk Frezer:</strong> ${row.tanggal_frezer}</div>
                <div><strong>Tanggal Expired:</strong> ${row.tanggal_expired}</div>
            `;
        }
    }, {
        data: "kode_barang"
    }, {
        data: "nama_produk"
    }, {
        data: "satuan"
    }, {
        data: "jumlah"
    },{
        data: "harga"
    }, {
        data: "total"
    }, {
        data: "status",
    }, {
        data: function(row) {
            const tanggalExpired = new Date(row.tanggal_expired);
            const today = new Date();
            const sisaHari = Math.ceil((tanggalExpired - today) / (1000 * 60 * 60 * 24));

            return `${sisaHari} Hari`;
        }
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

$("#kode_barang").on("click", function() {
    console.log("Ada");
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

$("#kode_barang").select2({
    placeholder: "Kode Barang",
    ajax: {
        url: getBarcodeUrl,
        type: "post",
        dataType: "json",
        data: params => ({
            kode_barang: params.term
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