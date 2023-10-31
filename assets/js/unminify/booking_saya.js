let url;
let data_booking = $("#data_booking").DataTable({
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
    columns: [
        { data: null }, 
        { data: "tanggal" },
        { data: "nota" },
        { data: "nama_produk" },
        { data: "nama_satuan" },
        { data: "total_bayar" },
        { data: "status" },
        { data: "action" }
    ]
});

function reloadTable() {
    data_booking.ajax.reload()
}
data_booking.on("order.dt search.dt", () => {
    data_booking.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    });
});