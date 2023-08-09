let url, pelanggan = $("#pelanggan").DataTable({
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
    columns: [{
        data: null
    }, {
        data: "nama"
    }, {
        data: "jenis_kelamin"
    }, {
        data: "alamat"
    }, {
        data: "telepon"
    }]
});

function reloadTable() {
    pelanggan.ajax.reload()
}
pelanggan.on("order.dt search.dt", () => {
    pelanggan.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    })
});