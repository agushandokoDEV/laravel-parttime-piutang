$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#users_id").select2();

    let table = $("#usulan").DataTable({
        ordering: false
    });

    $("#users_id").change(function (e) {
        e.preventDefault();
        let users_id = $(this).val();
        $.ajax({
            url: "/json/piutangs",
            method: "POST",
            data: {
                users_id: users_id,
            },
            dataType: "json",
            success: function (response) {
                let table = "";
                let no = 1;
                console.log(response);
                if (response.data.length > 0) {
                   $.each(response.data, function (key, val) {
                        if (val.jenis_piutang.jenis != null) {
                            table += `<tr>
                            <td class="text-center">${no++}</td>
                            <td>${val.user.no_skpd}</td>
                            <td>${val.user.name}</td>
                            <td>${val.nama_peminjam}</td>
                            <td class="text-center">${val.tgl_surat}</td>
                            <td>${val.jenis_piutang.jenis}</td>
                            <td class="text-center">${
                                val.selisihTahun
                            } Tahun</td>
                            <td>${val.nilai_rincian}</td>
                            <td class="text-center">

                                <a href="/admin/detail-usulan/${
                                    val.id
                                }" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>`;
                        }
                    });
                } else {
                    table += `<tr>
                                <td colspan="9" class="text-center">No data available in table</td>
                              </tr>`;
                }
                $("#piutangs").html(table);
            },
            error: function (err) {
                console.log(err);
            },
        });
    });
});

{/* <a href="/admin/usulan/${
                                    val.id
                                }" class="btn btn-warning btn-sm"><i class="fas fa-envelope"></i></a> */}
