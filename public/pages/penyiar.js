$(document).ready(function () {
    $(".dt-empty").text("Tidak ada data");
});

$(function () {
    $("#penyiar-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: penyiarIndexUrl,
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "id_penyiar",
                name: "id_penyiar",
            },
            {
                data: "nama_penyiar",
                name: "nama_penyiar",
            },
            {
                data: "action",
                name: "action",
                className: "text-center",
            },
        ],
        lengthChange: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, "All"],
        ],
        layout: {
            topEnd: "search",
            bottomEnd: "paging",
            bottomStart: "info",
        },
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari data...",
            lengthMenu: "Menampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        },
    });
});

function penyiarBerhasil(message) {
    if (message) {
        Swal.fire({
            position: "center",
            icon: "success",
            text: message,
            showConfirmButton: false,
            timer: 1500,
        });
    }
}

window.deletePenyiar = function (id) {
    Swal.fire({
        text: "Apakah kamu yakin?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3B82F6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
};
