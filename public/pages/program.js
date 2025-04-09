$(document).ready(function () {
    $(".dt-empty").text("Tidak ada data");
});

$(function () {
    $("#my-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: programIndexUrl,
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "id_program",
                name: "id_program",
            },
            {
                data: "nama_program",
                name: "nama_program",
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
            emptyTable: "Tidak ada data",
        },
    });
});

function programBerhasil(message) {
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

window.deleteProgram = function (id) {
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
