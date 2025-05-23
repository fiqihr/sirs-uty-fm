$(document).ready(function () {
    $(".dt-empty").text("Tidak ada data");
});

$(function () {
    $("#my-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: rsIndexUrl,
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "tanggal",
                name: "tanggal",
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
            bottomStart: "paging",
            bottomEnd: null,
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

function rancanganSiarBerhasil(message) {
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

window.deleteRs = function (id) {
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Semua data rancangan siar pada tanggal ini akan dihapus.",
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
