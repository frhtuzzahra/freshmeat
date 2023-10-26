let laporan_penjualan = $("#laporan_penjualan").DataTable({
    responsive: true,
    scrollX: true,
    ajax: readUrl,
    columnDefs: [{
        searcable: false,
        orderable: false,
        targets: 0
    }],
    order: [
        [1, "desc"]],
    columns: [{
        data: null
    }
        , {
        data: "tanggal"
    }
        , {
        data: "nama_produk"
    }
        , {
        data: "total_bayar"
    }, {
        data: "qty",
        render: function (data, type, row) {
            if (type === "display" || type === "filter") {
                // Menggabungkan nilai qty yang dipisahkan oleh koma
                var qtyArray = data.split(",");
                var qtyTotal = qtyArray.reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0);
                return qtyTotal;
            }
            return data;
        }
    }
        , {
        data: "jumlah_uang"
    }
        , {
        data: "diskon"
    }
        , {
        data: "pelanggan",
        render: function (data) {
            return data !== null ? data : "non-member";
        }
    }
        , {
        data: "action"
    }
    ]
}

);
function reloadTable() {
    laporan_penjualan.ajax.reload()
}

function remove(id) {
    Swal.fire({
        title: "Hapus",
        text: "Hapus data ini?",
        type: "warning",
        showCancelButton: true
    }).then(() => {
        $.ajax({
            url: deleteUrl,
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: () => {
                Swal.fire("Sukses", "Sukses Menghapus Data", "success");
                reloadTable()
            },
            error: err => {
                console.log(err)
            }
        })
    })
}

laporan_penjualan.on("order.dt search.dt", () => {
    laporan_penjualan.column(0, {
        search: "applied", order: "applied"
    }).nodes().each((el, err) => {
        el.innerHTML = err + 1
    })
});
$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
});