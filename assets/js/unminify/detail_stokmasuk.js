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
        { data: "satuan" },
        { data: "tanggal" },
        { data: "harga" },
        { data: "jumlah" },
        { data: "dp" },
        { data: "kekurangan" },
        { data: "keterangan" },
        { data: "action" }
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
        url: getIdDetailMasukUrl,
        type: "post",
        dataType: "json",
        data: {
            id: id
        },
        success: res => {
            $('#isiStokMasuk').addClass('d-none');
            $('#kekurangan').removeAttr('readonly');
            $('#dp').attr('readonly', 'readonly');

            $('[name="id_detailmasuk"]').val(res.id);
            $('[name="id_stokmasuk"]').val(res.id_stokmasuk);
            $('[name="id"]').val(res.id_stokmasuk);
            $('[name="nama_produk"]').val(res.nama_produk);
            $('[name="total"]').val(res.total);
            $('[name="tanggal"]').val(res.tanggal);
            $('[name="harga"]').val(res.harga);
            $('[name="jumlah"]').val(res.jumlah);
            $('[name="dp"]').val(res.dp);
            $('[name="kekurangan"]').val(res.kekurangan);
            $('[name="keterangan"]').val(res.keterangan);
            $(".modal").modal("show");
            $(".modal-title").html("Lunas");
            $('.modal button[type="submit"]').html("Lunas");
            url = "edit";
        },
        error: err => {
            console.log(err)
        }
    });
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
            $("#nama_produk").val(res.nama_produk);
            $("#total").val(res.total);
        },
        error: err => {
            console.log(err)
        }
    })
}

function kekurangan(){
    let kekurangan = $("#total").val() - $('[name="dp"]').val();
    $("#kekurangan").val(kekurangan);
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
        "edit" == url ? editData() : addData()
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
    $('#isiStokMasuk').removeClass('d-none');
    $('#kekurangan').attr('readonly', 'readonly');
    $('#dp').removeAttr('readonly');
});
$(".modal").on("show.bs.modal", () => {
    let a = moment().format("D-MM-Y H:mm:ss");
    $("#tanggal").val(a)
});