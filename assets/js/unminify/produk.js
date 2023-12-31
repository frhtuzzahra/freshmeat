let url;
let produk = $("#produk").DataTable({
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
        { data: "kode_barang" },
        { data: "gambar" },
        { data: "nama" },
        { data: "satuan" },
        { data: "kategori" },
        { data: "harga_jual" },
        { data: "stok" },
        { data: "action" }
    ]
});

function reloadTable() {
    produk.ajax.reload()
}

function addData() {

    $("#form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
  
        $.ajax({
            url: addUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: res => {
                $(".modal").modal("hide");
                Swal.fire("Sukses", "Sukses Menambahkan Data", "success");
                reloadTable();
            },
            error: res => {
                console.log(res)
            }
        });
    });    
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
                reloadTable();
            },
            error: () => {
                console.log(a);
            }
        })
    })
}

function editData() {

    $("#form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
  
        $.ajax({
            url: editUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: () => {
                $(".modal").modal("hide");
                Swal.fire("Sukses", "Sukses Mengedit Data", "success");
                reloadTable();
            },
            error: err => {
                console.log(err)
            }
        });
    });
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
            $('[name="kode_barang"]').val(res.kode_barang);
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
produk.on("order.dt search.dt", () => {
    produk.column(0, {
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
$("#kategori").select2({
    placeholder: "Kategori",
    ajax: {
        url: kategoriSearchUrl,
        type: "post",
        dataType: "json",
        data: params => ({
            kategori: params.term
        }),
        processResults: data => ({
            results: data
        }),
        cache: true
    }
});
$("#satuan").select2({
    placeholder: "Satuan",
    ajax: {
        url: satuanSearchUrl,
        type: "post",
        dataType: "json",
        data: paras => ({
            satuan: paras.term
        }),
        processResults: data => ({
            results: data
        }),
        cache: true
    }
});
$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm();
});