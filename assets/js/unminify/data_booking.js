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
        { data: "total_bayar" },
        { data: "status" }
    ]
});

function reloadTable() {
    data_booking.ajax.reload()
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
        text: "Update status booking?",
        type: "warning",
        showCancelButton: true
    }).then((result) => {
        if (result.value) {
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
    } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.escape) {
        console.log("Update data dibatalkan.");
        return;
    }
    })
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

function remove(id) {
    Swal.fire({
        title: "Hapus",
        text: "Hapus data ini?",
        type: "warning",
        showCancelButton: true
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: deleteUrl,
                type: "post",
                dataType: "json",
                data: {
                    id: id
                },
                success: () => {
                    Swal.fire("Sukses", "Sukses Menghapus Data", "success");
                    reloadTable();
                },
                error: () => {
                    console.log(a);
                }
            })
        } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.escape) {
            console.log("Hapus data dibatalkan.");
            return; 
        }
    });
}

function editData() {
    $.ajax({
        url: editUrl,
        type: "post",
        dataType: "json",
        data: $("#form").serialize(),
        success: () => {
            $(".modal").modal("hide");
            Swal.fire("Sukses", "Sukses Mengedit Data", "success");
            reloadTable();
        },
        error: err => {
            console.log(err)
        }
    })
}

function add() {
    url = "add";
    $(".modal-title").html("Add Data");
    $('.modal button[type="submit"]').html("Add");
}

function edit(id) {
    $.ajax({
        url: getProdukUrl,
        type: "post",
        dataType: "json",
        data: {
            id: id
        },
        success: res => {
            $('[name="id"]').val(res.id);
            $('[name="barcode"]').val(res.barcode);
            $('[name="nama_produk"]').val(res.nama_produk);
            $('[name="satuan"]').append(`<option value='${res.satuan_id}'>${res.satuan}</option>`);
            $('[name="kategori"]').append(`<option value='${res.kategori_id}'>${res.kategori}</option>`);
            $('[name="harga"]').val(res.harga);
            $('[name="harga_jual"]').val(res.harga_jual);
            $('[name="stok"]').val(res.stok);
            $(".modal").modal("show");
            $(".modal-title").html("Edit Data");
            $('.modal button[type="submit"]').html("Edit");
            url = "edit";
        },
        error: err => {
            console.log(err)
        }
    });
}
data_booking.on("order.dt search.dt", () => {
    data_booking.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    });
});
$("#form").validate({
    errorElement: "span",
    errorPlacement: (err, el) => {
        err.addClass("invalid-feedback");
        el.closest(".form-group").append(err)
    },
    submitHandler: () => {
        "edit" == url ? editData() : addData()
    }
});
$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm();
});